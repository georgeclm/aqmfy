<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    function index()
    {
        $orders = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->where('orders.user_id', auth()->id())
            ->get();
        return view('order.index', compact('orders'));
    }

    function order(User $user)
    {
        $total = DB::table('carts')
            ->join('services', 'carts.service_id', '=', 'services.id')
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
            $order->service_id = $cart->service_id;
            $order->user_id = $cart->user_id;
            $order->status = 'Pending';
            $order->payment_method = $request->payment;
            $order->payment_status = 'Pending';
            $order->description = $request->description;
            // save all the value inside the database
            $order->save();
            // after the data have been saved then delete the data from the cart
            Cart::where('user_id', auth()->id())->delete();
        }
        return redirect('/')->with('success', 'Services have been ordered');
    }
    public function buyNow(Request $request)
    {
        $order = new Order;
        $order->service_id = $request->service_id;
        $order->user_id = auth()->id();
        $order->status = 'Pending';
        $order->payment_method = $request->payment;
        $order->payment_status = 'Pending';
        $order->description = $request->description;
        $order->save();
        return redirect('/')->with('success', 'Service have been ordered');
    }
    public function orderNow(Service $service)
    {
        $total = Service::where('id', $service->id)->sum('price');
        return view('order.detail', compact('total', 'service'));
    }
}
