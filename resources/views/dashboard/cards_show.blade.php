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
        <div class="col text-center">
            <div class="rounded p-1" style="background-color: #efefef;">
                <input type="button" onclick="processMonth({{ $card->getCardInfo()->id }})" value="Restart month" class="btn btn-sm">
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
                    $labels = array();
                    $values = array();
                @endphp
                @foreach ($movs as $mov)
                    <tr>
                        <td>{{ $mov->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($mov->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $mov->concept}}</td>
                        <td>{{ $mov->comment}}</td>
                        <td class="text-end">{{ "$".number_format($mov->amount, 2) }}</td>
                        <td><a href="#" id="{{ $mov->id }}" onClick="deleteSpending(this.id)"><x-feathericon-x-circle class="icon-vertical-align"/></a></td>
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

    <div class="row">
        <div class="col-md-6 bg-white border p-4 rounded">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

@foreach ($chart as $item)
@php
    $labels[] = $item->concept;
    $values[] = $item->amount;
@endphp
@endforeach

<script>
    const barChart = document.getElementById('myChart').getContext('2d');
    const myBar = new Chart(barChart, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Spends',
                data: {{ json_encode($values) }},
                borderColor: ["#1c83c6","#8d2f87","#000000","#2e9f30","#563d7c","#01d781"],
                backgroundColor: ["#1c83c666","#8d2f8766","#00000066","#2e9f3066","#563d7c66","#01d78166"],
                borderWidth: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position:'none'
                }
            }
        }
    });
</script>

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