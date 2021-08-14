<?php

namespace App\Policies;

use App\Models\Master;
use App\Models\Salon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MasterPolicy
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
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  Master  $master
     * @return bool
     */
    public function viewRecords(User $user, Master $master): bool
    {
        return $user->id == $master->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Master $master
     * @return bool
     */
    public function create(User $user, Master $master): bool
    {
        return $user->id == $master->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Master $master
     * @param int $salon_id
     * @return bool
     */
    public function update(User $user, Master $master, int $salon_id): bool
    {
        $new_salon = Salon::find($salon_id);
        return $user->id == $master->salon()->first()->user_id
            && $user->id == $new_salon->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Master $master
     * @return bool
     */
    public function delete(User $user, Master $master): bool
    {
        return $user->id == $master->salon()->first()->user_id;
    }
}
