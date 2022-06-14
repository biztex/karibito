<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
