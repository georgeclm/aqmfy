<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.container');
    }
    public function create()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $profiles = Seller::whereIn('user_id', $users)->with('user')->latest()->get();
        // dd($profiles);
        return view('chat.create', compact('profiles'));
    }
    public function rooms()
    {
        $userID = auth()->id();
        $room = ChatRoom::where('collection_id', 'LIKE', "%$userID%")->get();
        return $room;
    }
    public function messages($roomId)
    {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new ChatMessage;
        $newMessage->user_id = auth()->id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();
        return $newMessage;
    }

    public function store(Request $request)
    {
        $users = implode("", $request->checked) . auth()->id();
        $newRoom = new ChatRoom;
        $newRoom->name = $request->name;
        $newRoom->collection_id = $users;
        $newRoom->save();
        return redirect()->route('chat')->with('success', 'New Room have been created');
    }
    public function chat(User $user)
    {
        $roomName = $user->profile->title . ' with ' . auth()->user()->profile->title;
        $userID = $user->id;
        $haveRoom = DB::table('chat_room_user')
            ->join('chat_rooms', 'chat_room_user.chat_room_id', '=', 'chat_rooms.id')
            ->where('user_id', auth()->id())
            ->where('collection_id', 'LIKE', "%$userID%")
            ->count();
        // dd($haveRoom);
        // dd($user->id . auth()->id());
        if ($haveRoom == 0) {
            // dd("create new room");
            $id = $user->id . auth()->id();
            $newRoom = new ChatRoom;
            $newRoom->name = $roomName;
            $newRoom->collection_id = $id;
            $newRoom->save();
            // dd($newRoom->id);
            auth()->user()->chatroom()->attach($newRoom->id);
            $user->chatroom()->attach($newRoom->id);
        }
        return redirect()->route('chat')->with('success', 'Check Your Room with ' . $user->profile->title);
    }
}
