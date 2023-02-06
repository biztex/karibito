<?php

namespace App\Http\Controllers\Web\OtherUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Dmroom;
use App\Models\UserSkill;
use App\Models\UserCareer;
use App\Models\UserJob;
use App\Models\Evaluation;
use App\Libraries\Age;
use App\Models\Blog;
use App\Services\EvaluationService;
use App\Services\PortfolioService;
use App\Models\JobRequest;
use App\Models\Portfolio;
use App\Models\PurchasedCancel;
use App\Services\UserNotificationService;

class UserController extends Controller
{
    private $evaluation_service;
    private $portfolio_service;
    private $user_notification_service;

    public function __construct(EvaluationService $evaluation_service, PortfolioService $portfolio_service, UserNotificationService $user_notification_service)
    {
        $this->evaluation_service = $evaluation_service;
        $this->portfolio_service = $portfolio_service;
        $this->user_notification_service = $user_notification_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function publication(User $user)
    {
        $products = Product::getUser($user->id)->publish()->notDraft()->orderBy('created_at','desc')->paginate(10);
        $job_requests = JobRequest::getUser($user->id)->publish()->notDraft()->orderBy('created_at','desc')->paginate(10);

        return view('other-user.publication', compact('user','products','job_requests'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function mypage(User $user)
    {
        $products = Product::getUser($user->id)->publish()->notDraft()->orderBy('created_at','desc')->paginate(10);
        $job_request = JobRequest::where('user_id', $user->id)->publish()->notDraft()->orderBy('created_at','desc')->paginate(10);
        $portfolio_list = Portfolio::where('user_id', $user->id)->get();
        $id = $user->id;
        $dmrooms = Dmroom::where('to_user_id','=', $user->id)->where('from_user_id', '=', \Auth::id())->first();
        $evaluations = $this->evaluation_service->getEvaluations($user->id);
        $counts = $this->evaluation_service->countEvaluations($user->id);
        $cancel_count = PurchasedCancel::whereHas('purchase.chatroom', function ($chatroom) use ($user){
            $chatroom->where('seller_user_id', $user->id)
                ->orWhere('buyer_user_id', $user->id);
        })->whereNotNull('cancel_date')->count();

        return view('other-user.mypage', compact('user','products', 'dmrooms', 'job_request', 'portfolio_list', 'evaluations', 'counts', 'cancel_count'));
    }

    public function skills(User $user, Dmroom $dmroom)
    {
        $skills = UserSkill::getUser($user->id)->get();
        $careers = UserCareer::getUser($user->id)->get();
        $jobs = UserJob::getUser($user->id)->first();
        $dmrooms = Dmroom::where('to_user_id','=', $user->id)->first();

        return view('other-user.skills', compact('skills','careers','jobs','user', 'dmrooms'));
    }

    public function evaluation(User $user)
    {
        $evaluations = $this->evaluation_service->getEvaluations($user->id);
        $counts = $this->evaluation_service->countEvaluations($user->id);

        return view('other-user.evaluation', compact('user', 'evaluations', 'counts'));
    }

    public function portfolio(User $user)
    {
        $portfolio_list = Portfolio::where('user_id', $user->id)->get();

        return view('other-user.portfolio.index', compact('user', 'portfolio_list'));
    }

    public function portfolioShow(User $user, Portfolio $portfolio)
    {
        $portfolio_list = Portfolio::where('user_id', $user->id)->get();
        $base_url = config('app.url');
        $url = "$base_url/user/$user->id/portfolio/$portfolio->id";

        $prev_page = $this->portfolio_service->prevPage($portfolio, $portfolio_list);
        $next_page = $this->portfolio_service->nextPage($portfolio, $portfolio_list);

        return view('other-user.portfolio.show', compact('user', 'portfolio', 'portfolio_list', 'url', 'prev_page', 'next_page'));
    }

    public function blog(User $user)
    {
        $blogs = Blog::where('user_id', $user->id)->get();

        return view('other-user.blog.index', compact('user', 'blogs'));
    }

    public function blogShow(User $user, Blog $blog)
    {
        $blogs = Blog::where('user_id', $user->id)->get();
        $base_url = config('app.url');
        $url = "$base_url/user/$user->id/blog/$blog->id"; //必要ない場合削除

        return view('other-user.blog.show', compact('user', 'blog', 'blogs', 'url'));
    }
}
