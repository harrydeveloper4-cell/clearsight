<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Resident extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = [
        'care_home_id',
        'first_name',
        'last_name',
        'dob',
        'funding_status',
        'last_eye_test',
        'next_recall_date',
        'status',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'dob'              => 'date',
        'last_eye_test'    => 'date',
        'next_recall_date' => 'date',
        'is_active'        => 'boolean',
        // 'notes'            => 'encrypted',
    ];

    // ─── Relationships ───────────────────────────────────────────

    public function careHome()
    {
        return $this->belongsTo(CareHome::class);
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    // ─── Computed Attributes ─────────────────────────────────────

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAgeAttribute(): int
    {
        return $this->dob ? $this->dob->age : 0;
    }

    // ─── Auto-calculate status before saving ─────────────────────

    protected static function booted(): void
    {
        static::saving(function (Resident $resident) {
            if ($resident->next_recall_date) {
                $today = Carbon::today();
                $recall = Carbon::parse($resident->next_recall_date);

                if ($recall->isPast()) {
                    $resident->status = 'overdue';
                } elseif ($recall->diffInDays($today, false) >= -30) {
                    $resident->status = 'due';
                } else {
                    $resident->status = 'ok';
                }
            }
        });
    }

    public function documents()
    {
        return $this->hasMany(ResidentDocument::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }
}
