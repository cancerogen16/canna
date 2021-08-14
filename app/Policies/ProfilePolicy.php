<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param User $user
     * @return void|bool
     */
    public function before(User $user)
    {
        if ($user->role()->first()->id == 1) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->role()->first()->id == 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Profile $profile
     * @return bool
     */
    public function view(User $user, Profile $profile): bool
    {
        return $user->id == $profile->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Profile $profile
     * @return bool
     */
    public function create(User $user, Profile $profile): bool
    {
        return $user->id == $profile->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Profile $profile
     * @param int $user_id
     * @return bool
     */
    public function update(User $user, Profile $profile, int $user_id): bool
    {
        return $user->id == $profile->user_id && $user->id == $user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->role()->first()->id == 1;
    }
}
