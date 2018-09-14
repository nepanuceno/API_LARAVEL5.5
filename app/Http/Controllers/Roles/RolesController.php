<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
//use Symfony\Component\HttpFoundation\Request;

class RolesController extends Controller
{
    
    public function list(){
        $roles = Role::all();

        return view('acl.listRoles', compact('roles'));
    }

    public function form(Request $request){

        return view('acl.addRoles');
    }
}
