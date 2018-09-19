@extends('layouts.master')

@section('cssLink')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.css') }}">
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
                        <h3 class="box-title">Vincular</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form role="form" method="post" action="{{ route('userRolesVincular',['id'=>$user->id])}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Funções</label>
                                <select class="form-control" name="role_id" id="role_id">
                                    <option value="0">Selecione uma Função ...</option>
                                    @foreach($funcoes_nao_vinculadas as $role)
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
                <div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Funções Vinculadas a <span class="text-red"> {{ $user->name }} </span></h3>
                        </div>
                    <!-- /.box-header -->
                        <div class="box-body">
                            <table id="funcoes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Função</th>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($funcoes_vinculadas as $funcao)
                                        <tr>
                                            <td with="45%">{{ $funcao->name }}</td>
                                            <td with="50%">{{ $funcao->label }}</td>
                                            <td with="5%">
                                                <a href="#" class="btn btn-app btn-remove" data-name="{{ $funcao->name }}" data-id="{{ $funcao->id }}" data-usuario="{{ $user->id }}">
                                                    <i class="fa fa-trash text-red"></i>
                                                    Excluir
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection


@section('JavaScript')
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/alerts.js') }}"></script>
<script>
  $(function () {
    $('#funcoes').DataTable({
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
        }
    });
  })
</script>

 @if (session('status'))
    <script>
        alert_succes("{{ session('status') }}");
    </script>
  @endif

   @if(session('error'))
    <script>
        alert_error("{{ session('error') }}");
    </script>
  @endif

    <script>
        alert_confirm('btn-remove', 'Devincular Função', 'Deseja realmente remover a função', 'warning', 'userRolesDelete');
    </script>
@endsection