<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VitalSign extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'temp',
        'blood_pressure',
        'pulse_rate',
        'rr',
        'weight',
        'height',
        'muac',
        'encounter_id',
        'clinic_user_id',
        'student_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'vital_signs';

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
