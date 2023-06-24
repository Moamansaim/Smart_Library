<?php

namespace App\Policies;

use App\Models\User;
use App\Models\admin;
use App\Models\homePublish;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomePublishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Show-homePublish')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\homePublish  $homePublish
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, homePublish $homePublish)
    {
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Create-homePublish')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\homePublish  $homePublish
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Edit-homePublish')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can  Show-trash-book the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function archive(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Show-trash-homePublish')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\homePublish  $homePublish
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Delete-homePublish')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\homePublish  $homePublish
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Restore-homePublish')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\homePublish  $homePublish
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('ForceDelete-homePublish')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }
}
