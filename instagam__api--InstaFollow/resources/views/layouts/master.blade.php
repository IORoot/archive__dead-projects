<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Instagram API</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
    <div id="app">

        @include('layouts.header')

        <div class="container">
            <div class="section">
                <div class="columns">
                    <div class="column is-one-quarter">
                        @include('layouts.nav')
                    </div>
                    <div class="column is-three-quarters">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>

    </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
        <script src="https://unpkg.com/vue@2.3.4/dist/vue.js"></script>
        <script src="/js/app.js"></script>



    </body>
</html>
