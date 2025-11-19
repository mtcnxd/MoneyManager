@extends('components.main_body')

@section('main_head')
@include('components.main_head')	
@endsection

@section('main_menu')
@include('components.main_menu')
@endsection

@section('container')
	<nav class="navbar bg-body-tertiary">
		<h5 class="text-uppercase fw-bold">Settings</h5>
	</nav>

	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif

    <div class="row">
        <label class="mb-1">Username</label>
        <input type="text" class="form-control">
    </div>

    <div class="row mt-3">
        <label class="mb-1">Password</label>
        <input type="text" class="form-control">
    </div>

@endsection