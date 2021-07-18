<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Salon extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'main_photo',
        'city',
        'address',
        'phone',
        'worktime',
        'description',
        'rating',
    ];
}
