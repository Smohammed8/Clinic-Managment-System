<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnosis extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'desc'];

    protected $searchableFields = ['*'];

    public function mainDiagnoses()
    {
        return $this->hasMany(MainDiagnosis::class);
    }
}
