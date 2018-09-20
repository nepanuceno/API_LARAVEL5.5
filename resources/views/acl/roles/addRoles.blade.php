@extends('layouts.master')

@section('cssLink')

@endsection

@section('roles', 'active')
@section('administrador', 'active')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cadastro de Funções de Usuários
            <small>Listagem</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Funções de Usuários</a></li>
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
              <h3 class="box-title">Cadastro de Funções de Usuário</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('addRoles') }}">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Nome da Função</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Ex: api">
                </div>
                <div class="form-group">
                  <label for="label">Descrição da Função</label>
                  <input type="text" class="form-control" id="label" name="label" placeholder="Ex: Função que permite ao usuário acessar a API.">
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