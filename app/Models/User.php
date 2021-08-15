<?php

namespace App\Models;

use App\Facades\ImageUpload;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {

        $url = 'https://spa.test/reset-password?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * @return HasMany
     */
    public function salons(): HasMany
    {
        return $this->hasMany(Salon::class);
    }

    /**
     * @return HasMany
     */
    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    /**
     * @param string $imageSize
     * @return array
     */
    public function getProfile(string $imageSize = 'medium'): array
    {
        $profile = $this->profile()->first();

        if (is_null($profile)) {
            $profile = collect([]);
        } else {
            $profile['photo'] = ImageUpload::getImage($profile['photo'], $imageSize);
        }

        return $profile->toArray();
    }

    /**
     * @param string $imageSize
     * @return array
     */
    public function getSalons(string $imageSize = 'medium'): array
    {
        $salons = [];

        $salonsCollection = $this->salons()->get();

        foreach ($salonsCollection as $item) {
            $item['main_photo'] = ImageUpload::getImage($item['main_photo'], $imageSize);

            $salons[] = $item;
        }

        return $salons;
    }
}
