<?php

namespace App\Services;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MessageService
{
    /**
     * Получить список диалогов текущего пользователя (по одному последнему сообщению)
     */
    public function getConversations(): Collection
    {
        $userId = Auth::id();

        $messages = Message::where('sender_id', $userId)
                           ->orWhere('recipient_id', $userId)
                           ->with('sender', 'recipient')
                           ->get();

        return $messages
            ->groupBy(fn ($msg) => $msg->sender_id === $userId ? $msg->recipient_id : $msg->sender_id)
            ->map(fn ($group) => $group->sortByDesc('created_at')->first())
            ->values();
    }

    /**
     * Получить все сообщения между текущим пользователем и собеседником + отметить как прочитанные
     */
    public function getChatWithUser(int $otherUserId): Collection
    {
        $currentUserId = Auth::id();

        $messages = Message::where(function ($q) use ($currentUserId, $otherUserId) {
            $q->where('sender_id', $currentUserId)->where('recipient_id', $otherUserId);
        })->orWhere(function ($q) use ($currentUserId, $otherUserId) {
            $q->where('sender_id', $otherUserId)->where('recipient_id', $currentUserId);
        })
                           ->orderBy('created_at', 'asc')
                           ->with('sender')
                           ->get();

        // Помечаем входящие сообщения как прочитанные
        Message::where('sender_id', $otherUserId)
               ->where('recipient_id', $currentUserId)
               ->where('is_read', false)
               ->update(['is_read' => true]);

        return $messages;
    }

    /**
     * Создать новое сообщение
     */
    public function sendMessage(int $recipientId, string $content): Message
    {
        return Message::create([
            'sender_id'    => Auth::id(),
            'recipient_id' => $recipientId,
            'content'      => $content,
            'is_read'      => false,
        ]);
    }
}