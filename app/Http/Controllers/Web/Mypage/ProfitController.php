<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\Profit;
use App\Services\ProfitService;
use App\Services\TransferRequestService;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    private $profit_service;
    private $transfer_request_service;

    public function __construct(ProfitService $profit_service, TransferRequestService $transfer_request_service)
    {
        $this->profit_service = $profit_service;
        $this->transfer_request_service = $transfer_request_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $not_transfer_profits = $this->profit_service->getNotTransferProfit(\Auth::id());

        $profit = $this->profit_service->getProfit($not_transfer_profits->all());

        $exist_fail = Profit::failed(\Auth::id())->exists() ? true : false;

        $transfer_request =  $this->transfer_request_service->getTransferRequest(\Auth::id());

        return view('mypage.profit.index', compact('profit', 'exist_fail', 'transfer_request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
