@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
		<h4 class="text-uppercase fw-bold">Investment History</h4>
		<a href="{{ route('investments.index') }}" class="btn btn-secondary">
			<x-feathericon-arrow-left class="main-menu-icon" style="color: #fff;"/>
			Back
		</a>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif

	<div class="border border-custom p-0 bg-white rounded shadow mb-4">
		<div class="row p-3">
			<div class="col">
				<span class="text-uppercase fs-7 fw-bold">
					{{ $instrument->name }}
				</span>
			</div>
			<div class="col">
				<span class="text-uppercase fs-7 fw-bold">
					Increment {{ "$".number_format(0, 2) }}
				</span>
			</div>
		</div>
	</div>

	<div class="row mb-4">
        @foreach ($instrument->investments as $investment)
            <div class="row m-2 p-3 border rounded shadow-sm bg-white">
                <div class="col-md-1 text-center">
                    <span style="background-color: #f5ab67; border-radius:20px; padding: 4px 8px;">{{ $investment->instrument_id }}</span>
                </div>
                <div class="col">
					{{ $investment->created_at->format('d M Y') }}
				</div>
				<div class="col">
					{{ $investment->created_at->diffInDays(\Carbon\Carbon::now()) }} days ago
				</div>
                <div class="col text-end">
					{{ "$".number_format( $investment->amount, 2) }}
				</div>
            </div>
        @endforeach
	</div>
@endsection