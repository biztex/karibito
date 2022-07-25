<?php

namespace App\Services;

use App\Models\MCommissionRate;
use Carbon\Carbon;

class AdminMCommissionRateService
{
    /**
     * 手数料変更
     */
    public function createMCommissionRate($request)
    {
        MCommissionRate::create([
            'rate'                  => $request->rate,
            'effective_datetime'    => Carbon::now(),
        ]);
    }
}
