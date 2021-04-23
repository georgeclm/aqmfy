@extends('layouts.app')
@section('title', 'Your Wishlist - Aqmfy')
@section('content')
    @php
    use App\Models\Service;
    $user = auth()->user();
    $wishlists = $user->favorite()->pluck('service_id');
    $services = Service::whereIn('id', $wishlists)
        ->latest()
        ->get();

    @endphp
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="http://bappeda.bengkuluselatankab.go.id/wp-content/uploads/2019/09/cropped-background-keren-8.jpg">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Wishlist Page</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active" style="color:rgb(189, 158, 158)">Wishlist</li>
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
                                @if ($services->count() != 0)

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Stock Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($services as $service)
                                                    <tr>


                                                        <td>
                                                            <a class="remove"
                                                                href="{{ route('wishlists.wish', $service->id) }}">
                                                                <fa class="fa fa-close"></fa>
                                                            </a>
                                                        </td>
                                                        <td><a href="{{ route('services.show', $service) }}"><img
                                                                    style="width: 150px"
                                                                    src="{{ asset($service->serviceImage()) }}"
                                                                    alt="img"></a>
                                                        </td>
                                                        <td><a class="aa-cart-title"
                                                                href="{{ route('services.show', $service) }}">{{ $service->name }}</a>
                                                        </td>
                                                        <td>Rp. {{ number_format($service->price) }}</td>
                                                        <td>In Stock</td>
                                                        <td><a href="#" class="aa-add-to-cart-btn">Add To Cart</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="d-grid gap-2 col-5 mx-auto text-center">
                                        <br><br>
                                        <h2 class="mb-3 fs-1">Wishlist is empty </h2>
                                        <a class="btn btn-primary btn-lg" href="{{ route('services.index') }}">Start
                                            Shopping</a>
                                    </div>

                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
