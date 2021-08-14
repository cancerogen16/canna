<?php

namespace App\Policies;

use App\Models\Action;
use App\Models\Master;
use App\Models\Salon;
use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ServicePolicy
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
     * @param Service $service
     * @return bool
     */
    public function create(User $user, Service $service): bool
    {
        return $user->id == $service->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Service $service
     * @return bool
     */
    public function update(User $user, Service $service, int $salon_id): bool
    {
        $new_salon = Salon::find($salon_id);
        return $user->id == $service->salon()->first()->user_id
            && $user->id == $new_salon->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Service $service
     * @return bool
     */
    public function delete(User $user, Service $service): bool
    {
        return $user->id == $service->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can edit connection with the Master model.
     *
     * @param User $user
     * @param Service $service
     * @param int $master_id
     * @return bool
     */
    public function editMasterConnection(User $user, Service $service, int $master_id): bool
    {
        $master = Master::find($master_id);
        return $user->id == $service->salon()->first()->user_id
            || $user->id == $master->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can edit connection with the Action model.
     *
     * @param User $user
     * @param Service $service
     * @param int $action_id
     * @return bool
     */
    public function editActionConnection(User $user, Service $service, int $action_id): bool
    {
        $action = Action::find($action_id);
        return $user->id == $service->salon()->first()->user_id
            || $user->id == $action->salon()->first()->user_id;
    }
}
