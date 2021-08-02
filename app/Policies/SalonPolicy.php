<?php

namespace App\Policies;

use App\Models\Salon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SalonPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param User $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->role()->first()->id == 1) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  Salon  $salon
     * @return Response|bool
     */
    public function viewRecords(User $user, Salon $salon)
    {
        return $user->id == $salon->user_id;
    }

    /**
     * Determine whether the user can create the model.
     *
     * @param User $user
     * @param Salon $salon
     * @return Response|bool
     */
    public function create(User $user, Salon $salon)
    {
        return $user->id == $salon->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Salon $salon
     * @return Response|bool
     */
    public function update(User $user, Salon $salon, int $user_id)
    {
        return $user->id == $salon->user_id && $user->id == $user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Salon $salon
     * @return Response|bool
     */
    public function delete(User $user, Salon $salon)
    {
        return $user->id == $salon->user_id;
    }
}
