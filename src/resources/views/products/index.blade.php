@extends('layouts.shop')

@section('title', 'Products')

@section('content')
@include('products.partials.filters')
<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    @forelse ($products as $product)
    <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal">#{{ $product->id }} {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <h3>{{ $product->description }}</h3>
                <a href="{{ route('products.show', $product->id) }}" type="button" class="w-100 btn btn-lg btn-outline-primary">View</a>
            </div>
        </div>
    </div>
    @empty
    <h3>Products not found</h3>
    @endforelse
</div>
@endsection