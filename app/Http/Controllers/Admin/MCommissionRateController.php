<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MCommissionRate;
use App\Http\Requests\Admin\MCommissionRate\StoreRequest;
use App\Services\AdminMCommissionRateService;

class MCommissionRateController extends Controller
{
    private $m_commission_rate;

    public function __construct(AdminMCommissionRateService $m_commission_rate)
    {
        $this->m_commission_rate = $m_commission_rate;
    }

   public function index()
   {
       $m_commission_rate = MCommissionRate::nowRate();
       $rate_list = MCommissionRate::orderBy('effective_datetime', 'desc')->get();

       return view('admin.commission.index', compact('m_commission_rate', 'rate_list'));
   }

   public function store(StoreRequest $request)
   {
        $this->m_commission_rate->createMCommissionRate($request);
        return back()->with('flash_msg', '手数料を変更しました！');
   }
}
