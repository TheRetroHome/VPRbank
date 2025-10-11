<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $users = User::where('id', '!=', Auth::id())->get();

        $messages = Message::where('sender_id', $userId)
        ->orWhere('recipient_id', $userId)
        ->with('sender', 'recipient')
        ->paginate(15);

        $conversations = $messages->groupBy(function ($message) use ($userId) {
            return $message->sender_id === $userId ? $message->recipient_id : $message->sender_id;
        })->map(function ($group) {
            return $group->sortByDesc('created_at')->first();
        })->values();

        return view('messages.index', compact('conversations', 'users'));
    }   

    public function create(){
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
{
    $message = Message::create([
        'sender_id'     => Auth::id(),
        'recipient_id'  => $request->recipient_id,
        'content'       => $request->content,
        'is_read'       => false,
    ]);

    // Загружаем отношения для правильного отображения
    $message->load('sender');

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    return back();
}

    public function show($userId){
        $currentUser = Auth::user();
        $otherUser = User::findOrFail($userId);


    $messages = Message::where(function ($query) use ($currentUser, $userId) {
        $query->where('sender_id', $currentUser->id)
              ->where('recipient_id', $userId);
    })->orWhere(function ($query) use ($currentUser, $userId) {
        $query->where('sender_id', $userId)
              ->where('recipient_id', $currentUser->id);
    })
    ->orderBy('created_at', 'asc')
    ->get();

    Message::where('sender_id', $userId)
        ->where('recipient_id', $currentUser->id)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return view('messages.show', compact('messages', 'otherUser'));
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
