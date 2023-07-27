<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSickLeave extends Model
{
    use HasFactory;
    protected $fillable = [
        'reason',
        'note',
        'medical_certificate',
        'start_date',
        'end_date',
        'student_id',
        'doctor_id',
        'encounter_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }
}
