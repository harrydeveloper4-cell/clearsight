@extends('layouts.app')
@section('page-title', 'Edit Resident')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.residents.index') }}">Residents</a>
    <span>›</span>
    <a href="{{ route('admin.residents.show', $resident) }}">{{ $resident->full_name }}</a>
    <span>›</span> Edit
</div>

<div class="card" style="max-width:680px">
    <div class="card-header"><h3>✏️ Edit — {{ $resident->full_name }}</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.residents.update', $resident) }}">
            @csrf @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label>First Name <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name', $resident->first_name) }}" required>
                </div>
                <div class="form-group">
                    <label>Last Name <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name', $resident->last_name) }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Date of Birth <span style="color:var(--danger)">*</span></label>
                    <input type="date" name="dob" value="{{ old('dob', $resident->dob?->format('Y-m-d')) }}">
                </div>
                <div class="form-group">
                    <label>Funding Status</label>
                    <select name="funding_status" id="funding_status" class="form-controll"> 
                        <option value="Funded" {{ $resident->funding_status == "Funded"?"selected":'' }}> Funded </option>
                        <option value="Private" {{ $resident->funding_status == "Private"?"selected":'' }}> Private </option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Last Eye Test</label>
                    <input type="date" name="last_eye_test" value="{{ old('last_eye_test', $resident->last_eye_test?->format('Y-m-d')) }}">
                </div>
                <div class="form-group">
                    <label>Next Recall Date</label>
                    <input type="date" name="next_recall_date" value="{{ old('next_recall_date', $resident->next_recall_date?->format('Y-m-d')) }}">
                </div>
            </div>
            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes">{{ old('notes', $resident->notes) }}</textarea>
            </div>
            <div class="form-group">
                <label>Account Status</label>
                <div style="display:flex;gap:10px;align-items:center">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $resident->is_active) ? 'checked' : '' }}> Active</label>
                </div>
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.residents.show', $resident) }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
