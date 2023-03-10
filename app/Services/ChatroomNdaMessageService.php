<?php

namespace App\Services;

use  App\Models\Chatroom;
use App\Models\ChatroomNdaMessage;
use Illuminate\Support\Facades\DB;

class ChatroomNdaMessageService
{
    /**
     * NDAメッセージの作成
     *
     * @param string $text
     * @param Chatroom $chatroom
     * @param object
     */
    public function storeNdaMessage(string $text, Chatroom $chatroom)
    {
        return DB::transaction(function () use ($text, $chatroom) {
            return $chatroom->chatroomNdaMessages()->create([
                'chatroom_id' => $chatroom->id,
                'send_user_id' => \Auth::id(),
                'text' => $text,
            ]);
        });
    }

    /**
     * NDAメッセージの更新
     * 
     * @param array $request
     * @param Chatroom $chatroom
     * @param ChatroomNdaMessage
     */
    public function updateNdaMessage(array $request, Chatroom $chatroom)
    {
        return DB::transaction(function () use ($request, $chatroom) {
            ChatroomNdaMessage::where('chatroom_id', $chatroom->id)->update([
                'text' => $request['text'],
                'status' => $request['status'],
            ]);
            return ChatroomNdaMessage::where('chatroom_id', $chatroom->id)->latest()->first();
        });
    }
}