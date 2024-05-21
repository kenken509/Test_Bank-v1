<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SubjectCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectCodeController extends Controller
{
    public function showSubjectCodes()
    {
        $codes = SubjectCode::with('department','division')->latest()->get();
        //dd($codes);
        return inertia('Dashboard/SubjectCodes/SubjectCodesAll',[
            'codes' => $codes,
        ]);
    }

    public function showAddSubjectCode()
    {
        
        $departments = Department::with('divisions')->latest()->get();
        
        return inertia('Dashboard/SubjectCodes/SubjectCodeAdd',[
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|unique:subject_codes',
        ],[
            'name' => 'Existing code detected, please try different code.'
        ]);
        $newSubjectCode = new SubjectCode();

        $newSubjectCode->name = $request->name;
        $newSubjectCode->description = $request->description;
        $newSubjectCode->department_id = $request->department_id;
        $newSubjectCode->division_id = $request->division_id;
        $newSubjectCode->save();

        return redirect()->route('subject.codes.show')->with('success', 'Successfully added new subject code.');

    }

    public function updateShow($id)
    {
        $codeToUpdate = SubjectCode::with(['department', 'division'])->findOrFail($id);
        $departments = Department::with('divisions')->latest()->get();
        
        return inertia('Dashboard/SubjectCodes/SubjectCodeUpdate', [
            'codeToUpdate' => $codeToUpdate,
            'departments'   => $departments, 
        ]);
    }   



    public function destroy($id)
    {
        
        try{

            DB::beginTransaction();
            $subjectCode = SubjectCode::findOrFail($id);

            $subjectCode->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Successfully deleted subject code.');
        }
        catch(\Exception $e)
        {
            DB::rollback();

            Log::error('Error deleting subject code: '.$e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete subject code.');
        }
        
    }
}
