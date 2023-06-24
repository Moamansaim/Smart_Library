<?php

namespace App\Policies;

use App\Models\admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Show-role')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Create-role')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Edit-role')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can  Show-trash-role the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function archive(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Show-trash-role')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Delete-role')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Restore-role')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admin $admin)
    {
        if (auth('web')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('ForceDelete-role')
            ? $this->allow()
            : $this->deny('YOU ARE NOT AUTHORIZED | FORBIDDEN');
    }
}
