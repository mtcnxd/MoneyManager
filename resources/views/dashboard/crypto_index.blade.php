@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')
	<nav class="navbar bg-body-tertiary">
        <h5 class="text-uppercase fw-bold">Crypto currencies</h5>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif
	
    <div class="row mb-4">
        <div class="col">
            <div class="card rounded border border-custom shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-header-title">Balance</h6>
                    <svg class="card-header-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-custom text-uppercase fs-7">
                                <th>Currency</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($balance as $currency)
                            <tr>
                                <td class="text-uppercase"><span class="badge badge-primary text-secondary">{{ $currency->currency }}</span></td>
                                <td class="text-end">{{ $currency->available }}</td>
                                <td class="text-end">{{ $currency->total }}</td>
                            </tr>    
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded border border-custom shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-header-title">Distribution</h6>
                    <svg class="card-header-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <div class="card-body p-0">
                    <canvas class="p-3" id="myChart" width="250" height="100"></canvas>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border-custom shadow-sm">
                        <div class="card-body">
                            <div class="align-items-center row">
                                <div class="col">
                                    <h6 class="card-title text-muted text-uppercase fs-7">
                                        Total Balance
                                    </h6>
                                    <h5 class="card-subtitle mb-2 fs-6">
                                    </h5>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#32a852" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-custom shadow-sm">
                        <div class="card-body">
                            <div class="align-items-center row">
                                <div class="col">
                                    <h6 class="card-title text-muted text-uppercase fs-7">
                                        Current price BTC/USDT
                                    </h6>
                                    <h5 class="card-subtitle mb-2 fs-6">
                                    </h5>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#32a852" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row" style="overflow-y: scroll; max-height: 550px;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Book</th>
                    <th scope="col" class="text-end">Change 24</th>
                    <th scope="col" class="text-end">Last price</th>
                    <th scope="col" class="text-end">Highter price</th>
                    <th scope="col" class="text-end">Lower price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ticker as $result)
                    <tr>
                        <td>{{ $result->book }}</td>
                        <td class="text-end">
                            @if ($result->change_24 < 0)
                                <span class="badge text-bg-danger">{{ $result->change_24 }}</span>
                            @else
                                <span class="badge text-bg-success">{{ $result->change_24 }}</span>
                            @endif
                        </td>
                        <td class="text-end">{{ number_format($result->last, 2) }}</td>
                        <td class="text-end">{{ $result->high }}</td>
                        <td class="text-end">{{ $result->low }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-5">
        <h5>Shopping list
            <a href="#" style="padding-left: 3px;" data-bs-toggle="modal" data-bs-target="#addShopping">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle" style="margin-bottom: 2px;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line></svg>
            </a>
        </h5>
        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Book</th scope="col">
                    <th scope="col" class="text-end">Amount</th>
                    <th scope="col" class="text-end">Purchase price</th>
                    <th scope="col" class="text-end">Purchase value</th>
                    <th scope="col" class="text-end">Current value</th>
                    <th scope="col" class="text-end">G/L</th>
                    <th scope="col" class="text-end">G/L $</th>
                    <th scope="col" style="width: 30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($myCurrencies as $currency)
                    @php
                        $crypto_price = $favorites[$currency->book];
						$difference   = $crypto_price - $currency->price;
						$percentage   = $difference/$crypto_price * 100;

                        $diff = ($currency->amount * $favorites[$currency->book])-($currency->amount * $currency->price);
                    @endphp
                    <tr>
                        <td>{{ $currency->book }}</td>
                        <td class="text-end">{{ $currency->amount }}</td>
                        <td class="text-end">{{ number_format($currency->price,3) }}</td>
                        <td class="text-end">{{ number_format($currency->amount * $currency->price, 3) }}</td>
                        <td class="text-end">{{ number_format($currency->amount * $favorites[$currency->book], 3) }}</td>
                        <td class="text-end">
                            <span class="badge text-bg-success">{{ number_format($percentage, 2)."%" }}</span>
                        </td>
                        <td class="text-end">
                            <span class="badge text-bg-success">{{ number_format($diff, 3) }}</span>
                        </td>
                        <td>
                            <a href="#" onclick="deleteRow({{ $currency->id }})">
                                <x-feathericon-trash-2 class="icon-vertical-align"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addShopping" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="mb-2">Paridad</label>
                            <input type="text" id="parity" class="form-control">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="mb-2">Cantidad</label>
                            <input type="text" id="amount" class="form-control">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="mb-2">Precio de compra</label>
                            <input type="text" id="price" class="form-control">
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="insertData()">Save changes</button>
                  </div>
            </div>
          </div>
    </div>

    <hr>
	<div class="row mb-4">
		<div class="col-md-4">
			<a href="{{ route('trades') }}" class="btn btn-sm btn-primary">Trades history</a>
            <a href="#" class="btn btn-sm btn-secondary" id="placeOrder">Place order</a>
		</div>
	</div>
@endsection


@section('javascript')
<script>
    $("#placeOrder").on('click', function(btn){
        btn.preventDefault();
        
        $.ajax({
            url: "/api/placeOrder",
            type: "POST",
            data:{
                book:"btc_usdt",
                major:"btc",
                minor:"usdt",
                price:"1",
                side:"sell"
            },
            success:function(results){
                console.log(results);
            }
        });
    });


    function deleteRow(id){
        $.ajax({
            url: "/api/destroyCryto",
            type:'POST',
            data:{id},
            success:function(jsonResponse){
                console.log(jsonResponse);
                location.reload();
            }
        });      
    }

    function insertData(){
        let parity = $("#parity");
        let amount = $("#amount");
        let price  = $("#price");

        $.ajax({
            url: "/api/storeCryto",
            type:'POST',
            data:{
                parity:parity.val(),
                amount:amount.val(),
                price:price.val()
            },
            success:function(jsonResponse){
                console.log(jsonResponse);
                location.reload();
            }
        });
    }

</script>
@endsection