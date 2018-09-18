<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function perfil(){
        return view('usuarios.perfil');
    }
    public function alterarFoto(Request $request ){
        $file = $request->file('avatar');

        $ext = ".png";
        $id = Auth::id();

        $name = "avatar_".$id.$ext;

        if($file->move('storage/foto', $name))
        {
            return response('ok',200);
        }
        else{

        }
    }
}
