@extends('layouts.master')

@section('cssLink')

@endsection

@section('permissions', 'active')
@section('manage', 'active')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cadastro de Permissões de Usuários
            <small>Listagem</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Permissões de Usuários</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastro de Permissões de Usuário</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('addPermissions') }}">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Nome da Permissão</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Ex: api">
                </div>
                <div class="form-group">
                  <label for="label">Descrição da Permissão</label>
                  <input type="text" class="form-control" id="label" name="label" placeholder="Ex: Permissão que permite ao usuário acessar a API.">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
    </div>
          <!-- /.box -->
    </section>
</div>

@endsection

@section('JavaScript')
@endsection