<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransferRequest;
use App\Services\ProfitService;
use App\Services\TransferRequestService;

class TransferRequestController extends Controller
{
    private $profit_service;
    private $transfer_request_service;

    public function __construct(ProfitService $profit_service, TransferRequestService $transfer_request_service)
    {
        $this->profit_service = $profit_service;
        $this->transfer_request_service = $transfer_request_service;
    }
    

    public function store()
    {
        $this->transfer_request_service->storeTransferRequest();

        return back()->with('flash_msg', '振込申請しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransferRequest $transfer_request)
    {
        $transfer_request_details = $transfer_request->transferRequestDetails;

        return view('mypage.profit.show', compact('transfer_request', 'transfer_request_details'));
    }
}
