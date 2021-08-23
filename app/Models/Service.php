<?php

namespace App\Models;

use App\Facades\ImageUpload;
use Cviebrock\EloquentSluggable\Sluggable;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

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

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

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
    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class);
    }

    /**
     * @return HasMany
     */
    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    /**
     * @return BelongsToMany
     */
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

    /**
     * @param string $startDatetime
     * @return string
     */
    public function getEndDatetime(string $startDatetime): DateTime
    {
        $datetimeModifier = $this->duration - 1;

        return date_modify(date_create_from_format('Y-m-d H', $startDatetime), "+ {$datetimeModifier} hours");
    }
}
