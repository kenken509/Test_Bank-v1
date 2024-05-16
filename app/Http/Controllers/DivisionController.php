<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Department;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function showDivision()
    {
        return inertia('Dashboard/Division/DivisionAll', [
            'division' => Division::with('department', 'faculties')->get(),
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
}
