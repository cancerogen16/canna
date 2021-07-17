<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'salon_id',
        'name',
        'slug',
        'photo',
        'experience',
        'description',
        'rating',
    ];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
