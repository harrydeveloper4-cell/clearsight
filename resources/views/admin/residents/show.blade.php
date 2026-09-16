@extends('layouts.app')
@section('page-title', $resident->full_name)

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.residents.index') }}">Residents</a>
    <span>›</span> {{ $resident->full_name }}
</div>


<div class="card">
    {{-- Profile Header --}}
    <div class="profile-header">
        <div class="profile-avatar">{{ strtoupper(substr($resident->first_name, 0, 1)) }}</div>
        <div class="profile-info" style="flex:1">
            <h2>{{ $resident->full_name }}</h2>
            <div class="profile-meta">
                <span>🎂 {{ $resident->dob?->format('d M Y') }} ({{ $resident->age }} yrs)</span>
                <span>🛏 {{ $resident->funding_status ?? 'N/A' }}</span>
                <span>🏠 {{ $resident->careHome->name }}</span>
                @if($resident->status === 'overdue')
                    <span class="badge badge-overdue">⚠ Overdue</span>
                @elseif($resident->status === 'due')
                    <span class="badge badge-due">🗓 Due</span>
                @else
                    <span class="badge badge-ok">✅ Up to Date</span>
                @endif
            </div>
        </div>
        <div style="display:flex;gap:8px">
            <a href="{{ route('admin.residents.edit', $resident) }}" class="btn btn-outline btn-sm">✏ Edit</a>
            @if($resident->is_active)
                <form method="POST" action="{{ route('admin.residents.deactivate', $resident) }}"
                      onsubmit="return confirm('Mark this resident as discharged?')">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-danger btn-sm">Discharge</button>
                </form>
            @endif
            <form method="POST" action="{{ route('admin.residents.destroy', $resident) }}" onsubmit="return confirm('Are you sure you want to delete this resident?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="profile-tabs">
        <a href="#overview"  class="profile-tab active"  onclick="showTab(event,'overview')">Overview</a>
        <a href="#requests"  class="profile-tab"         onclick="showTab(event,'requests')">Requests ({{ $resident->serviceRequests->count() }})</a>
        <a href="#document"     class="profile-tab"         onclick="showTab(event,'document')">Document</a>
        <a href="#notes"     class="profile-tab"         onclick="showTab(event,'notes')">Notes</a>
    </div>

    <div class="card-body">

        {{-- Overview Tab --}}
        <div id="tab-overview">
            @if($resident->status === 'overdue')
                <div class="alert alert-danger">⚠️ This resident is <strong>overdue</strong> for their eye care recall. Please action immediately.</div>
            @elseif($resident->status === 'due')
                <div class="alert alert-warn">🗓 This resident is <strong>due</strong> for their recall this month.</div>
            @endif

            <div class="grid-2" style="margin-bottom:24px">
                <div>
                    <div style="font-size:12px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Eye Care</div>
                    @include('partials.info-row', ['label' => 'Last Eye Test',  'value' => $resident->last_eye_test?->format('d M Y') ?? '—'])
                    @include('partials.info-row', ['label' => 'Next Recall',    'value' => $resident->next_recall_date?->format('d M Y') ?? '—'])
                    @include('partials.info-row', ['label' => 'Status',         'value' => ucfirst($resident->status)])
                </div>
                <div>
                    <div style="font-size:12px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Resident Details</div>
                    @include('partials.info-row', ['label' => 'Date of Birth', 'value' => $resident->dob?->format('d M Y') ?? '—'])
                    @include('partials.info-row', ['label' => 'Age',           'value' => $resident->age . ' years'])
                    @include('partials.info-row', ['label' => 'Care Home',     'value' => $resident->careHome->name])
                    @include('partials.info-row', ['label' => 'Funding Status', 'value' => $resident->funding_status ?? '—'])
                </div>
            </div>
        </div>

        {{-- Requests Tab --}}
        <div id="tab-requests" style="display:none">
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Service</th><th>Priority</th><th>Date</th><th>Status</th><th>Notes</th></tr></thead>
                    <tbody>
                        @forelse($resident->serviceRequests as $req)
                            <tr>
                                <td>{{ $req->type_icon }} {{ $req->type }}</td>
                                <td><span class="badge badge-{{ strtolower($req->priority) }}">{{ $req->priority }}</span></td>
                                <td>{{ $req->created_at->format('d M Y') }}</td>
                                <td><span class="badge {{ $req->status_badge }}">{{ $req->status }}</span></td>
                                <td>{{ $req->notes ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5">
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
                <form action="{{ route('admin.residents.document.upload', $resident) }}" method="POST" enctype="multipart/form-data" style="margin-bottom:16px" onsubmit="document.getElementById('document-upload').disabled=true; this.querySelector('button').disabled=true;">
                    @csrf
                    <input type="file" name="document" id="document-upload" style="margin-bottom:16px">
                    <button class="btn btn-primary btn-sm" onclick="uploadDocument()">Upload Document</button>
                </form>
                
            {{--
            @if($resident->documents->isNotEmpty())
            @foreach($resident->documents as $document)
            <a href="{{ url("storage/".$document->filepath) }}" download class="btn btn-outline btn-sm">📥 {{ $document->filename }}</a>
            @endforeach
            @else
            <div class="empty-state" style="padding:24px">
                <div class="icon">📄</div><h3>No document uploaded</h3>
            </div>
            @endif
            --}}
            @if($resident->documents->isNotEmpty())

            <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
                @foreach($resident->documents as $document)
                <div style="display:flex;gap:6px;align-items:center;">
                    <a href="{{ route('admin.documents.download', $document->id) }}"
                    class="btn btn-outline btn-sm">
                    📥 {{ $document->filename }} 
                    </a>
                    <a href="{{ route('admin.documents.view', $document->id) }}" target="_blank"
                    class="btn btn-outline btn-sm">
                    👁️ View
                    </a>
                    <form method="POST"
                        action="{{ route('admin.documents.delete', $document->id) }}"
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
            <form method="POST" action="{{ route('admin.residents.update', $resident) }}">
                @csrf @method('PUT')
                <input type="hidden" name="first_name" value="{{ $resident->first_name }}">
                <input type="hidden" name="last_name"  value="{{ $resident->last_name }}">
                <div class="form-group">
                    <label>Clinical Notes</label>
                    
                    <textarea name="notes" style="min-height:140px">{{ $resident->notes }}</textarea>
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
</script>

@endsection
