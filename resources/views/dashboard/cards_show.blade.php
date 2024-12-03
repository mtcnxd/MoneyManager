@extends('components.main_body')

@section('main_head')
	@include('components.main_head')
@endsection

@section('main_menu')
	@include('components.main_menu')
@endsection

@section('container')		
	<nav class="navbar bg-body-tertiary">
		<h5 class="text-uppercase fw-bold">Shopping list</h5>
	</nav>
	
	@if ( session('message') )
		<div class="alert alert-warning">
			{{ session('message') }}
		</div>
	@endif

    <div class="row bg-white rounded shadow-sm p-2 pb-3">
        <h6>Detalles de cuenta</h6>
        <hr>
        <div class="col text-center">
            <div class="rounded p-2" style="background-color: #efefef;">
                <x-feathericon-credit-card class="icon-vertical-align"/>
                {{ $card->getCardInfo()->name }}
            </div>
        </div>
        <div class="col text-center">
            <div class="rounded p-2" style="background-color: #efefef;">
                <x-feathericon-dollar-sign class="icon-vertical-align"/>
                {{ number_format($card->getCardInfo()->limit, 2) }}
            </div>
        </div>
        <div class="col text-center">
            <div class="rounded p-2" style="background-color: #efefef;">
                <x-feathericon-pie-chart class="icon-vertical-align"/>
                {{ $card->getPercentageUsed()."%" }}
            </div>
        </div>
    </div>
	
	<div class="row mt-5">
        <table class="table table-hover">
            <thead>
                <tr class="table-custom text-uppercase fs-7">
                    <td style="width: 3%">#</td>
                    <td style="width: 10%">Date</td>
                    <td>Concept</td>
                    <td>Comment</td>
                    <td class="text-end">Amount</td>
                    <td style="width: 3%"></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($movs as $mov)
                    <tr>
                        <td>{{ $mov->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($mov->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $mov->concept}}</td>
                        <td>{{ $mov->comment}}</td>
                        <td class="text-end">{{ "$".number_format($mov->amount, 2) }}</td>
                        <td><a href="#" id="{{ $mov->id }}" onClick="deleteSpending(this.id)"><x-feathericon-x-circle class="icon-in-table"/></a></td>
                    </tr>
                    @php
                        $total += $mov->amount
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end">{{ "$".number_format($total, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
	</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
</script>