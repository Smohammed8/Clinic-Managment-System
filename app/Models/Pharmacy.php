<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'admin_id',
        'campus_id',
        'status',
        'description',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function itemsInPharmacies()
    {
        return $this->hasMany(ItemsInPharmacy::class);
    }

    public function pharmacyUsers()
    {
        return $this->hasMany(PharmacyUser::class);
    }

    public function itemRequests()
    {
        return $this->hasMany(ItemRequest::class);
    }
}
