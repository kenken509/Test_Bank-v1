<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function showDepartment()
    {
        
        return inertia('Dashboard/Department/DepartmentAll', [
                'departments' => Department::with([
                    'departmentHeads' => function ($query) {
                    $query->where('role', 'Dep-head');
                },
                'faculty' => function ($query) {
                    $query->where('role', 'faculty');
                },
                'divisions',
            ])->get(),
        ]);
    }

    public function destroy($id)
    {
        
        try {
            $depTodelete = Department::findOrFail($id);
            $depTodelete->delete();
    
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            // Log the exception message if needed
            Log::error('Department Deletion Error: ' . $e->getMessage());
    
            // Return with an error message
            return redirect()->back()->with('error', 'Error occurred while trying to delete the department. Please try again.');
        }

    }

    
}
