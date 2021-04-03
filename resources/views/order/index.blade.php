@extends('layouts.app')
@section('title', 'My Orders - Colance')

@section('content')
    <div class="container">
        {{-- @if (session('rating')) --}}

        {{-- @endif --}}

        <div class="col-sm-10">
            <div class="trending-wrapper">
                @if ($orders->count() != 0)
                    <h2 class="mb-3">My Orders</h2>
                    @foreach ($orders as $order)
                        {{-- <x-review :serviceid="$order->service_id" :orderid="$order->id" /> --}}
                        <div class="modal fade" id="rating" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Please Rate The Service</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('ratings.store') }}" id="ratingform" method="POST">
                                            @csrf
                                            <div class="rating" style="text-shadow: none">
                                                <label>
                                                    <input type="radio" name="rating" value="1" required />
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="rating" value="2" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="rating" value="3" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="rating" value="4" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="rating" value="5" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="comment" placeholder="Describe your satisfaction"
                                                    class="form-control" rows="5" required></textarea>
                                            </div>
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="service_id" value="{{ $order->service_id }}">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="submit" form="ratingform" class="btn btn-primary"
                                            value="Send Rating" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row searched-item cart-list-divider">
                            <div class="col-sm-3">
                                <a href="{{ route('services.show', $order->service_id) }}">
                                    <img width="150" src="{{ asset("uploads/service/{$order->image}") }}">
                                </a>
                            </div>
                            <div class="col-sm-7">
                                <div class="">
                                    <h2>Name: {{ $order->name }}</h2>
                                    <h5>Delivery Status: {{ $order->status }}</h5>
                                    <h5>Description: {{ Str::limit($order->description, 40) }}</h5>
                                    <h5>Payment Status: {{ $order->payment_status }}</h5>
                                    <h5>Paymenent Method: {{ $order->payment_method }}</h5>
                                    <h5>Quantity: {{ $order->quantity }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-outline-success" data-bs-toggle="modal" type="button"
                                    data-bs-target="#rating">Finish Order</button>
                            </div>

                        </div>
                    @endforeach

                @else
                    <div class="d-grid gap-2 col-5 mx-auto text-center">
                        <br><br>
                        <h2 class="mb-3 fs-1">Order is empty </h2>
                        <a class="btn btn-outline-secondary btn-lg" href="{{ route('wishlists.show', auth()->user()) }}">
                            Go to Wishlist</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
