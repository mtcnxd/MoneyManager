@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
    <nav class="navbar bg-body-tertiary">
        <h5 class="text-uppercase fw-bold">My Trades</h5>
        <a href="{{ route('cryptocurrencies.index') }}" class="btn btn-secondary">
			<x-feathericon-arrow-left class="main-menu-icon" style="color: #fff;"/>
			Back
		</a>
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
                                <th>Book</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Type</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($trades as $trade)
                            <tr>
                                <td class="text-uppercase">
                                    <span class="badge badge-primary text-secondary">{{ $trade->book  }}</span>
                                </td>
                                <td class="text-end">{{ number_format($trade->price, 2) }}</td>
                                <td class="text-end">{{ $trade->side }}</td>
                                <td class="text-end">{{ $trade->major }} {{ $trade->major_currency }}</td>
                                <td class="text-end">{{ $trade->minor }} {{ $trade->minor_currency }}</td>
                                <td class="text-end">{{ \Carbon\Carbon::parse($trade->created_at)->format('H:i - d-m-Y') }}</td>
                            </tr>    
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection