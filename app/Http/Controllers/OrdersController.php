<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    function index()
    {
        // $orders = auth()->user()->order;
        if (Session::has('rating')) {
            $ratingserviceid = Session::get('rating')['order']->service_id;
        } else {
            $ratingserviceid = null;
        }

        $orders = Order::where('user_id', auth()->id())->with('service')->get();
        // dd($orders[0]->service);
        return view('order.index', compact('orders', 'ratingserviceid'));
    }
    function show(Service $service)
    {
        $choice = 1;
        $total = $service->price;
        return view('order.show', compact('service', 'total', 'choice'));
    }
    function pay(Service $service)
    {
        $price = request()->price;
        return view('order.order', compact('service', 'price'));
    }
    public function store(Request $request)
    {
        // dd(request()->all());
        $carts = Cart::where('user_id', auth()->id())->get();
        foreach ($carts as $cart) {
            $order = new Order;
            $order->user_id = auth()->id();
            $order->status = 'Pending';
            $order->payment_method = $request->payment;
            $order->payment_status = 'Done';
            $order->service_id = $cart->service_id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->phone_num = $request->phone;
            $order->notes = $request->notes;
            $order->country = $request->country;
            if ($order->save()) {
                $cart->delete();
            };
        };
        return redirect('/')->with('success', 'Photos have been ordered');
    }
    function changeQuantity(Service $service)
    {
        $choice = request()->quantity;
        $total = $choice * $service->price;
        return view('order.show', compact('service', 'total', 'choice'));
    }
}
