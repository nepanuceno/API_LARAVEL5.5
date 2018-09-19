@extends('layouts.master')

@section('cssLink')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('roles', 'active')
@section('manage', 'active')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Funções<i class="fa fa-chain text-purple"></i>Permissões
        <small>Vínculo</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Usuário\Funções</a></li>
        <li class="active">Vínculo</li>
      </ol>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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

                        <form role="form" method="post" action="{{ route('rolePermisionsVincular',['id'=>$role->id])}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Permissões</label>
                                <select class="form-control" name="permission_id" id="permission_id">
                                    <option value="0">Selecione uma Permissão ...</option>
                                    @foreach($permissions_liberadas as $permissao)
                                        <option value={{ $permissao->id }}>{{ $permissao->name }} - {{ $permissao->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-footer">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-chain"></i> 
                                    Vincluar
                                </button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Permissões Vinculadas a <span class="text-red"> {{ $role->name }} </span></h3>
                        </div>
                    <!-- /.box-header -->
                        <div class="box-body">
                            <table id="funcoes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Permissão</th>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($permissions_vinculadas as $permissao)
                                        <tr>
                                            <td with="45%">{{ $permissao->name }}</td>
                                            <td with="50%">{{ $permissao->label }}</td>
                                            <td with="5%">
                                                <a href="#" class="btn btn-app btn-remove" data-name="{{ $permissao->name }}" data-id="{{ $permissao->id }}" data-role="{{ $role->id }}">
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
        alert_success("{{ session('status') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert_error("{{ session('error') }}");
    </script>
@endif

    <script>
        alert_confirm('btn-remove', 'Devincular Permissão', 'Deseja realmente remover a permissão', 'question', 'rolePermissionsDelete');
    </script>
@endsection