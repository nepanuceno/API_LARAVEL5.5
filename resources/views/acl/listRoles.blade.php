@extends('layouts.master')

@section('cssLink')

@endsection

@section('content')

@forelse($roles as $role)
    <li>{{{ $role->name }}}</li>
@empty
	<p>There are no roles yet!</p>
@endforelse

@endsection

@section('JavaScript')
@endsection