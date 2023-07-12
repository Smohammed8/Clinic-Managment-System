<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabTestRequestGroup extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'status',
        'priority',
        'notification',
        'call_status',
        'requested_at',
        'clinic_user_id',
        'encounter_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'lab_test_request_groups';

    protected $casts = [
        'requested_at' => 'datetime',
    ];



    public function Requestedby()
    {
        return $this->belongsTo(ClinicUser::class, 'clinic_user_id');
    }

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function labTestRequests()
    {
        return $this->hasMany(LabTestRequest::class);
    }
}
