<?php

namespace App\Models;

use App\Facades\ImageUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'salon_id',
        'name',
        'slug',
        'position',
        'photo',
        'experience',
        'description',
        'rating',
    ];

    /**
     * @return BelongsTo
     */
    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }

    /**
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * @return HasMany
     */
    public function calendars(): HasMany
    {
        return $this->hasMany(Calendar::class);
    }

    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @param string $imageSize
     * @return array
     */
    public function getServices(string $imageSize = 'medium'): array
    {
        $services = [];

        $servicesCollection = $this->services()->get();

        foreach ($servicesCollection as $item) {
            $item['image'] = ImageUpload::getImage($item['image'], $imageSize);

            $services[] = $item;
        }

        return $services;
    }
}
