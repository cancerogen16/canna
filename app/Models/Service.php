<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'category_id',
        'master_id',
        'title',
        'slug',
        'price',
        'duration',
        'use_break',
        'image',
        'excerpt',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function action()
    {
        return $this->hasMany(Action::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
