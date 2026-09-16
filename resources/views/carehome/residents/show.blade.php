@extends('layouts.app')
@section('page-title', $resident->full_name)

@section('content')

<div class="breadcrumb">
    <a href="{{ route('carehome.residents.index') }}">Residents</a>
    <span>›</span> {{ $resident->full_name }}
</div>

<div class="card">
    <div class="profile-header">
        <div class="profile-avatar">{{ strtoupper(substr($resident->first_name, 0, 1)) }}</div>
        <div class="profile-info" style="flex:1">
            <h2>{{ $resident->full_name }}</h2>
            <div class="profile-meta">
                <span>🎂 {{ $resident->dob?->format('d M Y') }} ({{ $resident->age }} yrs)</span>
                <span>🛏 {{ $resident->funding_status ?? 'N/A' }}</span>
                @if($resident->status === 'overdue')
                    <span class="badge badge-overdue">⚠ Overdue</span>
                @elseif($resident->status === 'due')
                    <span class="badge badge-due">🗓 Due</span>
                @else
                    <span class="badge badge-ok">✅ Up to Date</span>
                @endif
            </div>
        </div>
        <a href="{{ route('carehome.residents.edit', $resident) }}" class="btn btn-outline btn-sm">✏ Edit</a>
        <form method="POST" action="{{ route('carehome.residents.destroy', $resident) }}" onsubmit="return confirm('Are you sure you want to delete this resident?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
        </form>
    </div>

    <div class="profile-tabs">
        <a href="#overview" class="profile-tab active" onclick="showTab(event,'overview')">Overview</a>
        <a href="#requests" class="profile-tab" onclick="showTab(event,'requests')">Requests ({{ $resident->serviceRequests->count() }})</a>
        <a href="#document"     class="profile-tab"         onclick="showTab(event,'document')">Document</a>
        <a href="#notes"    class="profile-tab" onclick="showTab(event,'notes')">Notes</a>
    </div>

    <div class="card-body">

        {{-- Overview --}}
        <div id="tab-overview">

            @if($resident->status === 'overdue')
                <div class="alert alert-danger">⚠️ This resident is <strong>overdue</strong> for their eye care recall. Please request a service below.</div>
            @elseif($resident->status === 'due')
                <div class="alert alert-warn">🗓 This resident is <strong>due</strong> for their recall this month.</div>
            @endif

            <div class="grid-2" style="margin-bottom:24px">
                <div>
                    <div style="font-size:12px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Eye Care Details</div>
                    @include('partials.info-row', ['label' => 'Last Eye Test', 'value' => $resident->last_eye_test?->format('d M Y') ?? '—'])
                    @include('partials.info-row', ['label' => 'Next Recall',   'value' => $resident->next_recall_date?->format('d M Y') ?? '—'])
                    @include('partials.info-row', ['label' => 'Status',        'value' => ucfirst($resident->status)])
                </div>
                <div>
                    <div style="font-size:12px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Resident Details</div>
                    @include('partials.info-row', ['label' => 'Date of Birth', 'value' => $resident->dob?->format('d M Y') ?? '—'])
                    @include('partials.info-row', ['label' => 'Age',           'value' => $resident->age . ' years'])
                    @include('partials.info-row', ['label' => 'Funding Status', 'value' => $resident->funding_status ?? '—'])
                </div>
            </div>

            {{-- Service Request Buttons --}}
            <div style="font-size:12px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.5px;margin-bottom:14px">
                Request a Service
            </div>

            <form method="POST" action="{{ route('carehome.requests.store') }}" id="req-form">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                <input type="hidden" name="type"        id="req-type">
                <input type="hidden" name="priority"    id="req-priority" value="Routine">
                <input type="hidden" name="notes"       id="req-notes">

                <div class="service-btns">
                    <button type="button" class="service-btn" onclick="submitRequest('Eye Test')">
                        <div class="service-btn-icon">👁️</div>
                        <div class="service-btn-label">Request Sight Test</div>
                        <div class="service-btn-sub">Schedule an eye examination</div>
                    </button>
                    <button type="button" class="service-btn" onclick="submitRequest('Replacement Glasses')">
                        <div class="service-btn-icon">👓</div>
                        <div class="service-btn-label">Replacement Glasses</div>
                        <div class="service-btn-sub">Order or replace spectacles</div>
                    </button>
                    <button type="button" class="service-btn" onclick="submitRequest('Ear Wax Removal')">
                        <div class="service-btn-icon">👂</div>
                        <div class="service-btn-label">Ear Wax Removal</div>
                        <div class="service-btn-sub">Microsuction or irrigation</div>
                    </button>
                    <button type="button" class="service-btn" onclick="submitRequest('Hearing Care')">
                        <div class="service-btn-icon">🩺</div>
                        <div class="service-btn-label">Hearing Care</div>
                        <div class="service-btn-sub">Hearing assessment & support</div>
                    </button>
                </div>
            </form>

        </div>

        {{-- Requests Tab --}}
        <div id="tab-requests" style="display:none">
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Service</th><th>Priority</th><th>Date</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($resident->serviceRequests as $req)
                            <tr>
                                <td>{{ $req->type_icon }} {{ $req->type }}</td>
                                <td><span class="badge {{ $req->priority === 'Urgent' ? 'badge-overdue' : 'badge-new' }}">{{ $req->priority }}</span></td>
                                <td>{{ $req->created_at->format('d M Y') }}</td>
                                <td><span class="badge {{ $req->status_badge }}">{{ $req->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4">
                                <div class="empty-state" style="padding:24px">
                                    <div class="icon">📋</div><h3>No requests yet</h3>
                                </div>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Document Tab --}}
        <div id="tab-document" style="display:none">
            <label>Upload Document Here</label>
                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('carehome.residents.document.upload', $resident) }}" method="POST" enctype="multipart/form-data" style="margin-bottom:16px" onsubmit="document.getElementById('document-upload').disabled=true; this.querySelector('button').disabled=true;">
                    @csrf
                    <input type="file" name="document" id="document-upload" style="margin-bottom:16px">
                    <button class="btn btn-primary btn-sm" onclick="uploadDocument()">Upload Document</button>
                </form>
                
            @if($resident->documents->isNotEmpty())

            <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
                @foreach($resident->documents as $document)
                <div style="display:flex;gap:6px;align-items:center;">
                    <a href="{{ route('carehome.documents.download', $document->id) }}"
                    class="btn btn-outline btn-sm">
                    📥 {{ $document->filename }} 
                    </a>
                    <a href="{{ route('carehome.documents.view', $document->id) }}" target="_blank"
                    class="btn btn-outline btn-sm">
                    👁️ View
                    </a>
                    <form method="POST"
                        action="{{ route('carehome.documents.delete', $document->id) }}"
                        onsubmit="return confirm('Delete this document?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            🗑 Delete
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            @else

            <div class="empty-state" style="padding:24px">
                <div class="icon">📄</div>
                <h3>No document uploaded</h3>
            </div>

            @endif
        </div>

        {{-- Notes Tab --}}
        <div id="tab-notes" style="display:none">
            <form method="POST" action="{{ route('carehome.residents.update', $resident) }}">
                @csrf @method('PUT')
                <input type="hidden" name="first_name" value="{{ $resident->first_name }}">
                <input type="hidden" name="last_name"  value="{{ $resident->last_name }}">
                <div class="form-group">
                    <label>Clinical Notes</label>
                    <textarea name="notes" style="min-height:140px">{{ old('notes', $resident->notes) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Save Notes</button>
            </form>
        </div>

    </div>
</div>

<script>
function showTab(e, tab) {
    e.preventDefault();
    document.querySelectorAll('[id^="tab-"]').forEach(t => t.style.display = 'none');
    document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('tab-' + tab).style.display = 'block';
    e.currentTarget.classList.add('active');
}

function submitRequest(type) {
    if (!confirm('Submit a ' + type + ' request for {{ $resident->full_name }}?')) return;
    document.getElementById('req-type').value = type;
    document.getElementById('req-form').submit();
}
</script>

@endsection
