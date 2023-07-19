<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemsInPharmacy extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['item_id', 'count', 'pharmacy_id'];

    protected $searchableFields = ['*'];

    protected $table = 'items_in_pharmacies';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
