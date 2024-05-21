<?php

namespace App\Http\Controllers;

use App\Models\SubjectCode;
use Illuminate\Http\Request;

class SubjectCodeController extends Controller
{
    public function showSubjectCodes()
    {
        $codes = SubjectCode::latest()->get();
        //dd($codes);
        return inertia('Dashboard/SubjectCodes/SubjectCodesAll',[
            'codes' => $codes,
        ]);
    }
}
