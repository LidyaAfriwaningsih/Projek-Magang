<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchSubmissionController extends Controller
{
    public function research()
    {
        return view('research-submission.research');
    }

    public function internship()
    {
        return view('research-submission.internship');
    }//
}
