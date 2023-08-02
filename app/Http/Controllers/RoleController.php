<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //
    public function index()
    {
        $role = array();
        return view('admin.dashboard.role', [
            "title" => "Role",
            "role" => Role::all()
            // dd(["role" => Role::all()]),
        ]);
    }
}