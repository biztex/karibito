<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BankAccountService;
use App\Http\Requests\BankAccountController\UpdateRequest;

class BankAccountController extends Controller
{
    private $bank_account_service;

    public function __construct(BankAccountService $bank_account_service)
    {
        $this->bank_account_service = $bank_account_service;
    }

    /**
     * 受取口座の登録・変更画面
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit()
    {
        return view('setting.bank');
    }


    /**
     * 受取口座の登録・変更処理
     * @param UpdateRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $this->bank_account_service->update($request->all());
            \Session::put('flash_msg','振込口座を更新しました。');
        });
        return back();
    }

    /**
     * 受取口座の削除
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function destroy()
    // {
    //     \DB::transaction(function () {
    //         \Auth::user()->bankAccount->delete();
    //         \Session::put('flash_msg','振込口座情報を削除しました。');
    //     });
    //     return back();
    // }
}
