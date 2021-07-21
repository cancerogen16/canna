<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'photo',
        'description',
        'price',
        'start_at',
        'end_at',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
