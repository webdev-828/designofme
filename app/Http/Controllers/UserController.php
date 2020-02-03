<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Resources\UserCollection;
use App\User;
use App\Auth;
use App\Product;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::all());
    }

    public function checkuser(Request $request) {
        $email = $request->get('email');
        $username = $request->get('username');
        $count_email = User::where('selleremail', $email)->count();
        $count_username = User::where('username', $username)->count();
        return response()->json([
            'useremail'=>$count_email,
            'username'=>$count_username
        ]);
    }

    public function siginin(Request $request) {
        $username = $request->get('email');
        $password = md5($request->get('password'));
        $user = User::where('selleremail', $username)->where('password', $password)->first();
        if (!$user) {
            $user = User::where('username', $username)->where('password', $password)->first();
        }
        if (!$user) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            $username = $user->username;
            $userrole = $user->role;
            $token = Str::random(30);
            User::where('username', $username)
                ->update([
                    'remember_token' => $token
                ]);
            return response()
                ->json([
                    'status' => 'success',
                    'name' => $username,
                    'role' => $userrole,
                    'token' => $token
                ])
                ->cookie('token', $token, 60);
        }
    }

    public function signup(Request $request) {
        $user = new User([
            'sellername' => $request->get('name'),
            'selleremail' => $request->get('email'),
            'username' => $request->get('username'),
            'password' => md5($request->get('password')),
            'sales' => 0,
            'earning' => 0.00,
            'view' => 0,
            'role' => 0
        ]);
        if($user->save()) {
            $token = Str::random(30);
            User::where('username', $username)
                ->update([
                    'remember_token' => $token
                ]);
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

    public function fetchuser(Request $request) {
        $username = $request->get('username');
        $user = User::where('username', $username)->first();
        $results = Product::select('id')->where('user_id', $user->id)->get();
        $products = array();
        foreach ($results as $result) {
            array_push($products, $result->id);
        }
        if (!$username) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            return response()->json([
                'host' => request()->getSchemeAndHttpHost(),
                'products' => $products,
                'sales' => $user->sales,
                'earning' => $user->earning,
                'view' => $user->view
            ]);
        }
    }
}
