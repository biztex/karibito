<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Services\BankAccountService;
use App\Http\Requests\BankAccountController\UpdateRequest;

class BankAccountController extends Controller
{
    private $bank_account_service;

    public function __construct(BankAccountService $bank_account_service)
    {
        $this->bank_account_service = $bank_account_service;
    }

    public function edit()
    {
        $bank = \Auth::user()->bankAccount;
        return view('member.member_config.bank', compact('bank'));
    }

    public function update(UpdateRequest $request)
    {
        $this->bank_account_service->updateBankAccount($request->all());
        \Session::put('flash_msg','振込口座を更新しました。');
        return back();
    }

    public function destroy()
    {
        \Auth::user()->bankAccount->delete();

        \Session::put('flash_msg','振込口座情報を削除しました。');
        return back();

    }
}
