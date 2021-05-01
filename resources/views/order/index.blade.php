@extends('layouts.app')
@section('title', 'My Orders - Aqmfy')

@section('content')
    <section id="aa-catg-head-banner">
        <img src="{{ asset('img/background.jpeg') }}">

        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Orders Page</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('services.index') }}">Home</a></li>
                        <li class="active">Order</li>
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
                                                <tr>
                                                    {{-- <x-review :serviceid="$order->service_id" :orderid="$order->id" /> --}}
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

                                                    <td><button class="aa-add-to-cart-btn" data-toggle="modal" type="button"
                                                            data-target="#{{ $order->id }}">Finish Order</button>
                                                        <div class="modal fade" id="{{ $order->id }}" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Please Rate
                                                                            The Photo "{{ $order->service->name }}"</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form action="{{ route('ratings.store') }}"
                                                                            method="POST" id="{{ $order->id }}form">
                                                                            @csrf
                                                                            <div class="rating" style="font-size:40px">
                                                                                <label>
                                                                                    <input type="radio" name="rating"
                                                                                        value="1" required />
                                                                                    <span class="icon">★</span>
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" name="rating"
                                                                                        value="2" />
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" name="rating"
                                                                                        value="3" />
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" name="rating"
                                                                                        value="4" />
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" name="rating"
                                                                                        value="5" />
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                    <span class="icon">★</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <textarea name="comment"
                                                                                    placeholder="Describe your satisfaction"
                                                                                    class="form-control" rows="5"
                                                                                    required></textarea>
                                                                            </div>
                                                                            <input type="hidden" name="order_id"
                                                                                value="{{ $order->id }}">
                                                                            <input type="hidden" name="service_id"
                                                                                value="{{ $order->service_id }}">
                                                                            <input type="submit" class="btn btn-primary"
                                                                                value="Send Rating" />
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        {{-- <input type="submit" form="{{ $order->id }}form"
                                                                        class="btn btn-primary" value="Send Rating" /> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
