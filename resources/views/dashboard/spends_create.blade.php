@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
    <nav class="navbar bg-body-tertiary">
        <h4 class="text-uppercase fw-bold">Create new spend</h4>
    </nav>

    @if ( session('message') )
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Message:</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row mb-4">
        <form action="{{ route('spends.store') }}" method="post">
            @csrf
            <div class="col-md-4 mt-2">
                <label>Credit card</label>
                <select name="credit_card" class="form-select">
                    @foreach ($creditCards as $card)
                        <option value="{{ $card->id }}">{{ $card->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Concept</label>
                <input type="text" name="concept" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <label>Amount</label>
                <input type="text" name="amount" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection