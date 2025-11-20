@extends('components.main_body')

@section('main_head')
@include('components.main_head')	
@endsection

@section('main_menu')
@include('components.main_menu')
@endsection

@section('container')
	<nav class="navbar bg-body-tertiary">
		<h5 class="text-uppercase fw-bold">Settings</h5>
	</nav>

	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif

    <form action="{{ route('settings.store') }}" method="POST">
        @csrf
        @foreach ($setting as $setting)
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="mb-1">
                        @if ($setting->type == 'checkbox')
                            <input type="checkbox" class="form-checkbox" {{ $setting->value ? 'checked' : null }} name="{{ $setting->key }}" />
                            {{ $setting->name }}
                        @endif
                        
                        @if ($setting->type == 'text')
                            {{ $setting->name }}
                            <input type="text" class="form-control" value="{{ $setting->value }}" name="{{ $setting->key }}" />
                        @endif
                    </label>
                </div>
            </div> 
        @endforeach
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection