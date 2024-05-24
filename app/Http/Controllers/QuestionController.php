<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SubjectCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function showQuestions()
    {
        // user rolse admin, co-admin, department head, faculty
        $loggedUser = Auth::user();
        
        $questions = Question::with(['options', 'author', 'subjectCode'])->latest()->get();
        
        if($loggedUser->role == 'admin' || $loggedUser == 'co-admin')
        {
            $subjectCodes = SubjectCode::with(['questions' => function ($query){
                $query->with(['author','options']);
            }])->latest()->get();
            
        }

        if($loggedUser->role == 'department head')
        {
            
            $subjectCodes = SubjectCode::with(['questions' => function ($query){
                $query->with(['author','options']);
            }])->where('department_id', $loggedUser->department_id)->latest()->get();
                
        }

        if($loggedUser->role == 'faculty')
        {
            $hasDivision = $loggedUser->division_id;
            
            if($hasDivision)
            {
                $subjectCodes = SubjectCode::with(['questions' => function ($query){
                    $query->with(['author','options']);
                }])->where('division_id', $loggedUser->division_id)->latest()->get();
            }
            else
            {
                
                $subjectCodes = SubjectCode::with(['questions' => function ($query){
                    $query->with(['author','options']);
                }])->where('division_id', $loggedUser->division_id)->latest()->get();

                
            }
            
        }
        
        return inertia('Dashboard/Questions/QuestionAll', [
            'subjectCodes' => $subjectCodes,
        ]);
    }
}
