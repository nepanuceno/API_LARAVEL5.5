<?php

namespace App\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use App\Http\Requests\RequestPermission;
use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate;

class PermissionsController extends Controller
{
    
    public function list(Gate $gate){
        $permissions = Permission::all();

        if( $gate->denies('manager',$permissions) )
            abort(403,'Não Autoriazado');

        return view('acl.permissions.listPermissions', compact('permissions'));
    }

    public function form(){

        return view('acl.permissions.addPermission');
    }

    public function add(RequestPermission $request, Gate $gate){
    
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->label = $request->label;

        if( $gate->denies('manager',$permission) )
            abort(403,'Não Autoriazado');

        if( $gate->denies('manager',$permission) )
            abort(403,'Não Autoriazado');

        if( $permission->save()){
            return redirect('listPermissions')->with('status', 'Permissão cadastrada com sucesso!');
        }
        else{
            return redirect('listPermissions')->with('error', 'Erro ao tentar cadastrar Permissão!');
        }
    }

    public function delete($id, Gate $gate){
        $permission = Permission::destroy($id);

        if( $gate->denies('manager',$permission) )
            abort(403,'Não Autoriazado');
       
        if($permission){
            return redirect('listPermissions')->with('status', 'Permissão removida com sucesso!');
        }
        else{
            return redirect('listPermissions')->with('error', 'Erro ao remover Permissão!');
        }
    }
}
