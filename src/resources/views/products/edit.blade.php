@extends('layouts.shop')
@section('title', 'Products - Edit')
@section('content')
@include('products.partials.product', [
	'title' => sprintf('Product [#%d %s] Editing', $product->id, $product->name),
	'route' => route('products.update', $product->id),
	'name' => $product->name,
	'description' => $product->description,
	'identifier' => $product->identifier,
	'category_id' => $product->category_id
])
@endsection