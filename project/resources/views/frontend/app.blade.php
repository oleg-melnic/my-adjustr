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
        <script type="text/javascript">
            (function(w,d){
                w.HelpCrunch=function(){w.HelpCrunch.q.push(arguments)};w.HelpCrunch.q=[];
                function r(){var s=document.createElement('script');s.async=1;s.type='text/javascript';s.src='https://widget.helpcrunch.com/';(d.body||d.head).appendChild(s);}
                if(w.attachEvent){w.attachEvent('onload',r)}else{w.addEventListener('load',r,false)}
            })(window, document)
        </script>

        <script type="text/javascript">
            HelpCrunch('init', 'adjustr', {
                applicationId: 1,
                applicationSecret: 't6fjK7aeCTPsrqwAx5HA+Xaa8zQAL3gGWHarcqVcJgJBdYDw2jQx8v0Lca+oVWjOF5HKjQvi7XCQe7V0cHmE/Q=='
            });

            HelpCrunch('showChatWidget');
        </script>
    </head>
    <body>
        @include('frontend.menu')
        @yield('content')
        @include('frontend.footer')
    </body>
</html>
