<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\TransferRequest;
use App\Services\TransferRequestService;

class TransferRequestController extends Controller
{
    private $transfer_request_service;

    public function __construct(TransferRequestService $transfer_request_service)
    {
        $this->transfer_request_service = $transfer_request_service;
    }
    
    /**
     * 振込申請
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        \DB::transaction(function (){
            $this->transfer_request_service->storeTransferRequest();
            \Session::put('flash_msg','振込申請しました');
        });
        return back();
    }

    /**
     * 振込申請内訳
     * @param TransferRequest $transfer_request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(TransferRequest $transfer_request)
    {
        return view('mypage.profit.show', compact('transfer_request'));
    }
}
