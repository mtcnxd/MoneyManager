@extends('components.main_body')

@section('container')		
	<x-page_title title="Portfolio"/>
	
	@if ( session('message') )
		<div class="alert alert-warning alert-dismissible fade show">
			{{ session('message') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

	<div class="row mb-3">
		<div class="col-md-12">
			<div class="border border-custom p-0 bg-white rounded shadow">
				<h6 class="border-bottom p-3 fs-7 text-uppercase fw-bold bg-color-title-bar mb-0">
					Update invest
				</h6>
				<div class="p-3">
					<form action="{{ route('investments.store') }}" method="post">
						@csrf
						<div class="col-md-4">
							<label class="mb-1 fw-bold text-uppercase fs-7">Instrument</label>
							<select name="instrument_id" class="form-select">
								@foreach ($instruments as $instrument)
									<option value="{{ $instrument->id }}">{{ $instrument->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4 mt-3">
							<label class="mb-1 fw-bold text-uppercase fs-7">Amount</label>
							<input type="text" name="amount" class="form-control" required>
						</div>
						<div class="col-md-4 mt-2">
							<input type="submit" class="btn btn-sm btn-primary" value="Done">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row mb-3">
		@foreach ($investments as $investment)

			{{ $investment->investments }}

			<div class="col-md-4 mb-4">
				<x-card>
					<x-slot:card_title>{{ $investment->name }}</x-slot:card_title>
					<x-slot:card_content_2>{{ Carbon\Carbon::parse($investment->latest)->format('d M Y') }}</x-slot:card_content_2>
					<x-slot:card_content_3>${{ number_format ($investment->amount, 2) }}</x-slot:card_content_3>
					<x-slot:card_link>{{ route('investments.show', $investment->instrument_id) }}</x-slot:card_link>
				</x-card>
			</div>							
		@endforeach
	</div>

	<div class="row mb-3">
		<div class="col-md-12">
			<div class="bg-white p-3 border border-custom">
				<p class="text-uppercase fs-7 fw-bold mb-0">Total invest: ${{ number_format($investments->sum('amount'), 2) }}</p>
			</div>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-12">
			<a href="{{ route('investments.index') }}" class="btn btn-sm btn-primary">Add new</a>
		</div>
	</div>
@endsection