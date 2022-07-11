<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

class ResumeController extends Controller
{
   public function resume()
   {
       Gate::authorize('identify');
       return  view('resume.resume');
   }
}
