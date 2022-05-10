<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretController extends Controller
{
    /**
     * 秘訣画面1を表示する
     * 
     * @return view
     */
    public function showSecret01()
    {
        return view('sample.secret01');
    }

    /**
     * 秘訣画面2を表示する
     * 
     * @return view
     */
    public function showSecret02()
    {
        return view('sample.secret02');
    }

    /**
     * 秘訣画面3を表示する
     * 
     * @return view
     */
    public function showSecret03()
    {
        return view('sample.secret03');
    }

    /**
     * 秘訣画面4を表示する
     * 
     * @return view
     */
    public function showSecret04()
    {
        return view('sample.secret04');
    }

    /**
     * 秘訣画面5を表示する
     * 
     * @return view
     */
    public function showSecret05()
    {
        return view('sample.secret05');
    }

    /**
     * 秘訣画面6を表示する
     * 
     * @return view
     */
    public function showSecret06()
    {
        return view('sample.secret06');
    }
}
