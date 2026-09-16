<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CareHome extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = [
        'name',
        'address',
        'manager_name',
        'email',
        'phone',
    ];

    // ─── Relationships ───────────────────────────────────────────

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function activeResidents()
    {
        return $this->hasMany(Resident::class)->where('is_active', true);
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // ─── Stats Helpers ───────────────────────────────────────────

    public function getOverdueCountAttribute(): int
    {
        return $this->activeResidents()->where('status', 'overdue')->count();
    }

    public function getDueCountAttribute(): int
    {
        return $this->activeResidents()->where('status', 'due')->count();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }
}
