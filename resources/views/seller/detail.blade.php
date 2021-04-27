@extends('layouts.app')
@section('title', "{$seller->sellername} - Aqmfy")

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-9">
                <br><br><br><br>
                <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Send a Message</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('messages.store') }}" id="ratingform" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            <img src="{{ asset($seller->sellerImage()) }}" class="rounded-circle mb-1"
                                                width="75px" height="75px">
                                            <h6>{{ $seller->sellername }}</h6>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <textarea name="message" placeholder="Your Message" class="form-control"
                                                    rows="7" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="subject" value="From Profile">
                                    <input type="hidden" name="recipients[]" value="{{ $seller->user->id }}">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" form="ratingform" class="btn btn-primary" value="Send Message" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User profile -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">User profile</h4>
                    </div>
                    <div class="panel-body">
                        <div class="profile__avatar">
                            <img src="{{ asset($seller->sellerImage()) }}" alt="...">
                        </div>
                        <div class="profile__header">
                            <h4>{{ $seller->sellername }} </h4>
                            <p class="text-muted">
                                {{ $seller->description }}
                            </p>
                            <p>
                                <a href="{{ $seller->url }}">{{ $seller->url }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- User info -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">User info</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table profile__table">
                            <tbody>
                                <tr>
                                    <th><strong>Location</strong></th>
                                    <td>{{ $seller->address }}</td>
                                </tr>
                                <tr>
                                    <th><strong>Followers</strong></th>
                                    <td>{{ $seller->followers->count() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- product category -->
                @if ($seller->user()->isNot(auth()->user()))
                    <section id="aa-product-category">
                        <div class="container">
                            <h2> {{ $seller->sellername }} Photo</h2>
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-8">
                                    <div class="aa-product-catg-content">
                                        <br>
                                        <div class="aa-product-catg-body">
                                            <ul class="aa-product-catg">
                                                <!-- start single product item -->
                                                @if ($services->count() != 0)

                                                    @foreach ($services as $service)

                                                        <li>
                                                            <figure>
                                                                <a class="aa-product-img"
                                                                    href="{{ route('services.show', $service) }}"><img
                                                                        src="{{ asset($service->serviceImage()) }}"></a>
                                                                @if ($service->seller->user()->isNot(auth()->user()))
                                                                    <form action="{{ route('carts.store') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="service_id"
                                                                            value="{{ $service->id }}">
                                                                        <input type="hidden" name="price"
                                                                            value="{{ $service->price }}">
                                                                        <button class="aa-add-card-btn btn-block"><span
                                                                                class="fa fa-shopping-cart"></span>Add To
                                                                            Cart</button>
                                                                    </form>
                                                                @endif
                                                                <figcaption>
                                                                    <h4 class="aa-product-title"><a
                                                                            href="{{ route('services.show', $service) }}">{{ $service->name }}</a>
                                                                    </h4>
                                                                    <span class="aa-product-price">Rp.
                                                                        {{ number_format($service->price) }}</span>
                                                                    {{-- class="aa-product-price"><del>$65.50</del></span> --}} <p class="aa-product-descrip">
                                                                        {{ Str::of($service->description)->title()->words(20) }}
                                                                    </p>
                                                                    @php
                                                                        $average = $service->ratings->average('rating');
                                                                    @endphp
                                                                    @if ($average != 0)
                                                                        <div class="price" style="margin-top: 5px">
                                                                            <span class="edd_price"><span
                                                                                    class="icon">★</span><strong>
                                                                                    {{ number_format($average, 1) }}</strong>
                                                                                <span
                                                                                    class="text-muted">({{ $service->ratings->count() }})</span></span>
                                                                        </div>

                                                                    @endif
                                                                </figcaption>
                                                            </figure>
                                                            <div class="aa-product-hvr-content">
                                                                @if ($service->seller->user()->isNot(auth()->user()))
                                                                    <a href="{{ route('wishlists.wish', $service->id) }}"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Add to Wishlist"><span
                                                                            class="fa fa-heart-o"></span></a>
                                                                @endif
                                                                <a href="{{ route('services.download', $service) }}"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Download"><span
                                                                        class="fa fa-download"></span></a>
                                                                <a href="{{ route('services.show', $service) }}"><span
                                                                        class="fa fa-search"></span></a>
                                                            </div>
                                                            <!-- product badge -->
                                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="d-grid gap-2 col-5 mx-auto text-center">
                                                        <br><br>
                                                        <h2 class="mb-3 fs-1">This Seller Hasn't Sell Any Photo Yet</h2>

                                                    </div>
                                                @endif

                                            </ul>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                            {{ $services->links() }}
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </section>
                    <!-- / product category -->
                @else
                    <!-- Cart view section -->
                    <section id="cart-view">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-view-area">
                                        <div class="cart-view-table aa-wishlist-table">
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
                                                                        <form
                                                                            action="{{ route('services.destroy', $service) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="fa fa-close"></button>
                                                                        </form>

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
                                                                    <td><a href="{{ route('services.edit', $service) }}"
                                                                            class="aa-add-to-cart-btn">Edit Photo</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <div class="d-flex justify-content-center">
                                                            {{ $services->links() }}
                                                        </div>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="d-grid gap-2 col-5 mx-auto text-center">
                                                    <br><br>
                                                    <h2 class="mb-3 fs-1">Start Selling Now</h2>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>
            <div class="col-xs-12 col-sm-3">
                <br><br><br><br>
                <!-- Contact user -->
                <p>
                    @if ($seller->user()->isNot(auth()->user()))
                        <button data-toggle="modal" data-target="#message"
                            class="profile__contact-btn btn btn-lg btn-block btn-info">
                            Contact user
                        </button>
                        <follow-button route={{ route('follows.add', $seller->id) }} follows="{{ $follows }}">
                        </follow-button>
                    @else
                        <a href="{{ route('services.create') }}"
                            class="profile__contact-btn btn btn-lg btn-block btn-info">
                            Add Photo
                        </a>
                        <a href="{{ route('sellers.edit', $seller) }}"
                            class="profile__contact-btn btn btn-lg btn-block btn-info">
                            Update Profile
                        </a>
                    @endif

                </p>

                <hr class="profile__contact-hr">

                <!-- Contact info -->
                <div class="profile__contact-info">
                    <div class="profile__contact-info-item">
                        <div class="profile__contact-info-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="profile__contact-info-body">
                            <h5 class="profile__contact-info-heading">Phone number</h5>
                            {{ $seller->phone_num }}
                        </div>
                    </div>

                    <div class="profile__contact-info-item">
                        <div class="profile__contact-info-icon">
                            <i class="fa fa-envelope-square"></i>
                        </div>
                        <div class="profile__contact-info-body">
                            <h5 class="profile__contact-info-heading">E-mail address</h5>
                            <a href="mailto:{{ $seller->user->email }}">{{ $seller->user->email }}</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ asset($seller->sellerImage()) }}" class="rounded-circle" width="200px" height="200px">

            </div>
            <div class="link-web col-sm-4">
                <a href="{{ route('services.index') }}" class="btn btn-outline-primary mb-3">Back</a>
                <h2><strong>{{ $seller->sellername }}</strong></h2>
                <h3>{{ $seller->address }}</h3>
                <a class="h3" href="{{ $seller->url }}" target="blank">{{ $seller->url }}</a>
                <div class="h4 mt-2">
                    <strong>{{ $seller->followers->count() }}</strong>
                    followers
                </div>
            </div>
            <div class="col-sm-4">
                <div class="h4"><strong> Description</strong></div>
                <div class="h5">{{ $seller->description }}</div>
            </div>
            @if ($seller->user()->is(auth()->user()))
                <div class="col-sm-2 align-self-end">
                    <a href="{{ route('services.create') }}" class="btn btn-outline-success mb-3">Add
                        Service</a>
                    <a href="{{ route('sellers.edit', $seller) }}" class="btn btn-outline-secondary mb-3">Update
                        Seller
                        Profile</a>
                </div>
            @else
                <follow-button route={{ route('follows.add', $seller->id) }} follows="{{ $follows }}">
                </follow-button>
            @endif

        </div>
        <div class="row">
            <div class="container trending-wrapper mb-5">
                @if ($services->count())
                    <h3 class='mb-4 text-center'>
                    @if ($seller->user()->is(auth()->user()))Your Services @else
                            {{ $seller->sellername }} Services @endif
                    </h3>
                    <div class="row row-cols-1 row-cols-md-6">
                        @if ($services->count())
                            <div class="col-md-12 text-muted mb-3">Found {{ $services->count() }} results</div>

                            @foreach ($services as $service)

                                <div class="col-md-4 link-web">
                                    <div class="productbox">
                                        <div class="fadeshop">
                                            <div class="captionshop text-center">
                                                <h3>{{ $service->seller->sellername }}</h3>
                                                <p>
                                                    {{ Str::of($service->description)->title()->words(59) }}
                                                </p>
                                                <p>
                                                    @if ($service->seller->user()->isNot(auth()->user()))
                                                        <a href="{{ route('orders.show', $service) }}"
                                                            class="learn-more detailslearn"><i
                                                                class="fa fa-shopping-cart"></i>
                                                            Purchase</a>
                                                    @endif
                                                    <a href="{{ route('services.show', $service) }}"
                                                        class="learn-more detailslearn"><i class="fa fa-link"></i>
                                                        Details</a>
                                                </p>
                                            </div>
                                            <span class="maxproduct"><img src="{{ asset($service->serviceImage()) }}"
                                                    alt=""></span>
                                        </div>
                                        <div class="product-details">
                                            <a href="{{ route('services.show', $service) }}">
                                                <h1>{{ $service->name }}</h1>
                                            </a>
                                            <span class="price">
                                                <span class="edd_price">Rp. {{ number_format($service->price) }}</span>
                                            </span>
                                            @php
                                                $average = $service->ratings->average('rating');
                                            @endphp
                                            @if ($average != 0)
                                                <div class="price">
                                                    <span class="edd_price"><span class="icon">★</span><strong>
                                                            {{ number_format($average, 1) }}</strong> <span
                                                            class="text-muted">({{ $service->ratings->count() }})</span></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="h4">Photos Not Found</div>
                        @endif
                    </div>

                @else
                    <h3>
                        @if ($seller->user()->is(auth()->user()))You didn't Sell any
                            Service
                        Yet @else
                            {{ $seller->sellername }} Didn't Have any Services Yet @endif
                    </h3>
                @endif
            </div>
        </div>
    </div> --}}
@endsection
