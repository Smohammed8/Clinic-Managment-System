<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'drug_name',
        'dose',
        'frequency',
        'duration',
        'other_info',
        'main_diagnosis_id',
       // 'encounter_id',
    ];

    protected $searchableFields = ['*'];

    public function mainDiagnosis()
    {
        return $this->belongsTo(MainDiagnosis::class);
    }

}
