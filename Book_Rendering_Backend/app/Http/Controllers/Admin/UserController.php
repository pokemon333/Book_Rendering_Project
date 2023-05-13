<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiServiceController;
use App\Http\Controllers\Controller;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends ApiServiceController
{
    public function allUser()
    {
        return $this->success(userResource::collection(User::all()));
    }
}
