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
        $orders = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->where('orders.user_id', auth()->id())
            ->get();
        return view('order.index', compact('orders'));
    }
    function show(Service $service)
    {
        return view('order.show', compact('service'));
    }
    function pay(Service $service)
    {
        return view('order.order', compact('service'));
    }
    public function store(Request $request)
    {
        $order = new Order;
        $order->service_id = $request->service_id;
        $order->user_id = auth()->id();
        $order->status = 'Pending';
        $order->payment_method = $request->payment;
        $order->payment_status = 'Done';
        $order->description = $request->description;
        $order->save();
        return redirect('/')->with('success', 'Service have been ordered');
    }
}
