@extends('layouts.app')
@section('page-title', 'Add Resident')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.residents.index') }}">Residents</a>
    <span>â€º</span> Add New
</div>

<div class="card" style="max-width:680px">
    <div class="card-header"><h3>ðŸ‘¤ Add New Resident</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.residents.store') }}">
            @csrf

            @if($id === null)
            <div class="form-group">
                <label>Care Home <span style="color:var(--danger)">*</span></label>
                <select name="care_home_id" required>
                    <option value="">— Select care home —</option>
                    @foreach($careHomes as $home)
                        <option value="{{ $home->id }}" {{ old('care_home_id') == $home->id ? 'selected' : '' }}>
                            {{ $home->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @else
            <input type="hidden" name="care_home_id" value="{{ $id }}">
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label>First Name <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="e.g. Margaret" required>
                </div>
                <div class="form-group">
                    <label>Last Name <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="e.g. Thompson" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Date of Birth <span style="color:var(--danger)">*</span></label>
                    <input type="date" name="dob" value="{{ old('dob') }}">
                </div>
                <div class="form-group">
                    <label>Funding Status</label>
                    <select name="funding_status" id="funding_status" class="form-controll"> 
                        <option value="Funded"> Funded </option>
                        <option value="Private"> Private </option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Last Eye Test Date </label>
                    <input type="date" name="last_eye_test" value="{{ old('last_eye_test') }}">
                </div>
                <div class="form-group">
                    <label>Next Recall Date  </label>
                    <input type="date" name="next_recall_date" value="{{ old('next_recall_date') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Clinical Notes</label>
                <textarea name="notes" placeholder="Any relevant clinical notes...">{{ old('notes') }}</textarea>
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn btn-primary">Add Resident</button>
                <a href="{{ route('admin.residents.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
