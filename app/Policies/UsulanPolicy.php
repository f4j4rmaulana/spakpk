<?php

namespace App\Policies;

use App\Models\UsulanPelatihan;
use Illuminate\Auth\Access\Response;
use LdapRecord\Models\OpenLDAP\User;

class UsulanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UsulanPelatihan $usulanPelatihan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UsulanPelatihan $usulanPelatihan)
    {
        return $user->id === $usulanPelatihan->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UsulanPelatihan $usulanPelatihan)
    {
        return $user->id === $usulanPelatihan->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, UsulanPelatihan $usulanPelatihan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UsulanPelatihan $usulanPelatihan)
    {
        //
    }
}
