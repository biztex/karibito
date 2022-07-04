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
    public function product(User $user)
    {
        $products = Product::getUser($user->id)->publish()->notDraft()->orderBy('created_at','desc')->paginate(10);
        $age = Age::group($user->userProfile->birthday);

        return view('other-user.publication', compact('products', 'age'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productChat(Product $product)
    {
        return view('chat.buy.product', compact('product'));
    }
}
