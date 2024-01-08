<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $table='base_profile';
    protected $fillable = [
        'schoolName',
        'address',
        'mission',
        'vision',
        'about',
        // 'updated_at', // You might not need these if you're letting Laravel handle timestamps
        // 'created_at',
    ];
}
