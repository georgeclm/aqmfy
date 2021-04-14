<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{

    public function store(Request $request)
    {
        Order::destroy($request->order_id);

        $data = request()->validate([
            'comment' => ['bail', 'required'],
            'rating' => 'required'
        ]);

        $rating = new Rating([
            'comment' => $data['comment'],
            'service_id' => $request->service_id,
            'user_id' => auth()->id(),
            'rating' => $data['rating']
        ]);

        $rating->save();
        return redirect()->back()->with('success', 'Thanks for your feedback.');
    }
}
