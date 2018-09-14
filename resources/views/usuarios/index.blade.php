@extends('layouts.master')

@section('cssLink')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('content')
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuários
        <small>Listagem</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Usuários</a></li>
        <li class="active">Listagem</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->

      <table id="usuarios" class="table table-bordered table-striped">
      <thead>
        <tr>
            <th colspan="3"><center>Informações</center></th>
            <th colspan="2"><center>Ações</center></th>
        </tr>

        <tr>
            <th style="vertical-align: bottom;">Nome</th>
            <th style="vertical-align: bottom;">E-Mail</th>
            <th style="vertical-align: bottom;">Permissão</th>
            <th style="vertical-align: bottom;">Status</th>
            <th style="vertical-align: bottom;">Editar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $usuario)
          <tr>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>Administrador</td>
            @if($usuario->status)
              <td><a class="btn btn-app btn-status" data-status="1" href="#"><i class="fa fa-check-circle text-green"></i>Ativo</a></td>
            @else
              <td><a class="btn btn-app btn-status" data-status="0" href="#"><i class="fa fa-check-circle text-red"></i>Inativo</a></td>
            @endif

            <td><a class="btn btn-app" href="/editaUsuario/{{ $usuario->id }}"><i class="fa fa-edit"></i>Editar</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    </section>
    <!-- /.content -->
  </div>

@endsection

@section('JavaScript')
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

<script>
  $(function () {
    $('#usuarios').DataTable()
  })
</script>

<script>

  var $id = document.querySelector('.btn-status');

  $id.addEventListener('click',function(e){

    var dataStatus = this.getAttribute("data-status"); 

    if(dataStatus == 1)
      var strStatus = "Desativar";
    else
      var strStatus = "Ativar";

    swal({
      title: 'Status',
      text: "Deseja realmente "+strStatus + " este usuário",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, '+strStatus,
    }).then((result) => {
      if (result.value) {
        window.location="/updateStatusUsuario/{{ $usuario->id }}"
      }
    })

  });  
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
@endsection
