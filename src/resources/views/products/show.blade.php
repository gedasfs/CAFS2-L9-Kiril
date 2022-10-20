@extends('layouts.shop', ['menu' => 'products'])
@section('title', 'Products')
@section('content')
<div class="text-end mb-2">
	<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
</div>
<div class="row row-cols-1 row-cols-md-2">
	<div class="col">
		<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
			</div>
			<div class="carousel-inner">
				<div class="carousel-item">
					<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false">
						<title>Placeholder</title>
						<rect width="100%" height="100%" fill="#777"></rect>
						<text x="50%" y="50%" fill="#555" dy=".3em">First slide</text>
					</svg>
				</div>
				<div class="carousel-item">
					<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false">
						<title>Placeholder</title>
						<rect width="100%" height="100%" fill="#666"></rect>
						<text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text>
					</svg>
				</div>
				<div class="carousel-item active">
					<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false">
						<title>Placeholder</title>
						<rect width="100%" height="100%" fill="#555"></rect>
						<text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text>
					</svg>
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
	<div class="col">
		<div class="h-100 p-5 bg-light border rounded-3">
			<h2>{{ $product->name }}</h2>
			<p>{{ $product->description }}</p>
		</div>
	</div>
</div>
@endsection