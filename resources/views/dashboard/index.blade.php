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
	<form action="{{ route('instrument.store') }}" method="post">
		@csrf
		<div class="col-md-4">
			<label>Instrument</label>
			<select name="instrument_id" class="form-select">
				@foreach ($instruments as $instrument)
					<option>{{ $instrument }}</option>	
				@endforeach
			</select>
		</div>
		<div class="col-md-4 mt-2">
			<label>Amount</label>
			<input type="text" name="amount" class="form-control">
		</div>
		<div class="col-md-4 mt-2">
			<input type="submit" value="Enviar" class="btn btn-primary">
		</div>
	</form>
</div>
@endsection