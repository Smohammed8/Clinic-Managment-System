<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campus extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'campus';

    public function collages()
    {
        return $this->hasMany(Collage::class);
    }

    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
