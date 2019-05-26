<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Checklist;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ChecklistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the checklist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function view(User $user, Checklist $checklist)
    {
        //
        return $user->id == $checklist->user_id;
    }

    /**
     * Determine whether the user can create checklists.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the checklist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function update(User $user, Checklist $checklist)
    {
        //
        return $user->id == $checklist->user_id;
    }

    /**
     * Determine whether the user can delete the checklist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
     
    public function delete(User $user, Checklist $checklist)
    {
        //
        return $user->id == $checklist->user_id;
    }

    /**
     * Determine whether the user can restore the checklist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function restore(User $user, Checklist $checklist)
    {
        //
        return $user->id == $checklist->user_id;
    }

    /**
     * Determine whether the user can permanently delete the checklist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function forceDelete(User $user, Checklist $checklist)
    {
        //
        return $user->id == $checklist->user_id;
    }
}
