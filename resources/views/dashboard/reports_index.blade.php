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
            <x-feathericon-file-text class="icon-vertical-align" style="color: #000;"/>
            Report
        </h5>
	</nav>

    <div class="card mb-3">
        <div class="card-body">
            <span class="text-uppercase fs-7 fw-bold"> Total invested</span>
            <h4 class="border-top p-1 text-success">
                {{ "$".number_format($totalInvestment, 2) }}
                <x-feathericon-trending-up class="icon-vertical-align" class="text-success"/>
            </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <span class="text-uppercase fs-7 fw-bold"> Total debt</span>
            <h4 class="border-top p-1 text-danger">
                {{ "$".number_format($totalSpends->sum('amount'), 2) }}
                <x-feathericon-trending-down class="icon-vertical-align" class="text-danger"/>
            </h4>
        </div>
    </div>
@endsection