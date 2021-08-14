<?php

namespace App\Policies;

use App\Models\Calendar;
use App\Models\Master;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CalendarPolicy
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
     * @param Calendar $calendar
     * @return bool
     */
    public function create(User $user, Calendar $calendar): bool
    {
        return $user->id == $calendar->master()->first()->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Calendar $calendar
     * @param int $master_id
     * @return bool
     */
    public function update(User $user, Calendar $calendar, int $master_id): bool
    {
        $new_master = Master::find($master_id);
        return $user->id == $calendar->master()->first()->salon()->first()->user_id
            && $user->id == $new_master->salon()->first()->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Calendar $calendar
     * @return bool
     */
    public function delete(User $user, Calendar $calendar): bool
    {
        return $user->id == $calendar->master()->first()->salon()->first()->user_id;
    }

    /**
     * @param User $user
     * @param int $master_id
     * @return bool
     */
    public function editSchedule(User $user, int $master_id): bool
    {
        $master = Master::find($master_id);
        return $user->id == $master->salon()->first()->user_id;
    }

}
