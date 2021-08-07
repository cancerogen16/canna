<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RecordPolicy
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
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role()->first()->id == 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Record $record
     * @return Response|bool
     */
    public function view(User $user, Record $record)
    {
        return $user->id == $record->user_id ||
            $user->id == $record->service()->first()->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Record $record
     * @return Response|bool
     */
    public function create(User $user, Record $record)
    {
        return $user->id == $record->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Record $record
     * @param int $user_id
     * @return Response|bool
     */
    public function update(User $user, Record $record, int $user_id)
    {
        return $user->id == $record->user_id &&
            $user->id == $user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Record $record
     * @return Response|bool
     */
    public function delete(User $user, Record $record)
    {
        return $user->id == $record->user_id;
    }
}
