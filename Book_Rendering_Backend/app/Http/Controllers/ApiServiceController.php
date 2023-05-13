<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
    public function success($data,$message='')
    {
        return $this->response($data,$message);
    }

    public function error($err , $code)
    {
        return $this->response([],'',$err,$code);
    }

    public function response($data= [] , $message = '', $err= '' , $code=200)
    {
        return response()->json([
           'data' => $data,
           'message' => $message,
           'errors' => $err
        ],$code);
    }
}
