<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if (auth('web')->check()) return $this->deny();
        return  auth('admin')->user()->hasPermissionTo('Show-user')  ? $this->allow()
            :  $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if (auth('web')->check()) return $this->deny();
        return  auth('admin')->user()->hasPermissionTo('Create-user')  ? $this->allow()
            :  $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        if (auth('web')->check()) return $this->deny();
        return  auth('admin')->user()->hasPermissionTo('Edit-user')  ? $this->allow()
            :  $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    
    /**
     *   archive
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function archive(User $user, User $model)
    {
        if (auth('web')->check()) return $this->deny();
        return  auth('admin')->user()->hasPermissionTo('Show-trash-user')  ? $this->allow()
            :  $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        if (auth('web')->check()) return $this->deny();
        return  auth('admin')->user()->hasPermissionTo('Delete-user')  ? $this->allow()
            :  $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        if (auth('web')->check()) return $this->deny();
        return  auth('admin')->user()->hasPermissionTo('Restore-user')  ? $this->allow()
            :  $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        if (auth('web')->check()) return $this->deny();
        return  auth('admin')->user()->hasPermissionTo('ForceDelete-user')  ? $this->allow()
            :  $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }
}
