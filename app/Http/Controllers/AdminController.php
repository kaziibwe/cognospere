<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateResquest;
use auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function _construct()
    {
        $this->middleware('auth:admin-api', ['except' => ['adminlogin', 'adminregister']]);
    }


    public function adminregister(PostUpdateResquest $request,  )
    {

        $admin = Admin::create($request->all());
        if (!$admin) {
            return response()->json(['status' => false], 200);
        }
        return response()->json([$admin, 'status' => true], 200);
    }

    // admin login
    public function adminlogin(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('admin-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $token;
    }

    // admin profile
    public function profileAdmin()
    {
        return response()->json(auth()->guard('admin-api')->user());
    }


    public function logoutAdmin()
    {
        auth()->guard('admin-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
