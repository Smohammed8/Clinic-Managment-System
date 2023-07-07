<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'a_date',
        'reason',
        'status',
        'encounter_id',
        'clinic_user_id',
        'student_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'a_date' => 'datetime',
        'encounter_id' => 'boolean',
    ];

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
