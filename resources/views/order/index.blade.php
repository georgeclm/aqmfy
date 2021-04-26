@extends('layouts.app')
@section('title', 'My Orders - Aqmfy')

@section('content')
    <section id="aa-catg-head-banner">
        <img src="http://bappeda.bengkuluselatankab.go.id/wp-content/uploads/2019/09/cropped-background-keren-8.jpg">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Orders Page</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('services.index') }}">Home</a></li>
                        <li class="active" style="color:rgb(189, 158, 158)">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- Cart view section -->
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table aa-wishlist-table">
                            <form action="">
                                @if ($orders->count() != 0)

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Product</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Payment Method</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <x-review :serviceid="$order->service_id" :orderid="$order->id" />
                                                    <tr>
                                                        <td><a href="{{ route('services.show', $order->service) }}"><img
                                                                    style="width: 150px"
                                                                    src="{{ asset($order->service->serviceImage()) }}"
                                                                    alt="img"></a>
                                                        </td>
                                                        <td><a class="aa-cart-title"
                                                                href="{{ route('services.show', $order->service) }}">{{ $order->service->name }}</a>
                                                        </td>
                                                        <td>{{ $order->payment_status }}</td>
                                                        <td>{{ $order->status }}</td>
                                                        <td>{{ $order->payment_method }}</td>

                                                        <td><button class="aa-add-to-cart-btn" data-bs-toggle="modal"
                                                                type="button" data-bs-target="#rating">Finish Order</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="d-grid gap-2 col-5 mx-auto text-center">
                                        <br><br>
                                        <h2 class="mb-3 fs-1">Orders is empty </h2>
                                        <a class="btn btn-primary btn-lg" href="{{ route('carts.index') }}">Check Cart</a>
                                    </div>

                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
