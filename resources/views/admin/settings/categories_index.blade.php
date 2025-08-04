@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
	<nav class="navbar bg-body-tertiary">
		<h5 class="text-uppercase fw-bold">Categories</h5>
	</nav>

	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif

	<div class="row mb-4 card p-3">
		<h6>Spends and incomes</h6>
		<form action="{{ route('categories.index') }}" method="post" class="border p-3">
			@csrf
			<div class="col-md-4">
				<label class="mb-2">Name</label>
				<input type="text" name="name" class="form-control">
			</div>

			<div class="col-md-4 mt-3">
				<label class="mb-2">Type</label>
				<select name="type" class="form-select">
					<option value="">Spends</option>
					<option value="">Investments</option>
					<option value="">Incomes</option>
				</select>
			</div>

			<div class="col-md-4 mt-2">
				<input type="submit" class="btn btn-primary" value="Done">
			</div>
		</form>
	</div>
@endsection