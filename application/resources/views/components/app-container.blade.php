<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__("flood.og.title")}}</title>
    <meta name="title" content="{{__("flood.og.title")}}" />
    <meta name="description" content="{{__("flood.og.description")}}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{app()->make('url')->to('/')}}" />
    <meta property="og:title" content="{{__("flood.og.title")}}" />
    <meta property="og:description" content="{{__("flood.og.description")}}" />
    <meta property="og:image" content="{{app()->make('url')->to('/')}}/images/og/og_{{app()->getLocale()}}.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{app()->make('url')->to('/')}}" />
    <meta property="twitter:title" content="{{__("flood.og.title")}}" />
    <meta property="twitter:description" content="{{__("flood.og.description")}}" />
    <meta property="twitter:image" content="{{app()->make('url')->to('/')}}/images/og/og_{{app()->getLocale()}}.png" />

    <!-- Meta Tags Generated with https://metatags.io -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=bebas-neue:400|eb-garamond:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#28eb64">
    <link rel="shortcut icon" href="/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#28eb64">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#28eb64">
    @vite(["resources/css/app.scss"])
</head>
<body>
    {{ $slot }}

    @vite(["resources/js/app.js"])
</body>
</html>
