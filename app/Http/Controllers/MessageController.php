<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\MessageService;
use App\Http\Requests\Message\CreateMessageRequest;

class MessageController extends Controller
{
    protected $messageService;
    public function __construct(MessageService $messageService){
        $this->messageService = $messageService;
    }

    public function index()
    {
        $conversations = $this->messageService->getConversations();
        $users         = User::availableRecipients()->get();

        return view('messages.index', compact('conversations', 'users'));
    }

    public function create()
    {
        $users = User::availableRecipients()->get();
        return view('messages.create', compact('users'));
    }

    public function store(CreateMessageRequest $request)
    {
        $message = $this->messageService->sendMessage(
            $request->recipient_id,
            $request->content                           //IDE подписывает строку как ошибка, но ошибкой не является
        );

        $message->load('sender'); // для AJAX

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message'  => $message
            ]);
        }

        return back()->with('success', 'Сообщение отправлено!');
    }

    public function show(int $userId)
    {
        $otherUser = User::findOrFail($userId);

        $messages = $this->messageService->getChatWithUser($userId);

        return view('messages.show', compact('messages', 'otherUser'));
    }
}
