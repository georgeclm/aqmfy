@extends('layouts.app')
@section('title', 'My Orders - Colance')

@section('content')
    <div class="container">
        <div class="col-sm-10">
            <div class="trending-wrapper">
                @if ($orders->count() != 0)
                    <h2 class="mb-3">My Orders</h2>
                    @foreach ($orders as $item)
                        <div class="row searched-item cart-list-divider">
                            <div class="col-sm-3">
                                <a href="{{ route('services.show', $item->id) }}">
                                    <img width="150" src="{{ asset("storage/product/{$item->image}") }}">
                                </a>
                            </div>
                            <div class="col-sm-9">
                                <div class="">
                                    <h2>Name: {{ $item->name }}</h2>
                                    <h5>Delivery Status: {{ $item->status }}</h5>
                                    <h5>Description: {{ Str::limit($item->description, 40) }}</h5>
                                    <h5>Payment Status: {{ $item->payment_status }}</h5>
                                    <h5>Paymenent Method: {{ $item->payment_method }}</h5>

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
