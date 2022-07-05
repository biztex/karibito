<?php

namespace App\Http\Controllers\Web\OtherUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Libraries\Age;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function publication(User $user)
    {
        $products = Product::getUser($user->id)->publish()->notDraft()->orderBy('created_at','desc')->paginate(10);
        $age = Age::group($user->userProfile->birthday);

        return view('other-user.publication', compact('user','products', 'age'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function mypage(User $user)
    {
        $products = Product::getUser($user->id)->publish()->notDraft()->orderBy('created_at','desc')->paginate(10);
        $age = Age::group($user->userProfile->birthday);

        return view('other-user.mypage', compact('user','products', 'age'));
    }
}
