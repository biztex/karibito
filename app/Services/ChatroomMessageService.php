<?php

namespace App\Services;

use  App\Models\Chatroom;
use  App\Models\ChatroomMessage;
use  App\Models\Proposal;
use  App\Models\Evaluation;
use  App\Models\Purchase;
use  App\Models\PurchasedCancel;


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

        $chatroom->chatroomMessages()->create($message);
    }

    // 提案 chatroom message テーブル
    public function storeProposalMessage(Proposal $proposal, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => '掲載内容の提案をしました',
        ];
        $proposal->chatroomMessage()->create($message);
    }

    // 購入 chatroom message テーブル
    public function storePurchaseMessage(Purchase $purchase, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => '商品を購入しました',
        ];
        $purchase->chatroomMessage()->create($message);
    }

    // 作業完了報告
    public function storeCompleteMessage(Chatroom $chatroom)
    {
        $message = [
            'user_id' => \Auth::id(),
            'text' => '作業報告が完了しました',
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
            'text' => '評価が完了しました'
        ];
        $evaluation->chatroomMessage()->create($message);
    }

    // キャンセル申請
    public function storePurchasedCancelMessage(PurchasedCancel $purchased_cancel, Chatroom $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => 'キャンセル申請をしました',
        ];
        $purchased_cancel->chatroomMessage()->create($message);
    }

    // キャンセル承認
    public function storePurchasedCancelApprovalMessage(PurchasedCancel $purchased_cancel)
    {
        $message = [
            'chatroom_id' => $purchased_cancel->purchase->chatroom_id,
            'user_id' => \Auth::id(),
            'text' => 'キャンセル申請を承認しました',
        ];
        $purchased_cancel->chatroomMessage()->create($message);
    }

    // キャンセル異議申し立て
    public function storePurchasedCancelObjectionMessage(PurchasedCancel $purchased_cancel)
    {
        $message = [
            'chatroom_id' => $purchased_cancel->purchase->chatroom_id,
            'user_id' => \Auth::id(),
            'text' => 'キャンセル申請に異議を申し立てました',
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