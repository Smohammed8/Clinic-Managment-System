<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharmacyUser extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'pharmacy_id'];

    protected $searchableFields = ['*'];

    protected $table = 'pharmacy_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
