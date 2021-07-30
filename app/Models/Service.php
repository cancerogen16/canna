<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'category_id',
        'salon_id',
        'title',
        'slug',
        'price',
        'duration',
        'image',
        'excerpt',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }

    public function action(): HasMany
    {
        return $this->hasMany(Action::class);
    }
    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function masters(): BelongsToMany
    {
        return $this->belongsToMany(Master::class);
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
