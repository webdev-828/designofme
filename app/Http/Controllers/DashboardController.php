<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

use App\User;
use App\Product;
use App\Order;

class DashboardController extends Controller
{
    public function index() {

    }

    public function getSellers(Request $request) {
        $users = User::select('sellername', 'selleremail', 'username', 'role')->get();
        if (!$users) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            return response()->json($users);
        }
    }

    public function getOrders(Request $request) {
        $orders = Order::select('name', 'country', 'city', 'address', 'email', 'phone', 'image', 'color', 'size', 'prize', 'sellername', 'selleremail', 'status', 'token')
                        ->leftjoin('users', 'users.id', '=', 'orders.saler_id')
                        ->leftjoin('products', 'products.id', '=', 'orders.product_id')
                        ->get();
        if (!$orders) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            return response()->json($orders);
        }

        return response()->json($orders);
    }

    public function getWithdraws(Request $request) {
        return response()->json('withdraw');
    }

    public function accept(Request $request) {
        $token = $request->get('token');
        Order::where('token', $token)
            ->update([
                'status' => '2'
            ]);
        $order = Order::where('token', $token)->first();
        $sales = User::where('id', $order->saler_id)->first()->sales + 1;
        $earing = User::where('id', $order->saler_id)->first()->earning + $order->prize * 0.9;
        User::where('id', $order->saler_id)
            ->update([
                'sales' => $sales,
                'earning' => $earing
            ]);
        $orders = Order::select('name', 'country', 'city', 'address', 'email', 'phone', 'image', 'color', 'size', 'prize', 'sellername', 'selleremail', 'status', 'token')
                        ->leftjoin('users', 'users.id', '=', 'orders.saler_id')
                        ->leftjoin('products', 'products.id', '=', 'orders.product_id')
                        ->get();
        if (!$orders) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            return response()->json($orders);
        }
        return response()->json($orders);
    }

    public function revoke(Request $request) {
        $token = $request->get('token');
        Order::where('token', $token)
            ->update([
                'status' => '3'
            ]);
        $orders = Order::select('name', 'country', 'city', 'address', 'email', 'phone', 'image', 'color', 'size', 'prize', 'sellername', 'selleremail', 'status', 'token')
                        ->leftjoin('users', 'users.id', '=', 'orders.saler_id')
                        ->leftjoin('products', 'products.id', '=', 'orders.product_id')
                        ->get();
        if (!$orders) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            return response()->json($orders);
        }
        return response()->json($orders);
    }
}
