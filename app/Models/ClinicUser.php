<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicUser extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'encounter_id'];

    protected $searchableFields = ['*'];

    protected $table = 'clinic_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function encounter2()
    {
        return $this->belongsTo(Encounter::class, 'encounter_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function labTestRequestGroups()
    {
        return $this->hasMany(LabTestRequestGroup::class);
    }

    public function labTestRequests()
    {
        return $this->hasMany(LabTestRequest::class, 'sample_collected_by_id');
    }

    public function labTestRequests2()
    {
        return $this->hasMany(LabTestRequest::class, 'sample_analyzed_by_id');
    }

    public function labTestRequests3()
    {
        return $this->hasMany(LabTestRequest::class, 'approved_by_id');
    }

    public function mainDiagnoses()
    {
        return $this->hasMany(MainDiagnosis::class);
    }

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }
}
