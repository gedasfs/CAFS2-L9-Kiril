<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}
        @vite(['resources/sass/shop.scss', 'resources/js/shop/app.js'])
        @stack('styles')
        <title>{{ config('app.name') }} - @yield('title')</title>
    </head>
    <body>
        <div class="container py-3">
            @include('partials.header')
            <main>
                <div class="text-end mb-2">
                    <a href="{{ route('products.create') }}" class="btn btn-success">Create Product</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-info">Orders</a>
                </div>
                @yield('content')
            </main>
            @include('partials.footer')
        </div>
        @stack('modals')
    </body>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> --}}
    @stack('scripts')
</html>