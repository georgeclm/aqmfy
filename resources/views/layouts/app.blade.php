<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/aqmfy.jpg') }}" />

    <title>@yield('title')</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.simpleLens.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nouislider.css') }}">
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('css/theme-color/default-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/simple-notify.min.css') }}" />
    @livewireStyles
</head>

<body>
    <x-header />
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    @yield('home')
    <x-footer />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.smartmenus.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.smartmenus.bootstrap.js') }}"></script>
    <script src="{{ asset('js/sequence.js') }}"></script>
    <script src="{{ asset('js/sequence-theme.modern-slide-in.js') }}"></script>
    <script src="{{ asset('js/jquery.simpleGallery.js') }}"></script>
    <script src="{{ asset('js/jquery.simpleLens.js') }}"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="{{ asset('js/nouislider.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="{{ asset('js/simple-notify.min.js') }}"></script>
    @if (session('error'))
        <script>
            new Notify({
                status: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                effect: 'fade',
                speed: 300,
                customClass: null,
                customIcon: null,
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                gap: 20,
                distance: 20,
                type: 2,
                position: 'right top'
            })

        </script>
    @endif
    @if (session('warning'))
        <script>
            new Notify({
                status: 'warning',
                title: 'Warning',
                text: "{{ session('warning') }}",
                effect: 'fade',
                speed: 300,
                customClass: null,
                customIcon: null,
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                gap: 20,
                distance: 20,
                type: 2,
                position: 'right top'
            })

        </script>
    @endif
    @if (session('success'))
        <script>
            new Notify({
                status: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                effect: 'fade',
                speed: 300,
                customClass: null,
                customIcon: null,
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                gap: 20,
                distance: 20,
                type: 2,
                position: 'right top'
            })

        </script>
    @endif
    @livewireScripts
</body>
<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";

    $('input.typeahead').typeahead({
        source: function(query, process) {
            return $.get(path, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

</script>
<style>
    .glyphicon {
        margin-right: 5px;
    }

    .rating .glyphicon {
        font-size: 22px;
    }

    .rating-num {
        margin-top: 0px;
        font-size: 54px;
    }

    .progress {
        margin-bottom: 5px;
    }

    .progress-bar {
        text-align: left;
    }

    .rating-desc .col-md-3 {
        padding-right: 0px;
    }

    .sr-only {
        margin-left: 5px;
        overflow: visible;
        clip: auto;
    }

    .preview {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    @media screen and (max-width: 996px) {
        .preview {
            margin-bottom: 20px;
        }
    }

    .preview-pic {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }

    .preview-thumbnail.nav-tabs {
        border: none;
        margin-top: 15px;
    }

    .preview-thumbnail.nav-tabs li {
        width: 18%;
        margin-right: 2.5%;
    }

    .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block;
    }

    .preview-thumbnail.nav-tabs li a {
        padding: 0;
        margin: 0;
    }

    .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 0;
    }

    .tab-content {
        overflow: hidden;
    }

    .tab-content img {
        width: 100%;
        -webkit-animation-name: opacity;
        animation-name: opacity;
        -webkit-animation-duration: .3s;
        animation-duration: .3s;
    }

    .card {
        margin-top: 50px;
        background: #eee;
        padding: 3em;
        line-height: 1.5em;
    }

    @media screen and (min-width: 997px) {
        .wrapper {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }
    }

    .details {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .colors {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }

    .product-title,
    .price,
    .sizes,
    .colors {
        text-transform: UPPERCASE;
        font-weight: bold;
    }

    .checked,
    .price span {
        color: #ff9f1a;
    }

    .product-title,
    .rating,
    .product-description,
    .price,
    .vote,
    .sizes {
        margin-bottom: 15px;
    }

    .product-title {
        margin-top: 0;
    }

    .size {
        margin-right: 10px;
    }

    .size:first-of-type {
        margin-left: 40px;
    }

    .color {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        height: 2em;
        width: 2em;
        border-radius: 2px;
    }



    .color:first-of-type {
        margin-left: 20px;
    }

    .add-to-cart,
    .like {
        background: #ff9f1a;
        padding: 1.2em 1.5em;
        border: none;
        text-transform: UPPERCASE;
        font-weight: bold;
        color: #fff;
        -webkit-transition: background .3s ease;
        transition: background .3s ease;
    }

    .add-to-cart:hover,
    .like:hover {
        background: #b36800;
        color: #fff;
    }

    .not-available {
        text-align: center;
        line-height: 2em;
    }

    .not-available:before {
        font-family: fontawesome;
        content: "\f00d";
        color: #fff;
    }

    .orange {
        background: #ff9f1a;
    }

    .green {
        background: #85ad00;
    }

    .blue {
        background: #0076ad;
    }

    .tooltip-inner {
        padding: 1.3em;
    }

    @-webkit-keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3);
        }

        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    @keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3);
        }

        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        text-align: center;
    }

    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }

    .account-settings .user-profile .user-avatar img {
        width: 90px;
        height: 90px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
    }

    .account-settings .user-profile h5.user-name {
        margin: 0 0 0.5rem 0;
    }

    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-weight: 400;
        color: #9fa8b9;
    }

    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }

    .account-settings .about h5 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }

    .account-settings .about p {}

    .form-control {
        border: 1px solid #cfd1d8;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        background: #ffffff;
        color: #2e323c;
    }

    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }

    /**
 * Panels
 */
    /*** General styles ***/
    .panel {
        box-shadow: none;
    }

    .panel-heading {
        border-bottom: 0;
    }

    .panel-title {
        font-size: 17px;
    }

    .panel-title>small {
        font-size: .75em;
        color: #999999;
    }

    .panel-body *:first-child {
        margin-top: 0;
    }

    .panel-footer {
        border-top: 0;
    }

    .panel-default>.panel-heading {
        color: #333333;
        background-color: transparent;
        border-color: rgba(0, 0, 0, 0.07);
    }

    .file-upload {
        display: block;
        text-align: center;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .file-upload .file-select {
        display: block;
        border: 2px solid #dce4ec;
        color: #34495e;
        cursor: pointer;
        height: 40px;
        line-height: 40px;
        text-align: left;
        background: #FFFFFF;
        overflow: hidden;
        position: relative;
    }

    .file-upload .file-select .file-select-button {
        background: #dce4ec;
        padding: 0 10px;
        display: inline-block;
        height: 40px;
        line-height: 40px;
    }

    .file-upload .file-select .file-select-name {
        line-height: 40px;
        display: inline-block;
        padding: 0 10px;
    }

    .file-upload .file-select:hover {
        border-color: #34495e;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload .file-select:hover .file-select-button {
        background: #34495e;
        color: #FFFFFF;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload.active .file-select {
        border-color: #3fa46a;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload.active .file-select .file-select-button {
        background: #3fa46a;
        color: #FFFFFF;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload .file-select input[type=file] {
        z-index: 100;
        cursor: pointer;
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        filter: alpha(opacity=0);
    }

    .file-upload .file-select.file-select-disabled {
        opacity: 0.65;
    }

    .file-upload .file-select.file-select-disabled:hover {
        cursor: default;
        display: block;
        border: 2px solid #dce4ec;
        color: #34495e;
        cursor: pointer;
        height: 40px;
        line-height: 40px;
        margin-top: 5px;
        text-align: left;
        background: #FFFFFF;
        overflow: hidden;
        position: relative;
    }

    .file-upload .file-select.file-select-disabled:hover .file-select-button {
        background: #dce4ec;
        color: #666666;
        padding: 0 10px;
        display: inline-block;
        height: 40px;
        line-height: 40px;
    }

    .file-upload .file-select.file-select-disabled:hover .file-select-name {
        line-height: 40px;
        display: inline-block;
        padding: 0 10px;
    }

    /**
 * Profile
 */
    /*** Profile: Header  ***/
    .profile__avatar {
        float: left;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 20px;
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .profile__avatar {
            width: 100px;
            height: 100px;
        }
    }

    .profile__avatar>img {
        width: 100%;
        height: auto;
    }

    .profile__header {
        overflow: hidden;
    }

    .profile__header p {
        margin: 20px 0;
    }

    /*** Profile: Table ***/
    @media (min-width: 992px) {
        .profile__table tbody th {
            width: 200px;
        }
    }

    /*** Profile: Recent activity ***/
    .profile-comments__item {
        position: relative;
        padding: 15px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .profile-comments__item:last-child {
        border-bottom: 0;
    }

    .profile-comments__item:hover,
    .profile-comments__item:focus {
        background-color: #f5f5f5;
    }

    .profile-comments__item:hover .profile-comments__controls,
    .profile-comments__item:focus .profile-comments__controls {
        visibility: visible;
    }

    .profile-comments__controls {
        position: absolute;
        top: 0;
        right: 0;
        padding: 5px;
        visibility: hidden;
    }

    .profile-comments__controls>a {
        display: inline-block;
        padding: 2px;
        color: #999999;
    }

    .profile-comments__controls>a:hover,
    .profile-comments__controls>a:focus {
        color: #333333;
    }

    .profile-comments__avatar {
        display: block;
        float: left;
        margin-right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
    }

    .profile-comments__avatar>img {
        width: 100%;
        height: auto;
    }

    .profile-comments__body {
        overflow: hidden;
    }

    .profile-comments__sender {
        color: #333333;
        font-weight: 500;
        margin: 5px 0;
    }

    .profile-comments__sender>small {
        margin-left: 5px;
        font-size: 12px;
        font-weight: 400;
        color: #999999;
    }

    @media (max-width: 767px) {
        .profile-comments__sender>small {
            display: block;
            margin: 5px 0 10px;
        }
    }

    .profile-comments__content {
        color: #999999;
    }

    /*** Profile: Contact ***/
    .profile__contact-btn {
        padding: 12px 20px;
        margin-bottom: 20px;
    }

    .profile__contact-hr {
        position: relative;
        border-color: rgba(0, 0, 0, 0.1);
        margin: 40px 0;
    }

    .profile__contact-hr:before {
        content: "OR";
        display: block;
        padding: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        background-color: #f5f5f5;
        color: #c6c6cc;
    }

    .profile__contact-info-item {
        margin-bottom: 30px;
    }

    .profile__contact-info-item:before,
    .profile__contact-info-item:after {
        content: " ";
        display: table;
    }

    .profile__contact-info-item:after {
        clear: both;
    }

    .profile__contact-info-item:before,
    .profile__contact-info-item:after {
        content: " ";
        display: table;
    }

    .profile__contact-info-item:after {
        clear: both;
    }

    .profile__contact-info-icon {
        float: left;
        font-size: 18px;
        color: #999999;
    }

    .profile__contact-info-body {
        overflow: hidden;
        padding-left: 20px;
        color: #999999;
    }

    .profile__contact-info-body a {
        color: #999999;
    }

    .profile__contact-info-body a:hover,
    .profile__contact-info-body a:focus {
        color: #999999;
        text-decoration: none;
    }

    .profile__contact-info-heading {
        margin-top: 2px;
        margin-bottom: 5px;
        font-weight: 500;
        color: #999999;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }

    .form-signin .checkbox {
        font-weight: normal;
    }

    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .form-signin input[type="password"] {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .account-wall {
        margin-top: 20px;
        padding: 40px 0px 20px 0px;
        background-color: #f7f7f7;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    .login-title {
        color: #555;
        font-size: 18px;
        font-weight: 400;
        display: block;
    }

    .profile-img {
        width: 96px;
        height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    .need-help {
        margin-top: 10px;
    }

    .new-account {
        display: block;
        margin-top: 10px;
    }

    .divider {
        width: 15px;
        height: auto;
        display: inline-block;
    }

    a:hover {
        text-decoration: none;
    }

    img {
        max-width: 100%;
    }

    /*Product Box*/
    .maxproduct {
        max-height: 300px;
        overflow: hidden;
        display: inline-block;
    }

    .productbox {
        background: #fff;
        padding: 13px;
        border: 1px solid #e4e4e4;
        margin-bottom: 30px;
    }

    .productbox h1 {
        display: block;
        font-size: 17px;
        text-transform: uppercase;
        margin-top: 15px;
        border-bottom: double medium #eee;
        padding-bottom: 15px;
        margin-bottom: 10px;
        font-weight: 500;
        color: #333;
    }

    .productbox .price {
        font-weight: 400;
    }

    .shopsection .productbox {
        margin-bottom: 30px;
    }

    .fadeshop {
        position: relative;
        max-height: 300px;
    }

    .captionshop {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        background-color: #00bba7;
        width: 100%;
        height: 100%;
    }



    .captionshop h3,
    .captionshop p {
        color: #fff;
        margin: 20px;
    }

    .captionshop h3 {
        margin: 30px 20px 10px;
    }

    .captionshop p {
        font-size: 15px;
        margin: 0 20px 15px;
    }

    .captionshop a.learn-more {
        padding: 8px 12px;
        background: transparent;
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        border: 1px solid;
        display: inline-block;
        min-width: 120px;
        text-transform: uppercase;
        font-size: 16px;
    }

    .captionshop a.learn-more.detailslearn {
        margin-left: -1px;
    }

    .captionshop a.learn-more:hover {
        background: #fff;
        color: #00bba7;
        display: inline-block;
        border: 1px solid #fff;
    }

    .product-details {
        padding: 6px 0 0 0;
        text-align: center;
        color: #444;
    }


    :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
    }

    .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
    }

    .card-signin .card-body {
        padding: 2rem;
    }

    .form-signin {
        width: 100%;
    }

    .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
    }

    .form-label-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-label-group input {
        height: auto;
        border-radius: 2rem;
    }

    .form-label-group>input,
    .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
    }

    .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
        color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-moz-placeholder {
        color: transparent;
    }

    .form-label-group input::placeholder {
        color: transparent;
    }

    .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
    }

    .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
    }

    .btn-google {
        color: white;
        background-color: #ea4335;
    }

    .btn-twitter {
        color: white;
        background-color: #6ca0ca;
    }


    .btn-facebook {
        color: white;
        background-color: #3b5998;
    }

    /* Fallback for Edge
-------------------------------------------------- */

    @supports (-ms-ime-align: auto) {
        .form-label-group>label {
            display: none;
        }

        .form-label-group input::-ms-input-placeholder {
            color: #777;
        }
    }

    /* Fallback for IE
-------------------------------------------------- */

    @media all and (-ms-high-contrast: none),
    (-ms-high-contrast: active) {
        .form-label-group>label {
            display: none;
        }

        .form-label-group input:-ms-input-placeholder {
            color: #777;
        }
    }

    /*
 * Globals
 */


    /* Custom default button */
    .btn-secondary,
    .btn-secondary:hover,
    .btn-secondary:focus {
        color: rgb(29, 28, 28);
        text-shadow: none;
        /* Prevent inheritance from `body` */
    }


    /*
 * Base structure
 */
    a {
        text-decoration: none;
        color: #333333;
    }

    a:hover,
    a:focus {
        outline: none;
        text-decoration: none;
    }


    .cover-container {
        max-width: 42em;
    }


    /*
 * Header
 */

    .nav-masthead .nav-link {
        padding: .25rem 0;
        font-weight: 700;
        color: rgba(0, 0, 0, 0.5);
        background-color: transparent;
        border-bottom: .25rem solid transparent;
    }

    .nav-masthead .nav-link:hover,
    .nav-masthead .nav-link:focus {
        border-bottom-color: rgba(0, 0, 0, 0.103);
    }

    .nav-masthead .nav-link+.nav-link {
        margin-left: 1rem;
    }

    .nav-masthead .active {
        color: rgb(0, 0, 0);
        border-bottom-color: rgb(0, 0, 0);
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
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
