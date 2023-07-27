<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoresToPharmacy extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['pharmacy_id', 'store_id'];

    protected $searchableFields = ['*'];

    protected $table = 'stores_to_pharmacies';

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
