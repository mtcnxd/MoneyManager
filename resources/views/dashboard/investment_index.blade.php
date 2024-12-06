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
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif
	
	<div class="row mb-4">
		@foreach ($results as $result)
			<div class="col-md-4">
				@include('components.card', [
					'card_title' 	 => $result->getName(), 
					'card_content_1' => "$".number_format( $result->getLatestInvest(), 2),
					'card_content_2' => $result->getLastInvestDate(),
					'card_content_3' => "$".number_format( $result->getTotalInvest(), 2),
					'card_link'		 => route('dashboard')
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