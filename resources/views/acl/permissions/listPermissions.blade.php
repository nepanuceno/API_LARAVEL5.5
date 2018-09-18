@extends('layouts.master')

@section('cssLink')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('permissions', 'active')
@section('manage', 'active')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permissões
        <small>Listagem</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Permissões</a></li>
        <li class="active">Listagem</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <a class="btn btn-app text-green" href="formPermissions">
            <i class="fa  fa-plus"></i>Adicionar
        </a>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listagem</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="permissions" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Permissão</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->label }}</td>
                                <td>
                                    <a class="btn btn-app text-red btn-remove" data-name="{{ $permission->name }}" data-id="{{ $permission->id }}">
                                        <i class="fa fa-remove"></i>Remover
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <p>Não há Permissões cadastradas até o momento</p>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

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