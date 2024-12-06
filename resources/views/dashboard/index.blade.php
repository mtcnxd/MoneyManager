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
	@php
		$cards = [
			"title" => 'hola',
			"body" => 'hola',
			"hola" => 'mundo'
		];
	@endphp

	@foreach ($cards as $card)
		@include('components.resume_card', [
			'card_title' => 'title',
			'card_body'  => 'body'
		])
	@endforeach
</div>
@endsection