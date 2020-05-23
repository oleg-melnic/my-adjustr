<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ __('My Adjustr') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="/css/b4/bootstrap.css">
        <link rel="stylesheet" href="/css/all.css" />
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <script src="/js/jquery-3.4.1.slim.min.js" ></script>
        <script src="/js/popper.min.js" ></script>
        <script src="/js/bootstrap.min.js" ></script>
    </head>
    <body>
        @include('frontend.menu')
        @yield('content')
        @include('frontend.footer')
    </body>
</html>
