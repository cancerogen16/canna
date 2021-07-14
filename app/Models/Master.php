<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $fillable = [
        'salon_id',
        'name',
        'slug',
        'photo',
        'experience',
        'description',
        'rating',
        'created_at',
    ];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

}
