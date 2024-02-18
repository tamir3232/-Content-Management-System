<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);



        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 2,
            'username' => $request->username,
            'status' => 'NOT ACTIVE',
        ]);


        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Success register',
                'user' => $user,

            ], 201);
        }
        return response()->json([
            'success' => false,
        ], 409);
    }



    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);
        // try
        // {

        $user = User::where('email', $request->email)->first();
        if (!$user) {

            return response()->json([
                'message' => 'User Not Found',
                'status' => False,
                'code' => 401,
            ], 401);
        }
        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken($user->id)->accessToken;
            return response()->json([
                'status' => true,
                'message' => [
                    'user' => $user,
                    'token' => $token
                ]


            ], 200);
        } else {
            return response(['status' => false, 'message' => 'Password atau Email salah, silahkan menghubungi admin']);
        }
        // } catch (\Exception $e) {
        //     return response(['status' => false, 'message'=> $e -> getMessage()]);
        // }

    }
}
