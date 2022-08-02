<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeCardController extends Controller
{
    public function edit()
    {
        return view('member.member_config.card');
    }
    
}
