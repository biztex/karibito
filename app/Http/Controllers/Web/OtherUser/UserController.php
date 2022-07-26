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

use App\Services\EvaluationService;

use App\Models\JobRequest;


class UserController extends Controller
{
    private $evaluation_service;

    public function __construct(EvaluationService $evaluation_service)
    {
        $this->evaluation_service = $evaluation_service;
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
        $age = Age::group($user->userProfile->birthday);

        return view('other-user.publication', compact('user','products','job_requests', 'age'));
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
        $age = Age::group($user->userProfile->birthday);
        $id = $user->id;
        $dmrooms = Dmroom::where('to_user_id','=', $user->id)->first();

        return view('other-user.mypage', compact('user','products', 'age','dmrooms', 'job_request'));
    }

    public function skills(User $user, Dmroom $dmroom)
    {
        $skills = UserSkill::getUser($user->id)->get();
        $careers = UserCareer::getUser($user->id)->get();
        $jobs = UserJob::getUser($user->id)->first();
        $age = Age::group($user->userProfile->birthday);
        $dmrooms = Dmroom::where('to_user_id','=', $user->id)->first();

        return view('other-user.skills', compact('skills','careers','jobs','user', 'age', 'dmrooms'));
    }

    public function evaluation(User $user)
    {
        $age = Age::group($user->userProfile->birthday);

        $evaluations = $this->evaluation_service->getEvaluations($user->id);
        $counts = $this->evaluation_service->countEvaluations($user->id);

        return view('other-user.evaluation', compact('user', 'age','evaluations', 'counts'));
    }
}