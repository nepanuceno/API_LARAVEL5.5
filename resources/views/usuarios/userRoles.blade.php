@extends('layouts.master')

@section('cssLink')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('usuarios', 'active')
@section('manage', 'active')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuário<i class="fa fa-chain text-purple"></i>Funções
        <small>Vínculo</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Usuário\Funções</a></li>
        <li class="active">Vínculo</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <div class="row">
        <div class="col-md-6">
            <section class="content">
                <!-- Info boxes -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vincular<b> {{ $user->name }}</b></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form role="form" method="post" action="{{ route('userRolesVincular',['id'=>$user->id])}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Funções</label>
                                <select class="form-control">
                                    <option value="0"></option>
                                    @foreach(App\Role::all() as $role)
                                        <option value={{ $role->id }}>{{ $role->name }} - {{ $role->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-chain"></i>Vincluar</button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </section>
        </div>
    </div>
</div>

@endsection


@section('JavaScript')
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
  $(function () {
    $('#permissions').DataTable({
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
        }
    });
  })
</script>

 @if (session('status'))
    <script>
      var msg ="{{ session('status') }}"
      swal({
        position: 'top-end',
        type: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 2500
      });
    </script>
  @endif

   @if(session('error'))
    <script>
      var msg ="{{ session('status') }}"
      swal({
        position: 'top-end',
        type: 'error',
        title: msg,
        showConfirmButton: false,
        timer: 3000
      });
    </script>
  @endif

  <script>

var $funcao = document.querySelectorAll('.btn-remove');

Array.prototype.forEach.call($funcao,function(e){ 
    e.addEventListener('click',function(e){
        var strFuncao = this.getAttribute('data-name');
        var id = this.getAttribute('data-id');

        swal({
            title: 'Remover Função',
            text: "Deseja realmente remover a permissão "+strFuncao,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
        }).then((result) => {
            if (result.value) {
                window.location="/deletePermissions/"+id
            }
        })
    });
});

  
</script>
@endsection