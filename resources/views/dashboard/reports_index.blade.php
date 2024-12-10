@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
        <h4 class="text-uppercase fw-bold">Total investment</h4>
	</nav>

    <div class="row mb-4">
        <div class="col">
            <h4>{{ "$".number_format($totalInvestment, 2) }}</h4>
        </div>
    </div>
	
@endsection