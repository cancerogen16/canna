<?php

namespace App\Models;

use App\Facades\ImageUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salon extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

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

    /**
     * @param string $imageSize
     * @return array
     */
    public function getMasters(string $imageSize = 'medium'): array
    {
        $masters = [];

        $mastersCollection = $this->masters()->get();

        foreach ($mastersCollection as $item) {
            $item['photo'] = ImageUpload::getImage($item['photo'], $imageSize);

            $masters[] = $item;
        }

        return $masters;
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

    /**
     * @param string $imageSize
     * @return array
     */
    public function getActions(string $imageSize = 'medium'): array
    {
        $actions = [];

        $actionsCollection = $this->actions()->get();

        foreach ($actionsCollection as $item) {
            $item['photo'] = ImageUpload::getImage($item['photo'], $imageSize);

            $actions[] = $item;
        }

        return $actions;
    }
}
