@extends('layouts.app')
@section('title', 'Your Wishlist - Colance')
@section('content')

    <div class="container">
        <div class="col-sm-10">
            <div class="trending-wrapper">
                @if ($carts->count() != 0)
                    <h2 class="mb-3">Your Wishlist</h2>
                    <a class="btn btn-success" href="{{ route('orders.show', auth()->user()) }}">Order Now</a> <br><br>

                    @foreach ($carts as $item)
                        <div class="row searched-item cart-list-divider">
                            <div class="col-sm-3">
                                <a href="detail/{{ $item->service->id }}">
                                    <img class="trending-image"
                                        src="{{ asset("storage/product/{$item->service->image}") }}">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <div class="">
                                    <h2>{{ $item->service->name }}</h2>
                                    <h5>{{ $item->service->description }}</h5>
                                    <h5>Rp. {{ number_format($item->service->price) }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">

                                <form action="{{ route('carts.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-warning">Remove from
                                        Wishlist</button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                    @if ($carts->count() > 4)
                        <a class="btn btn-success" href="{{ route('orders.show', auth()->user()) }}">Order Now</a>
                        <br><br>
                    @endif
                @else
                    <div class="d-grid gap-2 col-5 mx-auto text-center">
                        <br><br>
                        <h2 class="mb-3 fs-1">Wishlist is empty </h2>
                        <a class="btn btn-outline-primary btn-lg" href="{{ route('services.index') }}">Start Shopping</a>
                    </div>

                @endif


            </div>
        </div>
    </div>

@endsection
