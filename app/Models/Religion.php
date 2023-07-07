<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Religion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['religion_name'];

    protected $searchableFields = ['*'];

    protected $table = 'religion';
}
