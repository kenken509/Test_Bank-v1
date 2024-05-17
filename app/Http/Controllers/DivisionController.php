<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function showDivision()
    {
        return inertia('Dashboard/Division/DivisionAll', [
            'division' => Division::with('department', 'faculties')->latest()->get(),
        ]);
    }

    public function destroy($id)
    {
        

        try
        {
            $divToDelete = Division::findOrFail($id);
            $divToDelete->delete();

            return redirect()->back()->with('success', 'Successfully Deleted.');
        }
        catch(Exception $e)
        {
            // Log the exception message if needed
            Log::error('Division Deletion Error: ' . $e->getMessage());
    
            // Return with an error message
            return redirect()->back()->with('error', 'Error occurred while trying to delete the department. Please try again.');
        }
    }

    public function addDivision()
    {   
        $existingDep = Department::latest()->get();

        return inertia('Dashboard/Division/DivisionAdd',[
            'existingDepartment' => $existingDep,
        ]);
    }

    public function storeDivision(Request $request)
    {
        

        try{

            DB::beginTransaction();

            $newDivision = new Division();

            $newDivision->name = $request->divisionName;
            $newDivision->department_id = $request->departmentId;
            $newDivision->save();

            DB::commit();

        return redirect()->back()->with('success','Successfully created new division.');
        }catch(Exception $e){

            DB::rollback();

            // Log the error details
            Log::error('Failed to create new division', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'input_data' => $request->all()
            ]);
            return redirect()->back()-with('error', 'Failed to create new division. Please try again.');
        }
        

       
    }
}
