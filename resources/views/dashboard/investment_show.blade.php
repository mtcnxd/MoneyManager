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

	<div class="row">
		<div class="card-title">
			<div class="row col">
				<span class="text-uppercase fs-6">Increment {{ "$".number_format($first->amount - $last->amount, 2) }}</span>
			</div>
			<div class="row col">
				<span>{{ $change."%" }}</span>
			</div>
		</div>
	</div>

	<div class="row mb-4">
        @foreach ($results as $count => $result)
            <div class="row m-2 p-3 border rounded shadow-sm bg-white">
                <div class="col-md-1 text-center">
                    <span style="background-color: #f5ab67; border-radius:20px; padding: 4px 8px;">{{ $result->id }}</span>
                </div>
                <div class="col">
					{{ $result->created_at }}
				</div>
				<div class="col">
					{{ \Carbon\Carbon::parse($result->created_at)->diffInDays() }}
					days ago
				</div>
                <div class="col text-end">
					{{ "$".number_format($result->amount, 2) }}
				</div>
            </div>
        @endforeach
	</div>
@endsection