<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockUnit extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['unit_name'];

    protected $searchableFields = ['*'];

    protected $table = 'stock_units';

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
