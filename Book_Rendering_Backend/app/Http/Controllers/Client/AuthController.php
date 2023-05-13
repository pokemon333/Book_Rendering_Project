<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiServiceController;
use Illuminate\Http\Request;
use App\Models\ClientUser;
use Illuminate\Support\Facades\Hash;
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
            $user = ClientUser::where('email', '=', $request->email)->first();
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
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:30|string',
            'email'=> 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required_with:password|same:password|min:8',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 422);
        }else{
                $user = ClientUser::where('email', '=', $request->email)->first();
                if ($user) {
                    return $this->response([], 'There is a user with this email', '', 401);
                } else {
                    $user = new ClientUser();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->save();
                    $token = $user->createToken('book-rendering-project');
                    return $this->success(['token' => $token->plainTextToken]);
                }
        }
      
    }

    // public function logout(Request $request)
    // {
    //     $user = auth('sanctum')->user();
    //     $user->currentAccessToken()->delete();
    //     return $this->success($user, 'Logout');
    // }
    
}
