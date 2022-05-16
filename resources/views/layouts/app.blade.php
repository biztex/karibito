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
            function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
                console.log('statusChangeCallback');
                console.log(response);                   // The current login status of the person.
              if (response.status === 'connected') {   // Logged into your webpage and Facebook.
                FB.logout(function(response) {
                // Person is now logged out
            });
                // testAPI();
              } else {                                 // Not logged into your webpage or we are unable to tell.
                document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
            }
        }

            function checkLoginState() {               // Called when a person is finished with the Login Button.
              FB.getLoginStatus(function(response) {   // See the onlogin handler
                statusChangeCallback(response);
                });
            }

            window.fbAsyncInit = function() {
                FB.init({
                appId      : '563484035495913',
                cookie     : true,                     // Enable cookies to allow the server to access the session.
                xfbml      : true,                     // Parse social plugins on this webpage.
                version    : 'v13.0'           // Use this Graph API version for this call.
            });

              FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
                statusChangeCallback(response);        // Returns the login status.
                });
            };

            function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                console.log('Successful login for: ' + response.name);
                // document.getElementById('status').innerHTML =
                //   'Thanks for logging in, ' + response.name + '!';
                window.location.href='https://karibito.4sis.site/'
            });
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
