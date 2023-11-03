<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SfGuardUser extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->hasOne(Student::class, 'sf_guard_user_id', 'id');
    }
}
