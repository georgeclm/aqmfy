@extends('layouts.app')
@section('title', 'Your Wishlist - Aqmfy')
@section('home')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('img/background.jpeg') }}">

        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Cart Page</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('services.index') }}">Home</a></li>
                        <li class="active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    @livewire('products-blade')



@endsection
