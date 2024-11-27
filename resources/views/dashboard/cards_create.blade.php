@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
    <nav class="navbar bg-body-tertiary">
        <h3>Create new card</h3>
    </nav>

    <div class="row mb-4">
        <form action="{{ route('cards.store') }}" method="post">
            @csrf
            <div class="col-md-4">
                <label>Card name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <label>Limit</label>
                <input type="text" name="limit" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <label>Cut-off day</label>
                <input type="text" name="cutoff_day" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <label>Color</label>
                <input type="color" name="color" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection