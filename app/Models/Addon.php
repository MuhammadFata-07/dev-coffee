<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable = ['name', 'price', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}