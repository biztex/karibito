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
        <script>
            window.fbAsyncInit = function() {
            FB.init({
                appId      : '563484035495913',
                cookie     : true,
                xfbml      : true,
                version    : 'v13.0'
            });
                FB.AppEvents.logPageView();
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                    console.log(response);
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            function statusChangeCallback(response) {
                        console.log('statusChangeCallback');
                        console.log(response);
                        // The response object is returned with a status field that lets the
                        // app know the current login status of the person.
                        // Full docs on the response object can be found in the documentation
                        // for FB.getLoginStatus().
                        if (response.status === 'connected') {
                            // Logged into your app and Facebook.
                            console.log('Welcome!  Fetching your information.... ');
                            FB.api('/me', function (response) {
                                console.log('Successful login for: ' + response.name);
                                document.getElementById('status').innerHTML =
                                  'Thanks for logging in, ' + response.name + '!';
                            });
                        } else {
                            // The person is not logged into your app or we are unable to tell.
                            document.getElementById('status').innerHTML = 'Please log ' +
                              'into this app.';
                        }
                    }
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
