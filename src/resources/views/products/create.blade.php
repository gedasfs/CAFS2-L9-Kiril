@extends('layouts.shop')
@section('title', 'Products - Create')

@section('content')
@include('products.partials.product', [
	'title' => 'Product create',
	'route' => route('products.store.v5'),
	'name' => fake()->word(),
	'description' => fake()->words(5, true),
	'identifier' =>  fake()->ean13(),
	'category_id' => old('category_id')
])
@endsection