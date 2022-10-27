@extends('layouts.shop', ['menu' => 'orders'])
@section('title', 'Orders')
@section('content')
<div class="text-end mb-2">
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderManagement">
		Make
	</button>
</div>
<div class="mb-3 text-center">
	<table class="table mb-2">
		<thead>
			<tr>
				<th>#</th>
				<th>User</th>
				<th>Product</th>
				<th>Created at</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr data-id="{{ $order->id }}">
				<td>{{ $order->id }}</td>
				<td>{{ $order->user?->name }}</td>
				<td>
					<ul class="text-start">
						@foreach($order->products as $product)
						<li>{{ $product->name }} : {{ $product->pivot->count }}</li>
						@endforeach
					</ul>
				</td>
				<td>{{ $order->created_at }}</td>
				<td>
					<button class="btn btn-warning" data-route-edit="{{ route('orders.edit', $order->id) }}">Edit</button>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
@push('modals')
@include('orders.modals.save')
@endpush