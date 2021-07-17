<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'user_id',
        'title',
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'city']
            ]
        ];
    }
}
