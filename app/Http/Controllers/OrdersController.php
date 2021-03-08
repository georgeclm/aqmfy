<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    function index()
    {
        // $orders = auth()->user()->order;
        // dd($orders[0]);
        $orders = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->where('orders.user_id', auth()->id())
            ->get();
        // dd($orders);
        return view('order.index', compact('orders'));
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
        $order = new Order;
        $order->quantity = $request->quantity;
        $order->service_id = $request->service_id;
        $order->user_id = auth()->id();
        $order->status = 'Pending';
        $order->payment_method = $request->payment;
        $order->payment_status = 'Done';
        $order->description = $request->description;
        $order->save();
        return redirect('/')->with('success', 'Service have been ordered');
    }
    function changeQuantity(Service $service)
    {
        $choice = request()->quantity;
        $total = $choice * $service->price;
        return view('order.show', compact('service', 'total', 'choice'));
    }
}
