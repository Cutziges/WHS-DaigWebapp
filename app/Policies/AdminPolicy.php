<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /*
    public function add(User $user)
    {
        return $user->type === 'admin'
            ? Response::allow()
            : Response::deny('You do not have the permissions to do that.');
    }

    public function delete(User $user)
    {
        return $user->type === 'admin'
            ? Response::allow()
            : Response::deny('You do not have the permissions to do that.');
    }

    public function edit(User $user)
    {
        return $user->type === 'admin'
            ? Response::allow()
            : Response::deny('You do not have the permissions to do that.');
    }

    public function show(User $user)
    {
        return $user->type === 'admin'
            ? Response::allow()
            : Response::deny('You do not have the permissions to do that.');
    }
    */
}
