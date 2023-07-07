<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'description',
        'status',
        'is_active',
        'clinic_id',
        'encounter_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'room';

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function clinicUsers()
    {
        return $this->belongsToMany(ClinicUser::class);
    }
}
