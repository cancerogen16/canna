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
        'main_photo',
        'city',
        'address',
        'phone',
        'worktime',
        'description',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function master()
    {
        return $this->hasMany(Master::class);
    }
}
