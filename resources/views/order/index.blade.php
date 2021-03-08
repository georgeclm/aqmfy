@extends('layouts.app')
@section('title', 'My Orders - Colance')

@section('content')
    <div class="container">
        <div class="col-sm-10">
            <div class="trending-wrapper">
                @if ($orders->count() != 0)
                    <h2 class="mb-3">My Orders</h2>
                    @foreach ($orders as $service)
                        <div class="row searched-item cart-list-divider">
                            <div class="col-sm-3">
                                <a href="{{ route('services.show', $service) }}">
                                    <img width="150" src="{{ asset("storage/product/{$service->image}") }}">
                                </a>
                            </div>
                            <div class="col-sm-9">
                                <div class="">
                                    <h2>Name: {{ $service->name }}</h2>
                                    <h5>Delivery Status: {{ $service->status }}</h5>
                                    <h5>Description: {{ Str::limit($service->description, 40) }}</h5>
                                    <h5>Payment Status: {{ $service->payment_status }}</h5>
                                    <h5>Paymenent Method: {{ $service->payment_method }}</h5>
                                    <h5>Quantity: {{ $service->quantity }}</h5>


                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-grid gap-2 col-5 mx-auto text-center">
                        <br><br>
                        <h2 class="mb-3 fs-1">Order is empty </h2>
                        <a class="btn btn-outline-secondary btn-lg" href="{{ route('wishlists.show', auth()->user()) }}">
                            Go
                            to
                            Wishlist</a>
                    </div>

                @endif

            </div>
        </div>
    </div>

@endsection
