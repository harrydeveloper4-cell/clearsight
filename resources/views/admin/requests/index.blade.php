@extends('layouts.app')
@section('page-title', 'Service Requests')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">Service Requests</div>
        <div class="section-sub">All incoming requests across all care homes</div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" class="filter-row">
    <select class="filter-select" name="care_home_id">
        <option value="">All Homes</option>
        @foreach($careHomes as $home)
            <option value="{{ $home->id }}" {{ request('care_home_id') == $home->id ? 'selected' : '' }}>
                {{ $home->name }}
            </option>
        @endforeach
    </select>
    <select class="filter-select" name="type">
        <option value="">All Services</option>
        @foreach(['Eye Test','Replacement Glasses','Ear Wax Removal','Hearing Care'] as $type)
            <option {{ request('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
        @endforeach
    </select>
    <select class="filter-select" name="status">
        <option value="">All Statuses</option>
        @foreach(['New','In Progress','Completed'] as $s)
            <option {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-teal btn-sm">Filter</button>
    <a href="{{ route('admin.requests.index') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Resident</th><th>Care Home</th><th>Service</th>
                    <th>Priority</th><th>Date</th><th>Status</th><th>Update</th><th>Reports</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                    <tr>
                        <td>
                            <div style="font-weight:600">{{ $req->resident->full_name }}</div>
                            <div style="font-size:12px;color:var(--gray-400)">{{ $req->resident->funding_status }}</div>
                        </td>
                        <td>{{ $req->careHome->name }}</td>
                        <td>{{ $req->type_icon }} {{ $req->type }}</td>
                        <td>
                            <span class="badge {{ $req->priority === 'Urgent' ? 'badge-overdue' : 'badge-new' }}">
                                {{ $req->priority }}
                            </span>
                        </td>
                        <td>{{ $req->created_at->format('d M Y') }}</td>
                        <td><span class="badge {{ $req->status_badge }}">{{ $req->status }}</span></td>
                        <td>
                            @if($req->status !== 'Completed')
                                <form method="POST" action="{{ route('admin.requests.updateStatus', $req) }}">
                                    @csrf @method('PATCH')
                                    <select name="status" class="filter-select"
                                            style="padding:5px 10px;font-size:12px"
                                            onchange="this.form.submit()">
                                        <option {{ $req->status === 'New'         ? 'selected' : '' }}>New</option>
                                        <option {{ $req->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option {{ $req->status === 'Completed'   ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            @else
                                <span style="color:var(--success);font-size:12px;font-weight:600"> Done</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline btn-sm"
                                    onclick='openReportModal({{ $req->id }}, @json($req->resident->full_name), "{{ route('admin.requests.reports.store', $req->id) }}")'>
                                + Add report
                            </button>
                            @if($req->reports_count > 0)
                                <a href="{{ route('admin.requests.reports', $req) }}" class="btn btn-outline btn-sm" style="margin-left:8px; display:inline-block;">
                                    View ({{ $req->reports_count }})
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8">
                        <div class="empty-state">
                            <div class="icon">ðŸ“‹</div>
                            <h3>No requests found</h3>
                            <p>Requests will appear here when care homes submit them.</p>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!--<div id="report-modal" class="modal-backdrop" style="display:none;">-->
<!--    <div class="modal-panel">-->
<!--        <div class="modal-header">-->
<!--            <h3>Add request report</h3>-->
<!--            <button type="button" class="btn btn-sm btn-outline" onclick="closeReportModal()">Close</button>-->
<!--        </div>-->
<!--        <form id="report-form" method="POST" action="" enctype="multipart/form-data">-->
<!--            @csrf-->
<!--            <div class="form-group">-->
<!--                <label>For request</label>-->
<!--                <div id="report-request-label" style="font-weight:700;color:var(--gray-700);"></div>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="file">Upload file</label>-->
<!--                <input id="file" type="file" name="file" accept=".pdf,.doc,.docx,image/*" required>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="note">Note</label>-->
<!--                <textarea id="note" name="note" placeholder="Add a note for this report"></textarea>-->
<!--            </div>-->
<!--            <div style="display:flex;gap:10px;justify-content:flex-end;">-->
<!--                <button type="button" class="btn btn-outline btn-sm" onclick="closeReportModal()">Cancel</button>-->
<!--                <button type="submit" class="btn btn-teal btn-sm">Submit report</button>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->



<div id="report-modal" class="modal-backdrop" style="display:none;">
    <div class="modal-panel">
        <div class="modal-header">
            <h3>Add request report</h3>
            <button type="button" class="btn btn-sm btn-outline" onclick="closeReportModal()">Close</button>
        </div>

        <form id="report-form" enctype="multipart/form-data" >
            @csrf

            <input type="hidden" id="request_id" name="request_id">

            <div class="form-group">
                <label>For request</label>
                <div id="report-request-label" style="font-weight:700;"></div>
            </div>

            <div class="form-group">
                <label for="file">Upload file</label>
                <input id="file" type="file" name="file" required>
                <small class="error" id="file-error"></small>
            </div>

            <div class="form-group">
                <label for="note">Note</label>
                <textarea id="note" name="note"></textarea>
                <small class="error" id="note-error"></small>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" class="btn btn-outline btn-sm" onclick="closeReportModal()">Cancel</button>
                <button type="submit" class="btn btn-teal btn-sm" id="submit-btn">
                    Submit report
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openReportModal(requestId, residentName, url) {
        document.getElementById('report-modal').style.display = 'flex';
        document.getElementById('request_id').value = requestId;
        document.getElementById('report-request-label').textContent = 'Resident: ' + residentName;
        document.getElementById('report-form').action = url;
    
        clearErrors();
    }
    
    function closeReportModal() {
        document.getElementById('report-modal').style.display = 'none';
        document.getElementById('report-form').reset();
    }
    
    function clearErrors() {
        document.querySelectorAll('.error').forEach(el => el.textContent = '');
    }
    
    document.getElementById('report-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let url = document.getElementById('report-form').action
        let form = this;
        let requestId = document.getElementById('request_id').value;
        let submitBtn = document.getElementById('submit-btn');
    
        clearErrors();
    
        let formData = new FormData(form);
    
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
    
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        }).then(async res => {
            let data = await res.json();

            if (!res.ok) {
                if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        let el = document.getElementById(key + '-error');
                        if (el) el.textContent = data.errors[key][0];
                    });
                }
                throw new Error('Validation failed');
            }
            location.reload();
            return data;
        }).then(data => {
            alert('Report submitted successfully ✅');
            closeReportModal();
    
            // OPTIONAL: refresh part of page instead of reload
            location.reload();
        })
        .catch(err => {
            console.error(err);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit report';
            location.reload();
        });
    });
</script>

<style>
    .modal-backdrop {
        position:fixed;
        inset:0;
        background:rgba(15,23,42,0.55);
        display:flex;
        align-items:center;
        justify-content:center;
        padding:20px;
        z-index:999;
    }
    .modal-panel {
        background:white;
        border-radius:18px;
        max-width:520px;
        width:100%;
        padding:24px;
        box-shadow:0 20px 60px rgba(15,23,42,0.18);
    }
    .modal-header {
        display:flex;
        align-items:center;
        justify-content:space-between;
        margin-bottom:18px;
    }
    .modal-header h3 {
        margin:0;
        font-size:18px;
        color:var(--navy);
    }
</style>

<div class="pagination">{{ $requests->links() }}</div>

@endsection
