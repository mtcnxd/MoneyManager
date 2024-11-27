@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
		<div class="container-fluid">
			<h2>Resume</h2>
		</div>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif
	
	<div class="row mb-4">
		@foreach ($results as $result)
			<div class="col">
				@include('components.card', [
					'card_title' 	 => $result->getName(), 
					'card_content_1' => "$".number_format( $result->getCurrentInvest(), 2),
					'card_content_2' => $result->getLastInvestDate(),
					'card_content_3' => "$".number_format( $result->getTotalInvest(), 2),
				])
			</div>							
		@endforeach
	</div>
	<hr>
	<div class="row mb-4">
		<div class="col-md-4">
			<button class="btn btn-sm btn-secondary">Add new</button>
		</div>
	</div>
@endsection