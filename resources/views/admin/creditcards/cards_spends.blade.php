@extends('components.main_body')

@section('main_head')
	@include('components.main_head')	
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
    @if ( session('message') )
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Message:</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <nav class="navbar bg-body-tertiary">
        <h5 class="text-uppercase fw-bold">Create spend</h5>
    </nav>    
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
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Spend name</label>
                                <input type="text" name="concept" class="form-control" onkeyup="searchItem(this)" id="spend">
                                <ul id="autocomplete" class="autocomplete shadow"></ul>
                            </div>
                            <div class="col-md-2 mt-3">
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input type="text" name="amount" class="form-control" id="amount">
                                </div>
                            </div>
                            <div class="col-md-2 mt-3">
                                <label class="mb-1 fs-8 text-uppercase fw-bold">Months</label>
                                <select name="months" id="months" class="form-select">
                                    <option value="0">N/A</option>
                                    <option value="3">3 MSI</option>
                                    <option value="6">6 MSI</option>
                                    <option value="9">9 MSI</option>
                                    <option value="12">12 MSI</option>
                                </select>
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
                months:formSpend[0].months.value,
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

    function searchItem(textbox)
    {
        if (textbox.value.length >= 3){
            $.ajax({
                url: "{{ route('cards.autocomplete') }}",
                type:'GET',
                data:{
                    term:textbox.value
                },
                success:function(response){
                    $("#autocomplete").show();
                    $("#autocomplete").empty();
                    response.suggestions.forEach(element => {
                        $("#autocomplete").append("<li class='autocomplete-item' onClick='selectItem(this)'>" + element.spend +"</li>");
                    });
                }
            });
        }
    }

    function selectItem(item){
        $("#spend").val($(item).text());
        $("#autocomplete").hide();
    };
</script>
@endsection