<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;
class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        //
        return $user->id == $task->checklist->user_id;
    }

    /**
     * Determine whether the user can create tasks.
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
     * Determine whether the user can update the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        //
        return $user->id == $task->checklist->user_id;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        //
        return $user->id == $task->checklist->user_id;
    }

    /**
     * Determine whether the user can restore the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function restore(User $user, Task $task)
    {
        //
        return $user->id == $task->checklist->user_id;
    }

    /**
     * Determine whether the user can permanently delete the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function forceDelete(User $user, Task $task)
    {
        //
        return $user->id == $task->checklist->user_id;
    }
}
