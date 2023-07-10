<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicServices extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['service_name', 'service_description'];

    protected $searchableFields = ['*'];

    protected $table = 'clinic_services';

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }
}
