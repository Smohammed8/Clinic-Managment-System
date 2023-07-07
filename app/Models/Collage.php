<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collage extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'campus_id'];

    protected $searchableFields = ['*'];

    protected $table = 'collage';

    public function campus()
    {
        return $this->belongsTo(Campus::class);
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
