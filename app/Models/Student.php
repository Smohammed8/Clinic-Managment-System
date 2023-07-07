<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'photo',
        'id_number',
        'encounter_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'students';

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function mainDiagnoses()
    {
        return $this->hasMany(MainDiagnosis::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
