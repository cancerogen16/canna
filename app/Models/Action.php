<?php

namespace App\Models;

use App\Facades\ImageUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'salon_id',
        'name',
        'photo',
        'description',
        'price',
        'start_at',
        'end_at',
    ];

    /**
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * @return BelongsTo
     */
    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
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
