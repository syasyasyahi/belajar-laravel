<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    // eloquent = orm (object relation mapping)

    protected $fillable = [
        // 'app_logo',
        'app_name',
        'address',
        'phone_number'
    ];
}
