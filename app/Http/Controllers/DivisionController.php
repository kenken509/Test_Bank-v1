<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function showDivision()
    {
        return inertia('Dashboard/Division/DivisionAll', [
            'division' => Division::with('department', 'faculties')->get(),
        ]);
    }
}
