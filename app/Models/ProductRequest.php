<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductRequest extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['clinic_id', 'product_id'];

    protected $searchableFields = ['*'];

    protected $table = 'product_requests';

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
