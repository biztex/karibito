<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransferRequest;
use App\Services\TransferRequestService;
use App\Http\Requests\Admin\TransferRequest\ChangeRequest;

class TransferRequestController extends Controller
{
    private $transfer_request_service;

    public function __construct(TransferRequestService $transfer_request_service) 
    {
        $this->transfer_request_service = $transfer_request_service;
    }

    /**
     * 振込申請一覧
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $today = today()->year . sprintf('%02d', today()->month) . today()->day; // yyyymmdd
        $now_season = $this->transfer_request_service->getNowSeason($today);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            if ($start_date > $end_date) {
                return redirect()->back()->with('flash_msg', '開始日は終了日より前の日付を選択してください');
            }
        }

        if($start_date === null) {
            $start_date = date('Y-m-01');
        }
        if($end_date === null) {
            $end_date = date('Y-m-d');
        }

        $transfer_requests = TransferRequest::orderBy('status', 'asc')
            ->orderBy('id', 'desc');

        if ($start_date && $end_date) {
            $transfer_requests = $transfer_requests->whereBetween('created_at', [$start_date, $end_date]);
        }

        $transfer_requests = $transfer_requests->get();

        return view('admin.transfer_request.index', compact('transfer_requests', 'start_date', 'end_date', 'now_season'));
    }
    /**
     * 振込csvダウンロード
     */
    public function csvDownload(Request $request)
    {
        return $this->transfer_request_service->exportTransferRequestCsv($request->all());
    }

    /**
     * 振込申請一覧
     */
    public function season($season)
    {
        if(!preg_match('/^([0-9]{7})$/', $season) || $this->transfer_request_service->seasonCheck($season)) {
            return redirect()->route('admin.transfer_request.index');
        }

        if(substr($season, 6, 1) == 1) {
            $day = substr($season, 0, 6) . '01';
        } else {
            $day = substr($season, 0, 6) . '16';
        }
        
        $now_season = $this->transfer_request_service->getNowSeason($day);

        $transfer_requests = TransferRequest::requestSeason($season)->orderBy('status', 'asc')->orderBy('id', 'desc')->get();

        $next_season = $this->transfer_request_service->getNextSeason($season);
        $prev_season = $this->transfer_request_service->getPrevSeason($season);

        return view('admin.transfer_request.index', compact('transfer_requests', 'now_season', 'next_season', 'prev_season'));

    }

    /**
     * 振込完了にする
     * @param ChangeRequest $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function complete(ChangeRequest $request)
    {
        $this->transfer_request_service->changeStatusComplete($request->transfer_request);
        return redirect()->back()->with('flash_msg', 'チェックされた分を振込完了に更新しました');
    }

    /**
     * 振込失敗にする
     * @param ChangeRequest $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function fail(ChangeRequest $request)
    {
        $this->transfer_request_service->changeStatusFail($request->transfer_request);
        return redirect()->back()->with('flash_msg', 'チェックされた分を振込失敗に更新しました');
    }

    /**
     * 振込申請中にもどす
     * @param ChangeRequest $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function back(ChangeRequest $request)
    {
        $this->transfer_request_service->changeStatusBack($request->transfer_request);
        return redirect()->back()->with('flash_msg', 'チェックされた分を振込申請中に更新しました');
    }
}
