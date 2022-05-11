<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name=”robots” content=”noindex”/>


        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        {{-- facebook --}}
        {{-- <script>
            window.fbAsyncInit = function() {
            FB.init({
                appId      : '317549723867802',
                cookie     : true,
                xfbml      : true,
                version    : '{api-version}'
            });
            FB.AppEvents.logPageView();
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
        </script> --}}
        <script>
            window.fbAsyncInit = function() {
              FB.init({
                appId            : '317549723867802',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v13.0'
              });
            };
          </script>
          <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    </head>
    {{-- <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body> --}}
</html>
