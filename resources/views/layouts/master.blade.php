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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_PLACES_KEY')}}&libraries=places&callback=initMap" async defer></script>
</body>

@include('layouts.footer')

</html>