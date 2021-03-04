<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    function index()
    {
        $userId = auth()->id();
        $orders = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->where('orders.user_id', $userId)
            ->get();
        return view('order.index', compact('orders'));
    }

    function order(User $user)
    {
        $total = DB::table('carts')
            ->join('services', 'carts.services_id', '=', 'services.id')
            ->where('carts.user_id', auth()->id())
            ->select('services.*', 'carts.id as cart_id')
            // on here use sum to sum all and the variable is the product price total
            ->sum('services.price');
        return view('order.order', compact('total'));
    }
    function store(Request $request)
    {
        // store all data inside the variable
        $allCart = Cart::where('user_id', auth()->id())->get();
        // loop through the list inside the cart and store each to the database
        foreach ($allCart as $cart) {
            // create the new model order that is already in database create the class
            $order = new Order;
            // store all the requirment inside the database
            $order->product_id = $cart->service_id;
            $order->user_id = $cart->user_id;
            $order->status = 'Pending';
            $order->payment_method = $request->payment;
            $order->payment_status = 'Pending';
            $order->address = $request->address;
            // save all the value inside the database
            $order->save();
            // after the data have been saved then delete the data from the cart
            Cart::where('user_id', auth()->id())->delete();
        }
        $request->input();
        return redirect('/')->with('success', 'Services have been ordered');
    }
    public function buyNow(Request $request)
    {
        $cart = new Cart;
        $cart->user_id = auth()->id();
        $cart->service_id = $request->service_id;
        $cart->save();
        $total = DB::table('carts')
            ->join('services', 'carts.service_id', '=', 'services.id')
            ->where('carts.service_id', $request->service_id)
            ->select('services.*', 'carts.id as cart_id')
            // on here use sum to sum all and the variable is the service price total
            ->sum('services.price');
        $serviceId = $request->service_id;
        return view('order.detail', compact('total', 'serviceId'));
    }
}
