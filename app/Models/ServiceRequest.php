<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceRequestReport;

class ServiceRequest extends Model
{
    protected $fillable = [
        'resident_id',
        'care_home_id',
        'requested_by',
        'type',
        'priority',
        'status',
        'notes',
    ];

    // ─── Relationships ───────────────────────────────────────────

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function careHome()
    {
        return $this->belongsTo(CareHome::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function reports()
    {
        return $this->hasMany(ServiceRequestReport::class);
    }

    // ─── Badge Color Helper ──────────────────────────────────────

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'New'         => 'badge-new',
            'In Progress' => 'badge-progress',
            'Completed'   => 'badge-done',
            default       => 'badge-new',
        };
    }

    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'Eye Test'            => '👁️',
            'Replacement Glasses' => '👓',
            'Ear Wax Removal'     => '👂',
            'Hearing Care'        => '🩺',
            default               => '📋',
        };
    }
}
