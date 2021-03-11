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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    /* Rating */
    .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 50px;
        font-size: 50px;
    }

    .ratingindex {
        display: inline-block;
        position: relative;
        height: 20px;
        line-height: 20px;
        font-size: 20px;
    }

    .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
    }

    .rating label:last-child {
        position: static;
    }

    .rating label:nth-child(1) {
        z-index: 5;
    }

    .rating label:nth-child(2) {
        z-index: 4;
    }

    .rating label:nth-child(3) {
        z-index: 3;
    }

    .rating label:nth-child(4) {
        z-index: 2;
    }

    .rating label:nth-child(5) {
        z-index: 1;
    }

    .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .rating label .icon {
        float: left;
        color: transparent;
    }

    .rating label:last-child .icon {
        color: #000;
    }

    .rating:not(:hover) label input:checked~.icon,
    .rating:hover label:hover input~.icon {
        color: #09f;
    }

    .rating label input:focus:not(:checked)~.icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #09f;
    }

    .heading {
        font-size: 25px;
        margin-right: 25px;
    }

    .fa {
        font-size: 25px;
    }

    .fb {
        font-size: 15px;
    }

    .checked {
        color: orange;
    }

    /* Three column layout */
    .side {
        float: left;
        width: 15%;
        margin-top: 10px;
    }

    .middle {
        float: left;
        width: 70%;
        margin-top: 10px;
    }

    /* Place text to the right */
    .right {
        text-align: right;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }



    /* Responsive layout - make the columns stack on top of each other instead of next to each other */
    @media (max-width: 400px) {

        .side,
        .middle {
            width: 100%;
        }

        /* Hide the right column on small screens */
        .right {
            display: none;
        }
    }

</style>

</html>
