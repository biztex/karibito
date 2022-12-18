<?php
namespace App\Services;

use App\Models\Profit;

class ProfitService
{
    /**
     * profitテーブル作成
     * @param int $user_id
     * @param int|null $chatroom_id
     * @param int|null $amount
     * @param int|null $commission
     * 
     * @return void
     */
    public function storeProfit(int $user_id, int|null $chatroom_id, int|null $amount, int|null $commission): void
    {
        $profit = new Profit;
        $profit->user_id = $user_id;
        if (is_null($chatroom_id)) { //振込申請するときに手数料をひく
            $profit->amount = $commission;
        } else { //chatroom_idがある時は売り上げが入る
            $profit->chatroom_id = $chatroom_id;
            $profit->amount = $amount - $commission;
        }
        $profit->save();
    }

    /**
     * ステータスを振込申請中に
     * @param array $not_transfer_profits
     */
    public function ChangeStatusRequesting(array $not_transfer_profits): void
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

    /**
     * 振込未申請の売上金額取得
     * @param array $not_transfer_profits
     * 
     * @return array $profit
     */
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

    /**
     * 売上金の振込ステータスを振込済にする
     * @param Profit $profit
     */
    public function changeStatusComplete(Profit $profit): void
    {
        $profit->status = Profit::STATUS_COMPLETE;
        $profit->save();
    }

    /**
     * 売上金の振込ステータスを未/失敗 にする
     * @param Profit $profit
     */
    public function changeStatusNone(Profit $profit): void
    {
        $profit->status = Profit::STATUS_NONE;
        $profit->save();
    }   
}