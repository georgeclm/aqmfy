<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Service;
use Illuminate\Http\Request;

class RatingsController extends Controller
{

    public function store(Request $request)
    {
        $data = request()->validate([
            'comment' => '',
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
