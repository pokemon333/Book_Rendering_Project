<?php

namespace App\Http\Controllers;

use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\registerRequest;
use Illuminate\Support\Facades\Validator;


class AuthController extends ApiServiceController
{

    public function login(Request $request)
     {
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email|string',
            'password' => 'required|max:28|string|min:8'
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 422);
        }else{
            $user = User::where('email', '=', $request->email)->first();
            if ($user) {
                $password = Hash::check($request->password, $user->password);
                if ($password) {
                    $token = $user->createToken('book-rendering-project');
                    return $this->success(['token' => $token->plainTextToken]);
                } else {
                    return $this->response([], 'password is incorrect', '', 401);
                }
            } else {
                return $this->response([], 'There is no user with this email', '', 401);
            }
            return $this->success($user);
        }
    return $this->success('oki');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email'=> 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required_with:password|same:password|min:8',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 422);
        }else{
                $user = User::where('email', '=', $request->email)->first();
                if ($user) {
                    return $this->response([], 'There is a user with this email', '', 401);
                } else {
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->save();
                    $user->assignRole('customer');
                    $token = $user->createToken('book-rendering-project');
                    return $this->success(['token' => $token->plainTextToken]);
                }
        }
      
    }

    public function logout(Request $request)
    {
        $user = auth('sanctum')->user();
        $user->currentAccessToken()->delete();
        return $this->success($user, 'Logout');
    }
    
}
