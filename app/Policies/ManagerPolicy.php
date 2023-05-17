<?php

namespace App\Policies;

use App\User;
use App\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function view(Manager $user, Manager $manager)
    {
    
        return $user->id === 109;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function update(User $user, Manager $manager)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function delete(User $user, Manager $manager)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function restore(User $user, Manager $manager)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function forceDelete(User $user, Manager $manager)
    {
        //
    }
}
