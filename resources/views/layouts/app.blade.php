<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/Logo.png') }}" />


    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</head>

<body>
    <div id="app">
        <x-header />
        @if (session('error'))
            <div class="alert alert-danger">
                <ul>
                    <h6>{{ session('error') }}</h6>
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <ul>
                    <h6>{{ session('success') }}</h6>
                </ul>
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
        <x-footer />
    </div>
</body>
<script>
    $('.livesearch').select2({
        placeholder: 'Search',
        ajax: {
            url: '/search',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

</script>
<style>
    input[type='radio'] {
        transform: scale(2);
    }

    input[type=radio]+label::before {
        content: '';
        display: inline-block;
        margin: 0 0.5rem;
    }

    .custom-login {
        height: 500px;
        padding-top: 100px;
    }

    img.slider-img {
        height: 400px !important;
    }

    .custom-product {
        height: 600px;
    }

    .slider-text {
        background-color: #5c6d5c4a;
    }

    img.trending-image {
        height: 100px;
    }

    img.trending-image-search {
        height: 250px;
    }

    .trending-item {
        float: left;
        width: 20%;
    }

    .trending-wrapper {
        margin: 30px;
    }

    img.detail-img {
        height: 400px;
    }

    .search-box {
        width: 500px !important;
    }

    .cart-list-divider {
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
        padding-bottom: 20px;
    }

    .link-web a {
        color: #000;
        text-decoration: none;
        transition: color 0.5s;
    }

    .link-web a:hover {
        transition: 1s;
        border-bottom: 0px;
        color: #646786;

    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

</style>

</html>
