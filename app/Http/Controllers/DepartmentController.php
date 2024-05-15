<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function showDepartment()
    {
        return inertia('Dashboard/Department/DepartmentAll');
    }
}
