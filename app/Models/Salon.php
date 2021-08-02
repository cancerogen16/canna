<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'description',
        'rating',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function masters(): HasMany
    {
        return $this->hasMany(Master::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
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
