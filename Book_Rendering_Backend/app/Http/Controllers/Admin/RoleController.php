<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiServiceController;
use App\Http\Controllers\Controller;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class RoleController extends ApiServiceController
{
    public function free(User $user)
    {
        $user->syncRoles([]);
        $user->assignRole('free');
        return  $this->success($user);
    }
    public function admin(User $user)
    {
        $user->syncRoles([]);
        $user->assignRole('free');
        $user->assignRole('silver');
        $user->assignRole('gold');
        $user->assignRole('admin');
        return  $this->success($user);

    }
    public function silver(User $user)
    {
        $user->syncRoles([]);
        $user->assignRole('free');
        $user->assignRole('silver');
        return  $this->success($user);

    }
    public function gold(User $user)
    {
        $user->syncRoles([]);
        $user->assignRole('free');
        $user->assignRole('silver');
        $user->assignRole('gold');
        return  $this->success($user);

    }
}
