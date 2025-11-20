@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
    <nav class="navbar bg-body-tertiary">
        <h4 class="text-uppercase fw-bold">{{ $results->spend }}</h4>
    </nav>

    <div class="my-3 p-3 col-md-6 bg-white rounded shadow-sm">
        <ul class="list-group list-group-flush">
            <li class="list-group-item ">{{ $results->card->name }} <span class="fs-7 text-muted">{{ $results->card->network }}</span></li>
            <li class="list-group-item">Cutoff-day: {{ $results->card->cutoff_day }}</li>
            <li class="list-group-item">{{ $results->description }}</li>
            <li class="list-group-item">Total $ {{ number_format($results->amount, 2) }}</li>
        </ul>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Payments Details</h6>
        @foreach ($results->spendsMSI as $item)
            <div class="border-bottom pb-2">
                <div class="d-flex justify-content-between pt-3">
                    <p class="mb-0">{{ Carbon\Carbon::parse($item->due_date)->format('d M Y') }}</p>
                    <strong class="mb-0 text-end">$ {{ number_format($item->price, 2) }}</strong>
                </div>
                <div class="text-end">
                    <span class="badge text-muted fs-7">
                        {{ $item->status }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endsection