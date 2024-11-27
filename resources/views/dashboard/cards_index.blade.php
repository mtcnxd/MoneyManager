@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
		<h3>Credit cards</h3>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif
	
	<div class="row mb-4">
		@foreach (['BBVA Azul'] as $result)
			<div class="col">
				@include('components.card', [
					'card_title' 	 => "BBVA Azul", 
					'card_content_1' => "",
					'card_content_2' => "",
					'card_content_3' => "",
				])
			</div>							
		@endforeach
	</div>
	<hr>
	<div class="row mb-4">
		<div class="col-md-4">
			<a href="{{ route('cards.create') }}" class="btn btn-sm btn-secondary">Add new</a>
		</div>
	</div>
@endsection