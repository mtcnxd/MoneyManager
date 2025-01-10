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
            <div class="col-md-4">
                <label>Credit card</label>
                <select name="credit_card" class="form-select">
                    @foreach ($creditCards as $card)
                        <option value="{{ $card->id }}">{{ $card->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mt-3">
                <label>Concept</label>
                <input type="text" name="concept" class="form-control" onkeyup="searchItem(this.value)" id="concept">
                <ul id="autocomplete" class="autocomplete shadow"></ul>
            </div>
            <div class="col-md-4 mt-3">
                <label>Category</label>
                <select name="category" class="form-select">
                    <option value="">Servicios</option>
                    <option value="">Entretenimiento</option>
                    <option value="">Gastos de casa</option>
                    <option value="">Gustos y caprichos</option>
                    <option value="">Imprevistos y otros</option>
                    <option value="">Mantenimiento y casa</option>
                </select>
            </div>
            <div class="col-md-4 mt-3">
                <label>Comment</label>
                <input type="text" name="comment" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <label>Amount</label>
                <input type="text" name="amount" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <input type="submit" value="Enviar" class="btn btn-primary">
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