<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreUser extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'store_id'];

    protected $searchableFields = ['*'];

    protected $table = 'store_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
