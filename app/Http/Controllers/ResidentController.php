<?php

namespace App\Http\Controllers;

use App\Models\CareHome;
use App\Models\Resident;
use App\Models\ResidentDocument;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    // ─── List Residents ──────────────────────────────────────────

    public function index(Request $request)
    {
        $query = Resident::with('careHome')->where('is_active', true);

        // Care home users only see their own residents
        if (Auth::user()->isCareHome()) {
            $query->where('care_home_id', Auth::user()->care_home_id);
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Care home filter (admin only)
        if ($request->filled('care_home_id') && Auth::user()->isAdmin()) {
            $query->where('care_home_id', $request->care_home_id);
        }

        $residents  = $query->latest()->paginate(20)->withQueryString();
        $careHomes  = Auth::user()->isAdmin() ? CareHome::orderBy('name')->get() : collect();
        
        $view = Auth::user()->isAdmin() ? 'admin.residents.index' : 'carehome.residents.index';
        return view($view, compact('residents', 'careHomes'));
    }

    // ─── Show Single Resident ────────────────────────────────────

    public function show(Resident $resident)
    {
        // Care home users cannot see other homes' residents
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        $resident->load(['careHome', 'serviceRequests' => fn($q) => $q->latest(), 'documents']);
        $view = Auth::user()->isAdmin() ? 'admin.residents.show' : 'carehome.residents.show';
        
        return view($view, compact('resident'));
    }

    // ─── Create Form ─────────────────────────────────────────────

    public function create($id = null)
    {
        $careHomes = Auth::user()->isAdmin()
            ? CareHome::orderBy('name')->get()
            : CareHome::where('id', Auth::user()->care_home_id)->get();

        $view = Auth::user()->isAdmin() ? 'admin.residents.create' : 'carehome.residents.create';
        return view($view, compact('careHomes', 'id'));
    }

    // ─── Store Resident ──────────────────────────────────────────

    public function store(Request $request)
    {
        $data = $request->validate([
            'care_home_id'    => 'required|exists:care_homes,id',
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'dob'             => 'required|date',
            'funding_status'            => 'nullable|string|max:50',
            'last_eye_test'   => 'nullable|date',
            'next_recall_date'=> 'nullable|date',
            'notes'           => 'nullable|string',
        ]);

        // Care home users can only add to their own home
        if (Auth::user()->isCareHome()) {
            $data['care_home_id'] = Auth::user()->care_home_id;
        }

        Resident::create($data);

        $route = Auth::user()->isAdmin() ? 'admin.residents.index' : 'carehome.residents.index';
        return redirect()->route($route)->with('success', 'Resident added successfully.');
    }

    // ─── Edit Form ───────────────────────────────────────────────

    public function edit(Resident $resident)
    {
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        $careHomes = CareHome::orderBy('name')->get();
        $view = Auth::user()->isAdmin() ? 'admin.residents.edit' : 'carehome.residents.edit';
        return view($view, compact('resident', 'careHomes'));
    }

    // ─── Update Resident ─────────────────────────────────────────

    public function update(Request $request, Resident $resident)
    {
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        $data = $request->validate([
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'dob'              => 'required|date',
            'funding_status'   => 'nullable|string|max:50',
            'last_eye_test'    => 'nullable|date',
            'next_recall_date' => 'nullable|date',
            'notes'            => 'nullable|string',
            'is_active'     => 'required',
        ]);

        $resident->update($data);

        return back()->with('success', 'Resident updated successfully.');
    }

    // ─── Mark Inactive / Discharge ───────────────────────────────

    public function deactivate(Resident $resident)
    {
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }
        $resident->update(['is_active' => false]);
        return back()->with('success', 'Resident marked as discharged.');
    }

    // ─── Upload Document ─────────────────────────────────────────
    public function uploadDocument(Request $request, Resident $resident)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:50480|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpeg,image/png',
        ]);

        // Check if user has access to this resident
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        $file = $request->file('document');
        
        // Generate a safe, unique filename
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName);
        $extension = $file->getClientOriginalExtension();
        $filename = $safeName . '_' . time() . '_' . uniqid() . '.' . $extension;
        
        $path = $file->storeAs('resident_documents', $filename, 'local');

        $document = ResidentDocument::create([
            'resident_id' => $resident->id,
            'filename' => $file->getClientOriginalName(),
            'filepath' => $path,
            'filetype' => $file->getMimeType(),
            'filesize' => $file->getSize(),
            'uploaded_by' => Auth::id(),
        ]);

        // Log the activity
        activity()
            ->causedBy(Auth::user())
            ->performedOn($document)
            ->withProperties([
                'resident_id' => $resident->id,
                'resident_name' => $resident->full_name,
                'filename' => $file->getClientOriginalName(),
                'filesize' => $file->getSize(),
            ])
            ->log('Document uploaded');

        return back()->with('success', 'Document uploaded successfully.');
    }
    
    // ─── Delete Document ─────────────────────────────────────────
    public function deleteDocument(ResidentDocument $document)
    {
        // Check if user has access
        $resident = $document->resident;
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        // Log before deleting
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'resident_id' => $resident->id,
                'resident_name' => $resident->full_name,
                'filename' => $document->filename,
                'filesize' => $document->filesize,
            ])
            ->log('Document deleted');

        if (Storage::disk('local')->exists($document->filepath)) {
            Storage::disk('local')->delete($document->filepath);
        }
        if (Storage::disk('public')->exists($document->filepath)) {
            Storage::disk('public')->delete($document->filepath);
        }

        $document->delete();

        return back()->with('success', 'Document deleted successfully.');
    }

    // ─── Download Document ─────────────────────────────────────────
    public function downloadDocument(ResidentDocument $document)
    {
        // Check if user has access
        $resident = $document->resident;
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        // Log the download
        activity()
            ->causedBy(Auth::user())
            ->performedOn($document)
            ->withProperties([
                'resident_id' => $resident->id,
                'resident_name' => $resident->full_name,
                'filename' => $document->filename,
            ])
            ->log('Document downloaded');

        // Check if file exists on local disk first, fall back to public
        if (Storage::disk('local')->exists($document->filepath)) {
            return Storage::disk('local')->download($document->filepath, $document->filename);
        } elseif (Storage::disk('public')->exists($document->filepath)) {
            return Storage::disk('public')->download($document->filepath, $document->filename);
        }
        
        abort(404, 'Document file not found');
    }

    // ─── View Document ─────────────────────────────────────────
    public function viewDocument(ResidentDocument $document)
    {
        // Check if user has access
        $resident = $document->resident;
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }

        // Log the view
        activity()
            ->causedBy(Auth::user())
            ->performedOn($document)
            ->withProperties([
                'resident_id' => $resident->id,
                'resident_name' => $resident->full_name,
                'filename' => $document->filename,
            ])
            ->log('Document viewed');

        // Check if file exists on local disk first, fall back to public
        if (Storage::disk('local')->exists($document->filepath)) {
            return Storage::disk('local')->response($document->filepath, $document->filename, [
                'Content-Type' => $document->filetype,
            ]);
        } elseif (Storage::disk('public')->exists($document->filepath)) {
            return Storage::disk('public')->response($document->filepath, $document->filename, [
                'Content-Type' => $document->filetype,
            ]);
        }
        
        abort(404, 'Document file not found');
    }
    
    // ─── Delete Resident (optional) ─────────────────────────────────────────
    public function destroy(Resident $resident)
    {
        if (Auth::user()->isCareHome() && $resident->care_home_id !== Auth::user()->care_home_id) {
            abort(403);
        }     
        $resident->delete();
        $route = Auth::user()->isAdmin() ? 'admin.residents.index' : 'carehome.residents.index';
        return redirect()->route($route)->with('success', 'Resident deleted successfully.');
    }  
   
}
