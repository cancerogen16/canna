<?php

namespace App\Models;

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


    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }
}
