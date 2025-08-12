@extends('components.main_body')

@section('container')
	@if ( session('message') )
		<div class="alert alert-warning alert-dismissible fade show">
			{{ session('message') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

	<x-page_title title="Credit Cards"/>
	<p>Consumos de tarjetas de credito registradas</p>
	<div class="row mb-3">
		@foreach ($cards as $card)
			<div class="col-md-4 mb-4">
				<div class="card border-custom shadow-sm">
					<div class="card-body">
						<div class="align-items-center row">
							<div class="col">
								<div class="card-subtitle mb-2">
									<div style="display: flex; justify-content: space-between;" class="mb-1 fs-5">
										<div>{{ $card->name }}</div>
									</div>
									<div style="display: flex; justify-content: space-between;" class="mb-1">
										<div>Limit</div>
										<div><span class="text-muted"><div>{{ "$".number_format($card->limit,2) }}</div></span></div>
									</div>
									<div style="display: flex; justify-content: space-between;" class="mb-1">
										<div>Usage</div>
										<div><span class="text-muted">${{ $card->total() }}</span></div>
									</div>
									<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
										<div class="progress-bar" style="width: {{ $card->usage() }}%">{{ $card->usage() }}%</div>
									</div>
									<div style="display: flex; justify-content: space-between;" class="mt-2">
										<div></div>
										<div>
											<a href="{{ route('cards.show', $card->id) }}" class="btn btn-sm btn-primary">
												Details
												<x-feathericon-info class="icon-vertical-align" style="color: #fff;"/>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>													
				</div>
			</div>							
		@endforeach
	</div>
	<hr>
	<div class="row mb-4">
		<div class="col-md-4">
			<a href="{{ route('cards.create') }}" class="btn btn-sm btn-secondary">Create new card</a>
		</div>
	</div>
@endsection