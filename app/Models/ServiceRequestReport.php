<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequestReport extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'service_request_id',
        'file_name',
        'file_path',
        'note',
        'uploaded_by',
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
