<?php
namespace App\Services;

use App\Models\Profit;
use App\Models\TransferRequest;

class ProfitService
{
    /**
     * profitテーブル作成
     * @param int $user_id
     * @param int $chatroom_id
     * @param int $amount
     * 
     * @return void
     */
    public function storeProfit(int $user_id, int $chatroom_id, int $amount): void
    {
        $profit = new Profit;
        $profit->user_id = $user_id;
        $profit->chatroom_id = $chatroom_id;
        $profit->amount = $amount;
        $profit->save();
    }

    public function storeCommission(int $user_id, int $amount): void
    {
        $profit = new Profit;
        $profit->user_id = $user_id;
        $profit->chatroom_id = null;
        $profit->amount = $amount;
        $profit->save();
    }

    public function ChangeStatusRequesting(array $not_transfer_profits)
    {
        foreach($not_transfer_profits as $profit){
            $profit->status = Profit::STATUS_REQUESTING;
            $profit->save();
        }
    }

    /**
     * 振込未申請の売上を取得
     * @param int $user_id
     */
    public function getNotTransferProfit(int $user_id): object
    {
        return Profit::notTransfer($user_id)->get();
    }

    public function getProfit(array $not_transfer_profits): array
    {
        $profit = [];
        $profit['product'] = 0;
        $profit['job_request'] = 0;
        $profit['total'] = 0;

        foreach($not_transfer_profits as $value) {
            if($value->chatroom_id === null){
                $profit['total'] += $value->amount;
            } elseif($value->chatroom->reference_type == 'App\Models\Product') {
                $profit['product'] += $value->amount;
                $profit['total'] += $value->amount;
            } elseif($value->chatroom->reference_type == 'App\Models\JobRequest') {
                $profit['job_request'] += $value->amount;
                $profit['total'] += $value->amount;
            }
        }

        return $profit;
    }

    public function updateTransferRequest(array $not_transfer_profits, TransferRequest $transfer_request)
    {
        foreach($not_transfer_profits as $value) {
            $profit = Profit::find($value->id);
            $profit->transfer_request_id = $transfer_request->id;
            $profit->save();
        }
    }
   
    public function changeStatusComplete(Profit $profit)
    {
        $profit->status = Profit::STATUS_COMPLETE;
        $profit->save();
    }

    public function changeStatusNone(Profit $profit)
    {
        $profit->status = Profit::STATUS_NONE;
        $profit->save();
    }

   
    
}