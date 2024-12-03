@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
<nav class="navbar bg-body-tertiary">
	<h4 class="text-uppercase fw-bold">Dashboard</h4>
</nav>

<div class="row mb-4">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				Ingresos
			</div>
			<div class="card-body">
				body
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				Egresos
			</div>
			<div class="card-body">
				body
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				Inversiones
			</div>
			<div class="card-body">
				body
			</div>
		</div>
	</div>
</div>
@endsection