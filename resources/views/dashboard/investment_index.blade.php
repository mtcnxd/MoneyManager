@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
		<h5 class="text-uppercase fw-bold">
			<x-feathericon-trending-up class="icon-vertical-align" style="color: #000;"/>
			Investment portfolio
		</h5>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning alert-dismissible fade show">
			{{ session('message') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

	<div class="row mb-3 p-3">
		<div class="col border border-custom p-4 mb-0 bg-white rounded">
			<form action="{{ route('investments.store') }}" method="post">
				@csrf
				<h6 class="border-bottom pb-2 fs-7 text-uppercase fw-bold">
					Update instrument
				</h6>
				<div class="col-md-4">
					<label class="mb-2">Instrument</label>
					<select name="instrument_id" class="form-select">
						@foreach ($instruments as $instrument)
							<option>{{ $instrument }}</option>	
						@endforeach
					</select>
				</div>
				<div class="col-md-4 mt-3">
					<label class="mb-2">Amount</label>
					<input type="text" name="amount" class="form-control">
				</div>
				<div class="col-md-4 mt-2">
					<input type="submit" class="btn btn-sm btn-primary" value="Done">
				</div>
			</form>
		</div>
	</div>
	
	<div class="row mb-4">
		@foreach ($results as $result)
			<div class="col-md-4 mb-4">
				@include('components.card', [
					'card_title' 	 => $result->getName(), 
					'card_content_1' => "$".number_format( $result->getLatestInvest(), 2),
					'card_content_2' => $result->getLastInvestDate(),
					'card_content_3' => "$".number_format( $result->getTotalInvest(), 2),
					'card_link'		 => route('investments.show', $result->investName)
				])
			</div>							
		@endforeach
	</div>
	<hr>
	<div class="row mb-4">
		<div class="col-md-4">
			<a href="{{ route('investments.create') }}" class="btn btn-sm btn-primary">Add new</a>
		</div>
	</div>
@endsection