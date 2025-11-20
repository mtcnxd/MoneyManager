@extends('components.main_body')

@section('container')
	@if ( session('message') )
		<div class="alert alert-warning alert-dismissible fade show">
			{{ session('message') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif
	
    <x-page_title title="Bitso Wallet"/>

    <div class="row mb-4">
        <div class="col">
            <div class="card rounded border border-custom shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-header-title">
                        Balance</h6>
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
                        @php
                            $sumTotal = 0;
                        @endphp                            
                        @foreach ($results['balances'] as $balance)
                            @if ($balance->total > 0.001)
                                <tr>
                                    <td class="text-uppercase">
                                        <span class="badge badge-primary text-secondary">{{ $balance->currency }}</span>
                                    </td>
                                    <td class="text-end">{{ $balance->available }}</td>
                                    
                                    @if ($balance->currency == 'mxn')
                                        @php
                                            $sumTotal = $sumTotal + $balance->total;
                                        @endphp
                                        <td class="text-end">{{ "$".number_format($balance->total, 2) }}</td>
                                    @else
                                        @php
                                            $calculate = (new App\Http\Controllers\BitsoController)->getBookPrice($balance->currency.'_mxn')->last * $balance->total;
                                            $sumTotal = $sumTotal + $calculate;
                                        @endphp
                                        <td class="text-end">{{ "$".number_format($calculate, 2) }}</td>
                                    @endif
                                </tr>    
                            @endif
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
                                        {{ "$".number_format($sumTotal, 2) }}
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

    <div class="row">
        <h5>Shopping list
            <a href="#" style="padding-left: 3px;" data-bs-toggle="modal" data-bs-target="#addShopping">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle" style="margin-bottom: 2px;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line></svg>
            </a>
        </h5>
    </div>

    <div class="row">
        <div class="col">
            <table class="table border table-hover">
                <thead>
                    <tr class="table-custom text-uppercase fs-7">
                        <th scope="col">Book</th scope="col">
                        <th scope="col" class="text-end">Amount</th>
                        <th scope="col" class="text-end">Purchase price</th>
                        <th scope="col" class="text-end">Purchase value</th>
                        <th scope="col" class="text-end">Current value</th>
                        <th scope="col" class="text-end">G/L $</th>
                        <th scope="col" class="text-end">G/L %</th>
                        <th scope="col" style="width: 30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sumCurrentValue  = 0;
                        $sumPurchaseValue = 0;
                        $sumGainAndLost   = 0;
                    @endphp
                    @foreach ($currencies as $currency)
                        @php
                            $sumPurchaseValue += $currency->getCurrentValue();
                            $sumCurrentValue  += ($currency->amount * $currency->price);
                            $sumGainAndLost   += $currency->getChange();
                        @endphp

                        <tr>
                            <td>{{ $currency->book }}</td>
                            <td class="text-end">{{ number_format($currency->amount, 5) }}</td>
                            <td class="text-end">{{ number_format($currency->price, 2) }}</td>
                            <td class="text-end">{{ number_format($currency->amount * $currency->price, 2) }}</td>
                            <td class="text-end">{{ number_format($currency->getCurrentValue(), 2) }}</td>
                            <td class="text-end">{{ number_format($currency->getChange(), 2) }}</td>
                            <td class="text-end">
                                <span class="badge text-bg-{{ ($currency->getPercentage() < 0) ? 'danger' : 'success' }}">
                                    {{ number_format($currency->getPercentage() , 2)."%" }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('currencies.destroy', $currency->id) }}" method="post" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="margin-top: 0; padding: 0;">
                                        <x-feathericon-trash-2 class="icon-vertical-align"/>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-end">{{ number_format($sumCurrentValue, 2) }}</td>
                        <td class="text-end">{{ number_format($sumPurchaseValue, 2) }}</td>
                        <td class="text-end">{{ number_format($sumGainAndLost, 2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

	<div class="row mb-4">
        <div class="col-md-6">
            <a href="{{ route('user.trades') }}" class="btn btn-sm btn-primary">Trades history</a>
            <a href="#" class="btn btn-sm btn-secondary" id="placeOrder">Place order</a>
        </div>
		<div class="col-md-6 text-end">
            <a href="{{ route('user.trades') }}" class="btn btn-sm btn-secondary">Settings</a>
		</div>
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
                            <label class="mb-2">Book</label>
                            <select id="parity" class="form-select">
                                @foreach ($results['ticker'] as $row)
                                    <option value="{{ $row->book }}">{{ $row->book }}</option>
                                @endforeach
                            </select>
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
                    <button type="button" class="btn btn-primary" id="insertData">Save changes</button>
                  </div>
            </div>
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
                side:"sell",
                price:"1",
                type:"limit",
            },
            success:function(results){
                console.log(results);
            }
        });
    });

    $("#insertData").on('click', function(Event){
        Event.preventDefault();

        var parity = $("#parity").val();
        var amount = $("#amount").val();
        var price  = $("#price").val();

        $.ajax({
            url: "{{ route('currencies.store') }}",
            type:'POST',
            data:{
                userid: {{ Auth::user()->id }},
                parity,
                amount,
                price
            },
            success: function(jsonResponse){
                console.log(jsonResponse.message);
                location.reload();
            },
            error: function(jsonResponse){
                console.log(jsonResponse);
            }
        });
    });
</script>
@endsection
