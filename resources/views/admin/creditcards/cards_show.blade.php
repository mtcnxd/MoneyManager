@extends('components.main_body')

@section('container')
    <x-page_title title="Shopping list"/>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif

    <div class="row bg-white rounded shadow border border-custom">
        <h6 class="border-bottom p-3 fs-7 text-uppercase fw-bold bg-color-title-bar mb-0">
            Detalles de cuenta
        </h6>
        <div class="row pt-3 pb-3">
            <div class="col text-center">
                <div class="rounded p-2" style="background-color: #efefef;">
                    <x-feathericon-credit-card class="icon-vertical-align"/>
                    {{ $card->name }}
                </div>
            </div>
            <div class="col text-center">
                <div class="rounded p-2" style="background-color: #efefef;">
                    <x-feathericon-dollar-sign class="icon-vertical-align"/>
                    {{ number_format($card->limit, 2) }}
                </div>
            </div>
            <div class="col text-center">
                <div class="rounded p-2" style="background-color: #efefef;">
                    <x-feathericon-pie-chart class="icon-vertical-align"/>
                    {{ $card->usage() }} %
                </div>
            </div>
            <div class="col text-center">
                <div class="rounded p-1" style="background-color: #efefef;">
                    <input type="button" onclick="processMonth({{ $card->id }})" value="Restart month" class="btn btn-sm">
                </div>
            </div>
        </div>
    </div>
	
	<div class="row mt-4">
        <span class="mb-3">Se encontraron {{ $card->movs->where('active', true)->count() }} movimientos </span>
        <table class="table table-hover">
            <thead>
                <tr class="table-custom text-uppercase fs-7">
                    <td style="width: 3%">#</td>
                    <td style="width: 20%">Date</td>
                    <td>Spend name</td>
                    <td>Description</td>
                    <td class="text-end">Amount</td>
                    <td style="width: 3%"></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($card->movs->where('active', true) as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            {{ $item->spend }}
                            @if ($item->msi)
                                <span class="badge text-bg-success">MSI</span>
                            @endif
                        </td>
                        <td>{{ $item->description }}</td>
                        <td class="text-end">{{ "$".number_format($item->amount, 2) }}</td>
                        <td>
                            <button class="btn btn-sm" onclick="deleteSpending({{ $item->id }})">
                                <x-feathericon-trash-2 class="icon-vertical-align"/>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td class="text-end">{{ "$".number_format( $card->movs->where('active', true)->sum('amount') , 2) }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
	</div>

    <div class="row mb-4">
		<div class="col-md-4">
            <a href="{{ route('cards.index') }}" class="btn btn-sm btn-secondary">Back</a>
			<a href="{{ route('user.spends', $card) }}" class="btn btn-sm btn-primary">Add spend</a>
		</div>
	</div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

<script>
    function deleteSpending(id){
        $.ajax({
            url: '/api/deleteSpending',
            type:'post',
            data:{ id },
            success:function(json){
                Swal.fire({
                    text: json.message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
                .then(() => {
                    location.reload();
                });
            }
        });
    }

    function processMonth(card){
        $.ajax({
            url: "{{ route('cards.processMonth') }}",
            type:'post',
            data:{ card },
            success:function(response){
                if (response.success){
                    console.log(response);
    
                    Swal.fire({
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    }
</script>
@endsection