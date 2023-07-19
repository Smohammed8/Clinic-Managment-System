<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemRequest extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['pharmacy_id', 'product_id', 'amount'];

    protected $searchableFields = ['*'];

    protected $table = 'item_requests';

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
