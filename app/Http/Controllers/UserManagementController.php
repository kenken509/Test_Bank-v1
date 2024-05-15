<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function showUser()
    {
        return inertia('UserManagement/UserShow');
    }
}
