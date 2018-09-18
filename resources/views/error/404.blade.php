
@extends('layouts.master')

@section('cssLink')
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        404 Error Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">404 error</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="text-yellow"> 404</h2>
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>    
      </div>
      <!-- /.error-page -->
    </section>
    @endsection


@section('JavaScript')

@endsection