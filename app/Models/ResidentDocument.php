<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResidentDocument extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'resident_id',
        'filename',
        'filepath',
        'filetype',
        'filesize',
        'uploaded_by',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
