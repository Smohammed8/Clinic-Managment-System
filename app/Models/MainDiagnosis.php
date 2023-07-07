<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainDiagnosis extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'clinic_user_id',
        'student_id',
        'encounter_id',
        'diagnosis_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'main_diagnoses';

    public function Doctor()
    {
        return $this->belongsTo(ClinicUser::class, 'clinic_user_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
