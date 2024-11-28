@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
        <h4 class="text-uppercase fw-bold">Crypto currencies</h4>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif
	
    <div class="row mb-4">
        <div class="col">
            <div class="card rounded border border-custom shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-header-title">Balance</h6>
                    <svg class="card-header-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-custom text-uppercase fs-7">
                                <th>#</th>
                                <th>Currency</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Value</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded border border-custom shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-header-title">Distribution</h6>
                    <svg class="card-header-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <div class="card-body p-0">
                    <canvas class="p-3" id="myChart" width="250" height="100"></canvas>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border-custom shadow-sm">
                        <div class="card-body">
                            <div class="align-items-center row">
                                <div class="col">
                                    <h6 class="card-title text-muted text-uppercase fs-7">
                                        Total Balance
                                    </h6>
                                    <h5 class="card-subtitle mb-2 fs-6">
                                    </h5>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#32a852" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-custom shadow-sm">
                        <div class="card-body">
                            <div class="align-items-center row">
                                <div class="col">
                                    <h6 class="card-title text-muted text-uppercase fs-7">
                                        Current price BTC/USDT
                                    </h6>
                                    <h5 class="card-subtitle mb-2 fs-6">
                                    </h5>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#32a852" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <h5>Shopping list
            <a href="#" style="padding-left: 3px;" data-bs-toggle="modal" data-bs-target="#addShopping">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle" style="margin-bottom: 2px;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line></svg>
            </a>
        </h5>
        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Parity</th scope="col">
                    <th scope="col">Amount</th>
                    <th scope="col" class="text-end">Purchase price</th>
                    <th scope="col" class="text-end">Purchase value</th>
                    <th scope="col" class="text-end">Current value</th>
                    <th scope="col" class="text-end">G/L</th>
                    <th scope="col" style="width: 30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result['book'] }}</td>
                        <td>{{ $result['last'] }}</td>
                        <td>{{ $result['high'] }}</td>
                        <td>{{ $result['low'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection