<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'quantitiy_recived',
        'quantity_despensed',
        'bach_no',
        'expire_date',
        'pack',
        'quantity_per_pack',
        'basic_unit_quantity',
        'pack_price',
        'stock_category_id',
        'stock_unit_id',
        'supplier_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'expire_date' => 'datetime',
    ];

    public function stockCategory()
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function stockUnit()
    {
        return $this->belongsTo(StockUnit::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
