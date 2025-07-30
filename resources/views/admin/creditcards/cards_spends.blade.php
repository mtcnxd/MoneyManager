@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
    <nav class="navbar bg-body-tertiary">
        <h5 class="text-uppercase fw-bold">Create spend</h5>
    </nav>

    @if ( session('message') )
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Message:</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="border border-custom p-0 bg-white rounded shadow">
                <h6 class="border-bottom p-3 fs-7 text-uppercase fw-bold bg-color-title-bar mb-0">
                    Create
                </h6>
                <div class="p-3">
                    <form id="formSpend">
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Credit card</label>
                                <input type="text" name="credit_card" class="form-control" value="{{ $card->name }}" disabled>
                                <input type="hidden" name="card" value="{{ $card->id }}">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Category</label>
                                <select name="category" class="form-select">
                                    <option>Abono a tarjeta</option>
                                    <option>Pago a tarjeta</option>
                                    <optgroup label="Spends">
                                        <option>Servicios</option>
                                        <option>Entretenimiento</option>
                                        <option>Gastos de casa</option>
                                        <option>Gustos y caprichos</option>
                                        <option>Imprevistos y otros</option>
                                        <option>Mantenimiento y casa</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Spend</label>
                                <input type="text" name="concept" class="form-control" onkeyup="searchItem(this.value)" id="spend">
                                <ul id="autocomplete" class="autocomplete shadow"></ul>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Amount</label>
                                <input type="text" name="amount" class="form-control" id="amount">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mt-3">
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Comment</label>
                                <textarea name="description" class="form-control" id="description"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('cards.show', $card->id) }}'">
                                Back
                            </button>
                            <button type="button" class="btn btn-primary" id="btnsave">
                                <x-feathericon-save class="icon-vertical-align" style="color: #fff;"/>
                                Save
                            </button>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')    
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $("#btnsave").on('click', function(e){
        e.preventDefault();
        const toast = new ToastMagic();
        const formSpend = $("#formSpend");

        $.ajax({
            url: "{{ route('spend.store') }}",
            type: 'POST',
            data: {
                card:formSpend[0].card.value,
                category:formSpend[0].category.value,
                spend:formSpend[0].spend.value,
                amount:formSpend[0].amount.value,
                description:formSpend[0].description.value
            },
            success: function(response) {
                console.log(response);

                if (response.success) {
                    toast.warning("Success!", response.message);
                    formSpend[0].reset();
                }
                
                else {
                    toast.error("Error!", response.message);
                }
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });

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
@endsection