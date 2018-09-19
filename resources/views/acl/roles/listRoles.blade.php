@extends('layouts.master')

@section('cssLink')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('roles', 'active')
@section('manage', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Funções de Usuários
        <small>Listagem</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Funções de Usuários</a></li>
        <li class="active">Listagem</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
        <a class="btn btn-app text-green" href="formRoles">
            <i class="fa  fa-plus"></i>Adicionar
        </a>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listagem</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="roles" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th colspan = "2" style="text-align:center;"><h3>Informações</h3></th>
                            <th rowspan = "2" style="text-align:center;" style="width:10%"><h3>Ações</h3></th>
                        </tr>
                        <tr>
                            <th>Função</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->label }}</td>
                            <td style="text-align:center; width=2%;">
                                <a class="btn btn-app text-green btn-vincula" href="/rolesPermission/{{ $role->id }}">
                                    <i class="fa fa-chain "></i>Vincular Permissões
                                </a>

                                <a class="btn btn-app text-red btn-remove" data-name="{{ $role->name }}" data-id="{{ $role->id }}">
                                    <i class="fa fa-remove"></i>Remover
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>Não há Funções cadastradas até o momento</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@section('JavaScript')
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
  $(function () {
    $('#roles').DataTable({
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
        },
        "scrollX": true,
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
            text: "Deseja realmente remover a função "+strFuncao,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
        }).then((result) => {
            if (result.value) {
                window.location="/deleteRoles/"+id
            }
        })
    });
});

  
</script>
@endsection