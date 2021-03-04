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
                                <a href="detail/{{ $item->id }}">
                                    <img class="trending-image" src="{{ asset("products/{$item->image}") }}">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <div class="">
                                    <h2>Name: {{ $item->name }}</h2>
                                    <h5>Delivery Status: {{ $item->status }}</h5>
                                    <h5>Address: {{ $item->address }}</h5>
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
                        <a class="btn btn-outline-secondary btn-lg" href="{{ route('carts.show', auth()->user()) }}"> Go to
                            Cart</a>
                    </div>

                @endif

            </div>
        </div>
    </div>

@endsection
