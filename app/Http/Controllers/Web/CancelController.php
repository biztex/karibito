<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CancelController\StoreRequest;
use App\Models\Purchase;
use App\Models\PurchasedCancel;
use App\Services\PurchasedCancelService;


class CancelController extends Controller
{
    private $purchased_cancel_service;

    public function __construct(PurchasedCancelService $purchased_cancel_service)
    {
        $this->purchased_cancel_service = $purchased_cancel_service;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Purchase $purchase)
    {
        return view('chatroom.cancel.create', compact('request','purchase'));
    }

    public function back(Request $request, Purchase $purchase)
    {
        return view('chatroom.cancel.create', compact('request','purchase'));
    }

    public function confirm(StoreRequest $request)
    {
        return view('chatroom.cancel.confirm', compact('request'));
    }

    public function store(StoreRequest $request, Purchase $purchase)
    {
        $this->purchased_cancel_service->storePurchasedCancel($request->all(), $purchase);

        return redirect()->route('cancel.complete', $purchase->id);
    }

    public function complete(Purchase $purchase)
    {
        return view('chatroom.cancel.complete', compact('purchase'));
    }
}
