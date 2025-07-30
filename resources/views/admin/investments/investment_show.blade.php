@extends('components.main_body')

@section('container')		
	<x-page_title title="Investment History"/>
	
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
			<div class="col text-end">
				<span class="text-uppercase fs-7 fw-bold">
					Increment {{ "$".number_format( $instrument->diff(), 2) }}
				</span>
			</div>
		</div>
	</div>

	<div class="mb-4">
        @foreach ($instrument->investments as $investment)
            <div class="row m-2 p-3 border rounded shadow-sm bg-white">
                <div class="col-md-2 text-center">
                    <span style="background-color: #B2DFDB; border-radius:20px; padding: 4px 8px;">{{ $investment->created_at->format('d M Y') }}</span>
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

    <div class="row mb-4">
		<div class="col-md-4">
            <a href="{{ route('investments.index') }}" class="btn btn-sm btn-secondary">Back</a>
		</div>
	</div>	
@endsection