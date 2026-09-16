<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'address',
        'password',
        'role',
        'care_home_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password'  => 'hashed',
        'is_active' => 'boolean',
        'phone'     => 'encrypted',
        'address'   => 'encrypted',
    ];

    // ─── Relationships ───────────────────────────────────────────

    public function careHome()
    {
        return $this->belongsTo(CareHome::class);
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'requested_by');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // ─── Role Helpers ────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCareHome(): bool
    {
        return $this->role === 'carehome';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }
}
