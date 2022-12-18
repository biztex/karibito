<?php
namespace App\Services;

use App\Models\Profit;
use App\Models\TransferRequest;
use App\Models\TransferRequestDetail;
use App\Services\ProfitService;
use App\Services\CsvService;
use Carbon\Carbon;

class TransferRequestService
{
    private $profit_service;
    private $csv_service;

    public function __construct(ProfitService $profit_service, CsvService $csv_service)
    {
        $this->profit_service = $profit_service;
        $this->csv_service = $csv_service;
    }

    /**
     * 振込申請作成
     */
    public function storeTransferRequest()
    {
        \DB::transaction(function () {
            // 売上テーブルに振込手数料レコード作成
            $this->profit_service->storeProfit(\Auth::id(), null, null, Profit::COMMISSION);

            // 振込未申請の売上取得
            $not_transfer_profits = $this->profit_service->getNotTransferProfit(\Auth::id());

            // 振込未申請の売上金額取得
            $profit = $this->profit_service->getProfit($not_transfer_profits->all());

            // 振込申請作成
            $transfer_request = $this->storeTransferRequestTable($profit['total']);

            // 売上テーブルを振込申請中に
            $this->profit_service->ChangeStatusRequesting($not_transfer_profits->all());

            // 振込内訳テーブル作成
            $this->storeDetails($transfer_request, $not_transfer_profits->all());
        });
    }

    /**
     * 振込内訳テーブル作成
     * @param TransferRequest $transfer_request
     * @param array $not_transfer_profits
     */
    public function storeDetails(TransferRequest $transfer_request, array $not_transfer_profits): void
    {
        foreach($not_transfer_profits as $profit){
            $detail = new TransferRequestDetail;
            $detail->transfer_request_id = $transfer_request->id;
            $detail->profit_id = $profit->id;
            $detail->save();
        }
    }

    /**
     * レコード作成
     * @param int $amount *手数料引いたもの
     * 
     * @return TransferRequest $transfer_request
     */
    public function storeTransferRequestTable(int $amount): TransferRequest
    {
        $transfer_request = new TransferRequest();
        $transfer_request->user_id = \Auth::id();
        $transfer_request->amount = $amount;
        $transfer_request->requested_at = now();
        $transfer_request->save();

        return $transfer_request;
    }

    /**
     * 指定範囲のcsvをDL
     * @param array $request
     * 
     * @return mixed
     */
    public function exportTransferRequestCsv(array $request)
    {
        $dl_transfer_requests = TransferRequest::requestDateBetween($request['date_from'], $request['date_to'])->get();
        
        if($dl_transfer_requests->isNotEmpty()) {
            $data = [];

            foreach ($dl_transfer_requests as $transfer_request) {
                $bank_account = $transfer_request->user->bankAccount;

                $array_data = [
                    $bank_account->bank_code, // 銀行コード
                    $bank_account->branch_code, // 支店コード
                    $bank_account->type, // 預金種目
                    \Crypt::decryptString($bank_account->number), // 口座番号
                    \Crypt::decryptString($bank_account->name), // 受取人名
                    $transfer_request->amount, // 振込金額
                    null, // 顧客コード
                    null, // 識別表示
                ];
                array_push($data, $array_data);
            }

            $file_name = 'GMOあおぞら用振込申請 (' . str_replace('-', '', $request['date_from']). '-' . str_replace('-', '', $request['date_to']) . ')';
            $csv_data = $this->csv_service->createCsv($data, null, $file_name);
            
            return \Response::make($csv_data['csv'], 200, $csv_data['headers']);
        } else {
            return back()->with('flash_msg', '対象の振込申請がありません。');
        }
    }

    /**
     * 振込申請を振込済にする
     * @param array $transfer_request_ids
     */
    public function changeStatusComplete(array $transfer_request_ids)
    {
        foreach($transfer_request_ids as $transfer_request_id) {
            $transfer_request = TransferRequest::find($transfer_request_id);
            $transfer_request->status = TransferRequest::TRANSFER_COMPLETED;
            $transfer_request->completed_at = now();
            $transfer_request->failed_at = null;
            $transfer_request->save();

            foreach($transfer_request->transferRequestDetails as $transfer_request_detail) {
                $this->profit_service->changeStatusComplete($transfer_request_detail->profit);
            }
        }
    }

    /**
     * 振込申請を振込失敗にする
     * @param array $transfer_request_ids
     */
    public function changeStatusFail(array $transfer_request_ids)
    {
        foreach($transfer_request_ids as $transfer_request_id) {
            $transfer_request = TransferRequest::find($transfer_request_id);
            $transfer_request->status = TransferRequest::TRANSFER_FAILURE;
            $transfer_request->completed_at = null;
            $transfer_request->failed_at = now();
            $transfer_request->save();
            foreach($transfer_request->transferRequestDetails as $transfer_request_detail) {
                $this->profit_service->changeStatusNone($transfer_request_detail->profit);
            }
        }
    }

    /**
     * 振込申請を申請中に戻す
     * @param array $transfer_request_ids
     */
    public function changeStatusBack(array $transfer_request_ids)
    {
        foreach($transfer_request_ids as $transfer_request_id) {
            $transfer_request = TransferRequest::find($transfer_request_id);
            $transfer_request->status = TransferRequest::APPLYING;
            $transfer_request->completed_at = null;
            $transfer_request->failed_at = null;
            $transfer_request->save();
            foreach($transfer_request->transferRequestDetails as $transfer_request_detail) {
                $this->profit_service->changeStatusNone($transfer_request_detail->profit);
            }
        }
    }

    /**
     * 振込申請一覧取得
     * @param int $user_id
     * 
     * @return object
     */
    public function getTransferRequest(int $user_id): object
    {
        return TransferRequest::userTransferRequest($user_id)->orderBy('id', 'desc')->paginate(15);
    }
    
    /**
     * 年月旬の取得
     * @param string $yyyymmdd
     * 
     * @return array $now_season
     */
    public function getNowSeason(string $yyyymmdd): array
    {
        $year = substr($yyyymmdd, 0, 4);
        $month = substr($yyyymmdd, 4, 2);
        $day = (int)substr($yyyymmdd, 6, 2);
        $carbon = new Carbon($year . '-' . $month . '-01');

        if($day < 16) {
            $now_season['num'] = $year . $month . TransferRequest::EARLY_MONTH;
            $now_season['string'] = $year.'年'.$month.'月'.TransferRequest::MONTH_SEASON[TransferRequest::EARLY_MONTH];
            $now_season['from'] = $year . '-' . $month . '-01';
            $now_season['to'] = $year . '-' . $month . '-15';
        } else {
            $now_season['num'] = $year . $month . TransferRequest::LATE_MONTH;
            $now_season['string'] = $year.'年'.$month.'月'.TransferRequest::MONTH_SEASON[TransferRequest::LATE_MONTH];
            $now_season['from'] = $year . '-' . $month . '-16';
            $now_season['to'] = $carbon->endOfMonth()->toDateString();
        } 

        return $now_season;
    }

    /**
     * 次の年月旬を取得
     * @param string
     * 
     * @return array $next_season
     */
    public function getNextSeason(string $data): array
    {
        $year = substr($data, 0, 4);
        $month = substr($data, 4, 2);
        $season = substr($data, 6, 1);

        $now_month_string = $year. '-' . $month;
        $now_month = new Carbon($now_month_string);

        if($season == TransferRequest::EARLY_MONTH) {
            $next_season['num'] = $year . $month . TransferRequest::LATE_MONTH;
            $next_season['string'] = $year.'年'.$month.'月'.TransferRequest::MONTH_SEASON[TransferRequest::LATE_MONTH];

        } else {
            $next_month = $now_month->addMonth(1);
            $year = $next_month->year;
            $month = sprintf('%02d', $next_month->month);

            $next_season['num'] = $year . $month . TransferRequest::EARLY_MONTH;
            $next_season['string'] = $year.'年'.$month.'月'.TransferRequest::MONTH_SEASON[TransferRequest::EARLY_MONTH];
        }
       
        return $next_season;
    }

    /**
     * 前の年月旬を取得
     * @param string
     * 
     * @return array $prev_season
     */
    public function getPrevSeason(string $data): array
    {
        $year = substr($data, 0, 4);
        $month = substr($data, 4, 2);
        $season = substr($data, 6, 1);

        $now_month_string = $year. '-' . $month;
        $now_month = new Carbon($now_month_string);

        if($season == TransferRequest::LATE_MONTH) {
            $prev_season['num'] =  $year . $month . TransferRequest::EARLY_MONTH;
            $prev_season['string'] = $year.'年'.$month.'月'.TransferRequest::MONTH_SEASON[TransferRequest::EARLY_MONTH];

        } else {
            $prev_month = $now_month->subMonth(1);
            $year = $prev_month->year;
            $month = sprintf('%02d', $prev_month->month);

            $prev_season['num'] = $year . $month . TransferRequest::LATE_MONTH;
            $prev_season['string'] = $year.'年'.$month.'月'.TransferRequest::MONTH_SEASON[TransferRequest::LATE_MONTH];
        }
       
        return $prev_season;
    }

    /**
     * パラメータが現在と一致するかの確認
     * @param string $season
     * 
     * @return bool
     */
    public function seasonCheck(string $season): bool
    {
        $today = today()->year . sprintf('%02d', today()->month) . today()->day; // yyyymmdd
        $now_season = $this->getNowSeason($today);
        return $season == $now_season['num'] ? true : false; 
    }
}