<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'campus_id', 'description', 'status'];

    protected $searchableFields = ['*'];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function storeUsers()
    {
        return $this->hasMany(StoreUser::class);
    }

    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }

    public function productResponses()
    {
        return $this->hasMany(ProductResponse::class);
    }

    public function storesToPharmacies()
    {
        return $this->hasMany(StoresToPharmacy::class);
    }
}
