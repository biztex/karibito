<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function show()
    {
        $good_evaluations = Evaluation::whereStar(5)->where('target_user_id', \Auth::id())->paginate(10);
        $bad_evaluations = Evaluation::whereStar(1)->where('target_user_id', \Auth::id())->paginate(10);
        $normal_evaluations = Evaluation::whereStar(2.5)->where('target_user_id', \Auth::id())->paginate(10);
        $count_good = Evaluation::whereStar(5)->where('target_user_id', \Auth::id())->count();
        $count_bad= Evaluation::whereStar(1)->where('target_user_id', \Auth::id())->count();
        $count_normal = Evaluation::whereStar(2.5)->where('target_user_id', \Auth::id())->count();
        
        
        return view('mypage.evaluation.evaluation', compact('good_evaluations','bad_evaluations','normal_evaluations', 'count_good', 'count_normal', 'count_bad'));
    }
}
