<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'subjective',
        'objective',
        'assessment',
        'plan',
        'encounter_id',
        'clinic_user_id',
        'student_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'medical_records';

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function Doctor()
    {
        return $this->belongsTo(ClinicUser::class, 'clinic_user_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
