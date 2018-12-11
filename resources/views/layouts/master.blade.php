<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inhabit') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>

<body>
    <div id="app">
    <!-- TODO: make loading component -->
        <div class="container has-text-centered" v-if="!$auth.ready()">
            Loading ...
        </div>
        <div  v-else-if ="$auth.ready()">
            <navbar class="navbar navbar-height" :app-name="{{ json_encode(config('app.name', 'Inhabit')) }}"></navbar>
            @yield('content')
            <router-view></router-view>
        </div>
    </div>
    <!-- &callback=initMap TODO ADD THIS TO THE END OF THE API IF YOU HAVE A MAP TO SHOW -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_PLACES_KEY')}}&libraries=places" async defer></script>
</body>

@include('layouts.footer')

</html>