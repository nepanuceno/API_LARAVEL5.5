<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserRolesController extends Controller
{
    private $id_user;

    public function index($id){

        $this->id_user = $id;

        $user = User::find($id);


        return view('usuarios.userRoles', compact('user'));
    }

    public function vincular(Request $request){

        dd($request);

        //$id = $this->id_user;

        //dd($id);
    }
}
