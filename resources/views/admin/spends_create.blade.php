@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
    <nav class="navbar bg-body-tertiary">
        <h5 class="text-uppercase fw-bold">Add account movement</h5>
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
            <div class="col-md-4">
                <label class="mb-1 fs-8 text-uppercase fw-bold">Credit card</label>
                <select name="credit_card" class="form-select">
                    @foreach ($creditCards as $card)
                        <option value="{{ $card->id }}">{{ $card->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mt-3">
                <label class="mb-1 fs-8 text-uppercase fw-bold">Concept</label>
                <input type="text" name="concept" class="form-control" onkeyup="searchItem(this.value)" id="concept">
                <ul id="autocomplete" class="autocomplete shadow"></ul>
            </div>
            <div class="col-md-4 mt-3">
                <label class="mb-1 fs-8 text-uppercase fw-bold">Category</label>
                <select name="category" class="form-select">
                    <option value="">Abono a tarjeta</option>
                    <option value="">Pago a tarjeta</option>
                    <optgroup label="Spends">
                        <option value="">Servicios</option>
                        <option value="">Entretenimiento</option>
                        <option value="">Gastos de casa</option>
                        <option value="">Gustos y caprichos</option>
                        <option value="">Imprevistos y otros</option>
                        <option value="">Mantenimiento y casa</option>
                    </optgroup>
                </select>
            </div>
            <div class="col-md-4 mt-3">
                <label class="mb-1 fs-8 text-uppercase fw-bold">Comment</label>
                <input type="text" name="comment" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <label class="mb-1 fs-8 text-uppercase fw-bold">Amount</label>
                <input type="text" name="amount" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <button type="submit" class="btn btn-primary">
                    Save
                    <x-feathericon-save class="icon-vertical-align" style="color: #fff;"/>
                </button>
            </div>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function searchItem(value){
        if (value.length >= 3){
            $.ajax({
                url: '/api/searchItems',
                type:'POST',
                data:{value},
                success:function(json){
                    $("#autocomplete").show();
                    $("#autocomplete").empty();
                    json.suggestions.forEach(element => {
                        $("#autocomplete").append("<li class='autocomplete-item' onClick='selectItem(this)'>" + element.concept +"</li>");
                    });
                }
            });
        }
    }

    function selectItem(item){
        $("#concept").val($(item).text());
        $("#autocomplete").hide();
    };
</script>