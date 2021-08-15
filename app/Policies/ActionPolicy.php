<?php

namespace App\Policies;

use App\Models\Action;
use App\Models\Salon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ActionPolicy
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
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Action $action
     * @return bool
     */
    public function create(User $user, Action $action): bool
    {
        return $user->id == $action->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Action $action
     * @param int $salon_id
     * @return bool
     */
    public function update(User $user, Action $action, int $salon_id): bool
    {
        $new_salon = Salon::find($salon_id);
        return $user->id == $action->salon()->first()->user_id
            && $user->id == $new_salon->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Action $action
     * @return bool
     */
    public function delete(User $user, Action $action): bool
    {
        return $user->id == $action->salon()->first()->user_id;
    }


}