@extends('layouts.app')
@section('page-title', 'Activity Logs')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">Activity Logs</div>
        <div class="section-sub">Complete audit trail of all system activities</div>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Subject</th>
                    <th>Changes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td style="white-space:nowrap">
                            <div style="font-weight:500">{{ $activity->created_at->format('d M Y') }}</div>
                            <div style="font-size:12px;color:var(--gray-500)">{{ $activity->created_at->format('H:i:s') }}</div>
                        </td>
                        <td>
                            @if($activity->causer)
                                <div style="font-weight:500">{{ $activity->causer->name }}</div>
                                <div style="font-size:12px;color:var(--gray-500)">{{ $activity->causer->email }}</div>
                            @else
                                <span style="color:var(--gray-400)">System</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $activity->description == 'created' ? 'bg-green' : ($activity->description == 'updated' ? 'bg-amber' : ($activity->description == 'deleted' ? 'bg-red' : 'bg-blue')) }}">
                                {{ ucfirst($activity->description) }}
                            </span>
                        </td>
                        <td>
                            @if($activity->subject_type)
                                @php
                                    $subjectName = class_basename($activity->subject_type);
                                @endphp
                                <div style="font-weight:500">{{ $subjectName }}</div>
                                @if($activity->subject)
                                    @if(method_exists($activity->subject, 'getFullNameAttribute'))
                                        <div style="font-size:12px;color:var(--gray-500)">{{ $activity->subject->full_name }}</div>
                                    @elseif(method_exists($activity->subject, 'name'))
                                        <div style="font-size:12px;color:var(--gray-500)">{{ $activity->subject->name }}</div>
                                    @endif
                                @endif
                                <div style="font-size:11px;color:var(--gray-400)">ID: {{ $activity->subject_id }}</div>
                            @else
                                <span style="color:var(--gray-400)">-</span>
                            @endif
                        </td>
                        <td>
                            @if($activity->properties->has('attributes') || $activity->properties->has('old'))
                                <details style="font-size:13px">
                                    <summary style="cursor:pointer;color:var(--primary)">View Changes</summary>
                                    <div style="margin-top:8px;padding:12px;background:var(--gray-100);border-radius:8px">
                                        @php
                                            $old = $activity->properties->get('old', []);
                                            $new = $activity->properties->get('attributes', []);
                                            $allAttributes = array_unique(array_merge(array_keys($old), array_keys($new)));
                                        @endphp
                                        @foreach($allAttributes as $attr)
                                            <div style="margin-bottom:6px">
                                                <span style="font-weight:600">{{ ucwords(str_replace('_', ' ', $attr)) }}:</span>
                                                @if(array_key_exists($attr, $old))
                                                    <span style="color:var(--red-600);text-decoration:line-through;margin:0 8px">{{ is_array($old[$attr]) ? json_encode($old[$attr]) : $old[$attr] }}</span>
                                                @endif
                                                →
                                                @if(array_key_exists($attr, $new))
                                                    <span style="color:var(--green-600);margin-left:8px">{{ is_array($new[$attr]) ? json_encode($new[$attr]) : $new[$attr] }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </details>
                            @else
                                <span style="color:var(--gray-400)">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state" style="padding:48px">
                                <div class="icon">📝</div>
                                <h3>No activity logs yet</h3>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="padding:16px;border-top:1px solid var(--gray-200)">
        {{ $activities->links() }}
    </div>
</div>

@endsection
