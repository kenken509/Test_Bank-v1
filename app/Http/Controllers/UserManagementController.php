<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function showUsers()
    {
       
        $departments = Department::with('divisions')->latest()->get();
        $users = User::with('department', 'division')->latest()->get();

        return inertia('Dashboard/Users/UsersAll',[
            'users'         => $users,
            'departments'   => $departments,
        ]);
    }

    public function storeUser(Request $request)
    {   
        // email:'',
        // name:'',
        // role:'',
        // department:'',
        // division_id:'',
        $defaultPassword = 'Ncst1234#';
        $newUser = new User();
        
        
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($defaultPassword);
        $newUser->role = $request->role;
        $newUser->department_id = $request->department['id'];
        $newUser->division_id = $request->division_id; 
        $newUser->save();

        return redirect()->back()->with('success', 'Successfully created new user');
    }
}
