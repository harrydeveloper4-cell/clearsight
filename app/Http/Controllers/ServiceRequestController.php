<?php

namespace App\Http\Controllers;

use App\Models\CareHome;
use App\Models\Resident;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceRequestController extends Controller
{
    // ─── List All Requests ───────────────────────────────────────

    public function index(Request $request)
    {
        $query = ServiceRequest::with(['resident', 'careHome'])->withCount('reports')->latest();

        // Care home users only see their own requests
        if (Auth::user()->isCareHome()) {
            $query->where('care_home_id', Auth::user()->care_home_id);
        }

        // Filters
        if ($request->filled('care_home_id')) {
            $query->where('care_home_id', $request->care_home_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests  = $query->paginate(20)->withQueryString();
        $careHomes = Auth::user()->isAdmin() ? CareHome::orderBy('name')->get() : collect();

        $view = Auth::user()->isAdmin() ? 'admin.requests.index' : 'carehome.requests.index';
        return view($view, compact('requests', 'careHomes'));
    }

    // ─── Submit New Request ──────────────────────────────────────

    public function store(Request $request)
    {
        $data = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'type'        => 'required|in:Eye Test,Replacement Glasses,Ear Wax Removal,Hearing Care',
            'priority'    => 'required|in:Routine,Urgent',
            'notes'       => 'nullable|string|max:500',
        ]);

        $resident = Resident::findOrFail($data['resident_id']);

        // Prevent care home from submitting for other homes
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        ServiceRequest::create([
            'resident_id'  => $data['resident_id'],
            'care_home_id' => $resident->care_home_id,
            'requested_by' => Auth::id(),
            'type'         => $data['type'],
            'priority'     => $data['priority'],
            'status'       => 'New',
            'notes'        => $data['notes'] ?? null,
        ]);

        return back()->with('success', $data['type'] . ' request submitted successfully.');
    }

    // ─── Update Status (Admin Only) ──────────────────────────────

    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        $request->validate([
            'status' => 'required|in:New,In Progress,Completed',
        ]);

        $serviceRequest->update(['status' => $request->status]);

        return back()->with('success', 'Request status updated to "' . $request->status . '".');
    }

    // ─── Admin Report Upload ───────────────────────────────────

    public function reports(ServiceRequest $serviceRequest)
    {
        // Check access control
        if (Auth::user()->isCareHome() && $serviceRequest->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        $serviceRequest->load(['resident', 'careHome', 'reports.uploadedBy']);
        
        $view = Auth::user()->isAdmin() ? 'admin.requests.reports' : 'carehome.requests.reports';
        return view($view, compact('serviceRequest'));
    }

    public function storeReport(Request $request, ServiceRequest $serviceRequest)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpeg,png,jpg,gif|max:50480',
            'note' => 'nullable|string|max:500',
        ]);

        $file = $request->file('file');
        
        // Generate safe filename
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName);
        $extension = $file->getClientOriginalExtension();
        $filename = $safeName . '_' . time() . '_' . uniqid() . '.' . $extension;
        
        $path = $file->storeAs('service-request-reports', $filename, 'local');
        
        $report = ServiceRequestReport::create([
            'service_request_id' => $serviceRequest->id,
            'file_name'          => $file->getClientOriginalName(),
            'file_path'          => $path,
            'note'               => $request->note ?? '',
            'uploaded_by'        => Auth::id(),
        ]);

        // Log the activity
        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties([
                'service_request_id' => $serviceRequest->id,
                'resident_name' => $serviceRequest->resident->full_name,
                'file_name' => $file->getClientOriginalName(),
            ])
            ->log('Report uploaded');

        return back()->with('success', 'Report uploaded successfully.');
    }

    // ─── Download Report ──────────────────────────────────────
    public function downloadReport(ServiceRequestReport $report)
    {
        // Check access control
        $serviceRequest = $report->serviceRequest;
        if (Auth::user()->isCareHome() && $serviceRequest->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        // Log the download
        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties([
                'service_request_id' => $serviceRequest->id,
                'file_name' => $report->file_name,
            ])
            ->log('Report downloaded');

        return Storage::disk('local')->download($report->file_path, $report->file_name);
    }

    // ─── View Report ────────────────────────────────────────
    public function viewReport(ServiceRequestReport $report)
    {
        // Check access control
        $serviceRequest = $report->serviceRequest;
        if (Auth::user()->isCareHome() && $serviceRequest->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        // Log the view
        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties([
                'service_request_id' => $serviceRequest->id,
                'file_name' => $report->file_name,
            ])
            ->log('Report viewed');

        return Storage::disk('local')->response($report->file_path, $report->file_name);
    }

    // ─── Delete Report ─────────────────────────────────────
    public function deleteReport(ServiceRequestReport $report)
    {
        // Check access control
        $serviceRequest = $report->serviceRequest;
        if (Auth::user()->isCareHome() && $serviceRequest->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        // Log before deleting
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'service_request_id' => $serviceRequest->id,
                'resident_name' => $serviceRequest->resident->full_name,
                'file_name' => $report->file_name,
            ])
            ->log('Report deleted');

        // Delete the file
        if (Storage::disk('local')->exists($report->file_path)) {
            Storage::disk('local')->delete($report->file_path);
        }

        // Delete the record
        $report->delete();

        return back()->with('success', 'Report deleted successfully.');
    }
}
