<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Evaluation;
use App\Services\EvaluationService;

class EvaluationController extends Controller
{
    private $evaluation_service;

    public function __construct(EvaluationService $evaluation_service)
    {
        $this->evaluation_service = $evaluation_service;
    }
    public function show()
    {
        $evaluations = $this->evaluation_service->getEvaluations(\Auth::id());
        $counts = $this->evaluation_service->countEvaluations(\Auth::id());

        return view('mypage.evaluation.evaluation', compact('evaluations', 'counts'));
    }
}
