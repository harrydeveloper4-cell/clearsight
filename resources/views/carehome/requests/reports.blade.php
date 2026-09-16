@extends('layouts.app')
@section('page-title', 'Request Reports')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">Request Reports</div>
        <div class="section-sub">Reports and notes uploaded for this service request</div>
    </div>
    <a href="{{ route('carehome.requests.index') }}" class="btn btn-outline btn-sm">Back to requests</a>
</div>

<div class="card">
    <div class="card-body">
        <div style="margin-bottom:20px; display:grid; gap:10px;">
            <div><strong>Resident:</strong> {{ $serviceRequest->resident->full_name }} (Funding Status: {{ $serviceRequest->resident->funding_status }})</div>
            <div><strong>Care Home:</strong> {{ $serviceRequest->careHome->name }}</div>
            <div><strong>Service:</strong> {{ $serviceRequest->type }}</div>
            <div><strong>Status:</strong> <span class="badge {{ $serviceRequest->status_badge }}">{{ $serviceRequest->status }}</span></div>
        </div>

        @if($serviceRequest->reports->isEmpty())
            <div class="empty-state">
                <div class="icon">📁</div>
                <h3>No reports uploaded yet</h3>
                <p>Reports will appear here when they are uploaded.</p>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Note</th>
                            <th>Uploaded</th>
                            <th>Uploaded By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($serviceRequest->reports as $report)
                            <tr>
                                <td>
                                    <div style="font-weight:500">{{ $report->file_name }}</div>
                                </td>
                                <td>{{ $report->note ?: '—' }}</td>
                                <td>{{ $report->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $report->uploadedBy ? $report->uploadedBy->name : 'Admin' }}</td>
                                <td>
                                    <div style="display:flex; gap:8px;">
                                        <a href="{{ route('carehome.reports.view', $report) }}" target="_blank" class="btn btn-outline btn-sm">
                                            👁️ View
                                        </a>
                                        <a href="{{ route('carehome.reports.download', $report) }}" class="btn btn-outline btn-sm">
                                            📥 Download
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
