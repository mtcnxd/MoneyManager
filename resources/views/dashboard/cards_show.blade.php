@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
		<h4 class="text-uppercase fw-bold">Shopping list</h4>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif
	
	<div class="row mt-3">
        <table class="table table-hover fs-7">
            <thead>
                <tr class="table-custom text-uppercase fs-7">
                    <td>#</td>
                    <td>Date</td>
                    <td>Concept</td>
                    <td class="text-end">Amount</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($movs as $mov)
                <tr>
                    <td>{{ $mov->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($mov->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $mov->concept}}</td>
                    <td class="text-end">{{ "$".number_format($mov->amount, 2) }}</td>
                </tr>
                @php
                    $total += $mov->amount
                @endphp

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end">{{ "$".number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
	</div>
@endsection