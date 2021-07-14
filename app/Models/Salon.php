<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Salon extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'city',
        'address',
        'phone',
        'worktime',
        'description',
        'rating',
    ];
}
