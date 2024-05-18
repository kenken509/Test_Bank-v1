<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function showUsers()
    {
       
        $users = User::latest()->get();

        return inertia('Dashboard/Users/UsersAll',[
            'users' => $users,
        ]);
    }
}
