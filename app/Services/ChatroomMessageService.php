<?php

namespace App\Services;

use  App\Models\Chatroom;
use  App\Models\ChatroomMessage;
use App\Models\ChatroomNdaMessage;
use  App\Models\Proposal;
use  App\Models\Evaluation;
use  App\Models\Purchase;
use  App\Models\PurchasedCancel;
use  App\Models\User;
use  App\Models\UserNotification;
use Illuminate\Support\Facades\DB;

class ChatroomMessageService
{
    // 通常メッセージ
    public function storeNormalMessage(array $request, Chatroom $chatroom)
    {
        if(isset($request['file_path'])){
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
                'file_path' => $request['file_path']->store('file_paths','public')];
        } else {
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
            ];
        }

        $chatroom_message = $chatroom->chatroomMessages()->create($message);
        return $chatroom_message;
    }

    /**
     * NDAメッセージの作成
     *
     * @param ChatroomNdaMessage $nda_message
     * @param string $text
     * @return void
     */
    public function storeNdaMessage(ChatroomNdaMessage $nda_message, string $text)
    {
        DB::transaction(function () use ($nda_message, $text) {
            $nda_message->chatroomMessage()->create([
                'chatroom_id' => $nda_message->chatroom_id,
                'user_id' => \Auth::id(),
                'text' => $text,
            ]);
        });
    }

    // 提案 chatroom message テーブル
    public function storeProposalMessage(Proposal $proposal, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => 'サービスを提供しました！',
        ];
        $proposal->chatroomMessage()->create($message);
    }

    // 購入 chatroom message テーブル
    public function storePurchaseMessage(Purchase $purchase, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => 'サービスを購入しました！',
        ];
        $purchase->chatroomMessage()->create($message);
    }

    // 作業完了報告
    public function storeCompleteMessage(Chatroom $chatroom)
    {
        $message = [
            'user_id' => \Auth::id(),
            'text' => '納品が完了しました！',
            'is_complete_message' => 1,
        ];
        $chatroom->chatroomMessages()->create($message);
    }


    // 作業完了通知
    public function storeConfirmMessage(Chatroom $chatroom)
    {
        $message = [
            'user_id' => \Auth::id(),
            'text' => '「納品完了」通知を承認しました！',
            'is_complete_message' => 1,
        ];
        $chatroom->chatroomMessages()->create($message);
    }

    // 自動的に作業完了通知
    public function storeConfirmMessageByCommand(Chatroom $chatroom)
    {
        $message = [
            'user_id' => $chatroom->buyer_user_id,
            'text' => '「納品完了」通知を承認しました！',
            'is_complete_message' => 1,
        ];
        $chatroom->chatroomMessages()->create($message);
    }

    // storeRetryMessage
    public function storeRetryMessage(Chatroom $chatroom)
    {
        $message = [
            'user_id' => \Auth::id(),
            'text' => 'リトライを通知しました！',
            'is_complete_message' => 1,
        ];
        $chatroom->chatroomMessages()->create($message);
    }

    // 評価
    public function storeEvaluationMessage(Evaluation $evaluation, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => '評価が入力されました！'
        ];
        $evaluation->chatroomMessage()->create($message);
    }

    // 評価
    public function storeEvaluationMessageByCommand(Evaluation $evaluation, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => $evaluation->user_id,
            'text' => '評価が入力されました！'
        ];
        $evaluation->chatroomMessage()->create($message);
    }

    // キャンセル申請
    public function storePurchasedCancelMessage(PurchasedCancel $purchased_cancel, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => 'キャンセル申請しました！',
        ];
        $purchased_cancel->chatroomMessage()->create($message);
    }

    // キャンセル承認
    public function storePurchasedCancelApprovalMessage(PurchasedCancel $purchased_cancel)
    {
        $message = [
            'chatroom_id' => $purchased_cancel->purchase->chatroom_id,
            'user_id' => \Auth::id(),
            'text' => 'キャンセル申請を承認しました！',
        ];
        $purchased_cancel->chatroomMessage()->create($message);
    }

    // キャンセル異議申し立て
    public function storePurchasedCancelObjectionMessage(PurchasedCancel $purchased_cancel)
    {
        $message = [
            'chatroom_id' => $purchased_cancel->purchase->chatroom_id,
            'user_id' => \Auth::id(),
            'text' => '再交渉を通知しました！',
        ];
        $purchased_cancel->chatroomMessage()->create($message);
    }

    // 既読
    public function isView($chatroom)
    {
        ChatroomMessage::where('chatroom_id', $chatroom->id)->partner()->update(['is_view' => 1]);
    }

    // 商品削除メッセージ
    public function storeDeleteMessage(Chatroom $chatroom)
    {
        $message = [
            'user_id' => \Auth::id(),
            'text' => '商品を削除しました',
        ];
        $chatroom->chatroomMessages()->create($message);
    }
}