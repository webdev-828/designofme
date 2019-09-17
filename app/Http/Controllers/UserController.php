<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Cookie;

use App\Http\Resources\UserCollection;
use App\User;
use App\Auth;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::all());
    }

    public function checkuser(Request $request) {
        $email = $request->get('email');
        $username = $request->get('username');
        $count_email = User::where('email', $email)->count();
        $count_username = User::where('username', $username)->count();
        return response()->json([
            'useremail'=>$count_email,
            'username'=>$count_username
        ]);
    }

    public function siginin(Request $request) {
        $username = $request->get('email');
        $password = md5($request->get('password'));
        $user = User::where('email', $username)->where('password', $password)->first();
        if (!$user) {
            $user = User::where('username', $username)->where('password', $password)->first();
        }
        if (!$user) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            $username = $user->username;
            $token = Str::random(30);
            return response()
                ->json([
                    'status' => 'success',
                    'name' => $username,
                    'token' => $token
                ])
                ->cookie('token', $token, 60);
        }
    }

    public function signup(Request $request) {
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'username' => $request->get('username'),
            'password' => md5($request->get('password'))
        ]);

        if($user->save()) {
            $token = Str::random(30);
            return response()
                ->json([
                    'status' => 'success',
                    'name' => $user->username,
                    'token' => $token
                ])
                ->cookie('token', $token, 60);
        }
        else
            return response()->json('failed');

    }
}
