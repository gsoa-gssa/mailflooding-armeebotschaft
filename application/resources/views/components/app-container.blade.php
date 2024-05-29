<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__("flood.og.title")}}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=bebas-neue:400|eb-garamond:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet" />
    @vite(["resources/css/app.scss"])
</head>
<body>
    {{ $slot }}

    @vite(["resources/js/app.js"])
</body>
</html>
