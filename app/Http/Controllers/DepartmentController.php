<?php

namespace App\Http\Controllers;

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
}
