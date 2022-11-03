<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/sass/shop.scss', 'resources/js/shop-vue/app.js'])
        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        <div id="shop"></div>
    </body>
</html>