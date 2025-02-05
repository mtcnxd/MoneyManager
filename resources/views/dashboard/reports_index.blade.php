@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
        <h5 class="text-uppercase fw-bold">Report</h5>
	</nav>

    <div class="card">
        <div class="card-body">
            <span class="text-uppercase fs-7 fw-bold"> Total invested</span>
            <h4 class="border border-1 border-bottom-0 border-end-0 border-start-0 p-1 text-success">
                {{ "$".number_format($totalInvestment, 2) }}
            </h4>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <span class="text-uppercase fs-7 fw-bold"> Total debt</span>
            <h4 class="border border-1 border-bottom-0 border-end-0 border-start-0 p-1 text-danger">
                {{ "$".number_format($totalSpends->sum('amount'), 2) }}
            </h4>
        </div>
    </div>
	
@endsection