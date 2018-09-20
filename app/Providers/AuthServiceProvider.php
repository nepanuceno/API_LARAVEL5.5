<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $permissions = Permission::with('roles')->get();
        foreach($permissions as $permission)
        {
            $gate->define($permission->name, function(User $user) use ($permission) {

                return $user->hasPermission($permission);
            });
        }

        //Antes de verificar o Gate, verifica se o usuario logado é administrador, se for, retorna true.
        $gate->before(function(User $user){
           
            if( $user->hasAnyRoles('administrador')){
                return true;
            }
        });
    }
}