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
        <a href="{{ route('cards.index') }}" class="btn btn-secondary">
			<x-feathericon-arrow-left class="main-menu-icon" style="color: #fff;"/>
			Back
		</a>
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
                {{ 0 }}
            </div>
        </div>
        <div class="col text-center">
            <div class="rounded p-1" style="background-color: #efefef;">
                <input type="button" onclick="processMonth({{ $card->id }})" value="Restart month" class="btn btn-sm">
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
                @foreach ($card->movs as $index => $item)
                    <tr>
                        <td>{{ $item->index }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>{{ $item->concept }}</td>
                        <td>{{ $item->comment }}</td>
                        <td>{{ $item->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td class="text-end">{{ "$".number_format(0, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
	</div>

    <div class="row">
        <div class="col-md-6 bg-white border p-4 rounded">
            <canvas id="myChart"></canvas>
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
        console.log(card);

        $.ajax({
            url: '/api/processMonth',
            type:'post',
            data:{ card },
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
@endsection