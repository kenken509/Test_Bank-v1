<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SubjectCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function showQuestions()
    {
        // user rolse admin, co-admin, department head, faculty
        $loggedUser = Auth::user();
        
        $questions = Question::with(['options', 'author', 'subjectCode'])->latest()->get();
        
        if($loggedUser->role == 'admin' || $loggedUser->role == 'co-admin')
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
                }])->where('department_id', $loggedUser->department_id)->latest()->get();

                
            }
            
        }
        
        return inertia('Dashboard/Questions/QuestionAll', [
            'subjectCodes' => $subjectCodes,
        ]);
    }

    public function showAddQuestion()
    {
        $loggedUser = Auth::user();
        
        if($loggedUser->role == 'admin' || $loggedUser->role == 'co-admin')
        {
            $subjectCodes = SubjectCode::orderBy('id','asc')->get();
        }
        
        if($loggedUser->role == 'department head')
        {
            $subjectCodes = SubjectCode::where('department_id', $loggedUser->department_id)->orderBy('id','asc')->get();
        }

        if($loggedUser->role == 'faculty')
        {
            $hasDivision = $loggedUser->division_id;

            if($hasDivision)
            {
                $subjectCodes = SubjectCode::where('division_id', $loggedUser->division_id)->orderBy('id','asc')->get();
            }
            else
            {
                $subjectCodes = SubjectCode::where('department_id', $loggedUser->department_id)->orderBy('id','asc')->get();
            }
            
        }

        return inertia('Dashboard/Questions/QuestionAdd',[
            'subjectCodes' => $subjectCodes,
        ]);
    }

    public function destroy($id)
    {
        $questionToDelete = Question::findOrFail($id);

        

        if($questionToDelete->type == 'text')
        {
            try{
                DB::beginTransaction();

                $optionToDelete = $questionToDelete->options;

                foreach($optionToDelete as $option)
                {
                    $option->delete();
                }

                if($questionToDelete->attached_image)
                {
                    $attachedImagePath = 'public/images/'.$questionToDelete->attached_image;
                    if(Storage::exists($attachedImagePath))
                    {
                         Storage::delete($attachedImagePath);
                    }
                }

                $questionToDelete->delete();

                DB::commit();

                return redirect()->back()->with('success', 'Successfully Deleted a Question.');
            }catch(\Exception $e)
            {
                DB::rollback();
                Log::error('error deleting question: '.$e->getMessage());

                return redirect()->back()->with('error', 'Failed to delete question. Please try again.');
            }
            
        }

        if($questionToDelete->type == 'image')
        {
            try{
                DB::beginTransaction();
                $optionToDelete = $questionToDelete->options;

                foreach($optionToDelete as $option)
                {
                    $imagePath = 'public/images/'.$option->option; // Adjust 'images/' based on your file storage structure
                    if(Storage::exists($imagePath))
                    {
                         Storage::delete($imagePath);
                    }
                    
                    $option->delete();
                }

                if($questionToDelete->attached_image)
                {
                    $attachedImagePath = 'public/images/'.$questionToDelete->attached_image;
                    if(Storage::exists($attachedImagePath))
                    {
                         Storage::delete($attachedImagePath);
                    }
                }

                $questionToDelete->delete();

                DB::commit();

                return redirect()->back()->with('success', 'Successfully Deleted a Question.');
            }catch(\Exception $e)
            {
                DB::rollback();
                Log::error('error deleting question: '.$e->getMessage());

                return redirect()->back()->with('error', 'Failed to delete question. Please try again.');
            }
            
        }
    }
}
