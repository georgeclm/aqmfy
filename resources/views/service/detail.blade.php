@extends('layouts.app')
@section('title', "{$service->name} by {$service->seller->sellername}")
@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('img/background.jpeg') }}">

        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>{{ $service->name }}</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('services.index') }}">Home</a></li>
                        <li><a href="{{ route('services.all') }}">Product</a></li>
                        <li class="active">{{ $service->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-details">
        <!-- Trigger the modal with a button -->
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
                                    <img src="{{ asset($service->seller->sellerImage()) }}" class="rounded-circle mb-1"
                                        width="75px" height="75px">
                                    <h6>{{ $service->seller->sellername }}</h6>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="{{ $service->name }}" class="form-control"
                                            rows="7" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="subject" value="{{ $service->name }}">
                            <input type="hidden" name="recipients[]" value="{{ $service->seller->user->id }}">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" form="ratingform" class="btn btn-primary" value="Send Message" />
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container"><a
                                                        data-lens-image="{{ asset($service->serviceImage()) }}"
                                                        class=" simpleLens-lens-image"><img
                                                            src="{{ asset($service->serviceImage()) }}"
                                                            class="simpleLens-big-image"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{ $service->name }}</h3>
                                        <div class="aa-price-block">
                                            <span class="aa-product-view-price">Rp.
                                                {{ number_format($service->price) }}</span>
                                            <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                        </div>
                                        <p>{{ Str::of($service->description)->title()->words(20) }}</p>

                                        <div class="aa-prod-quantity">
                                            <form action="">
                                                <select id="" name="" disabled>
                                                    <option selected="1" value="0">1</option>
                                                    <option value="1">2</option>
                                                    <option value="2">3</option>
                                                    <option value="3">4</option>
                                                    <option value="4">5</option>
                                                    <option value="5">6</option>
                                                </select>
                                            </form>
                                            <p class="aa-prod-category">
                                                Category: <a
                                                    href="{{ route('search.category', $service->category) }}">{{ $service->category->name }}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            @if ($service->seller->user()->isNot(auth()->user()))
                                                <form action="{{ route('carts.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                    <input type="hidden" name="price" value="{{ $service->price }}">
                                                    <button class="aa-add-to-cart-btn">Add To Cart</button>
                                                </form>
                                                @auth
                                                    <br>
                                                    <wishlist-button route="{{ route('wishlists.add', $service->id) }}"
                                                        favorite="{{ $favorite }}">
                                                    </wishlist-button>
                                                @endauth
                                            @else
                                                <form action="{{ route('services.destroy', $service) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('services.edit', $service) }}"
                                                        class="aa-add-to-cart-btn">Edit Photo</a>
                                                    <button class="aa-add-to-cart-btn">Remove Photo</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    {{ $service->description }}
                                </div>
                                <div class="tab-pane fade " id="review">
                                    <div class="aa-product-review-area">
                                        @if (count($stars) != 0)
                                            <h4>Reviews for {{ $service->name }}</h4>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-6">
                                                        <div class="well well-sm">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-md-6 text-center">
                                                                    <h1 class="rating-num">
                                                                        {{ number_format($average, 1) }}</h1>
                                                                    <div class="rating">
                                                                        <span class="fa @if ($average>= 5) fa-star @endif"></span><span
                                                                            class="fa @if ($average>=
                                                                            5) fa-star @endif">
                                                                        </span><span class="fa @if ($average>= 5) fa-star @endif"></span><span
                                                                            class="fa @if ($average>=
                                                                            5) fa-star @endif">
                                                                        </span><span class="fa @if ($average>= 5) fa-star @endif"></span>
                                                                    </div>
                                                                    <div>
                                                                        <span
                                                                            class="fa fa-user"></span>{{ $service->ratings->count() }}
                                                                        total
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-md-6">
                                                                    <div class="row rating-desc">
                                                                        <div class="col-xs-3 col-md-3 text-right">
                                                                            5
                                                                        </div>
                                                                        <div class="col-xs-8 col-md-9">
                                                                            <div class="progress progress">
                                                                                <div class="progress-bar progress-bar-success"
                                                                                    role="progressbar" aria-valuenow="20"
                                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                                    style="width: {{ $stars[1] }}%">
                                                                                    <span
                                                                                        class="sr-only">{{ $stars[1] }}%</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end 5 -->
                                                                        <div class="col-xs-3 col-md-3 text-right">
                                                                            4
                                                                        </div>
                                                                        <div class="col-xs-8 col-md-9">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-success"
                                                                                    role="progressbar" aria-valuenow="20"
                                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                                    style="width: {{ $stars[3] }}">
                                                                                    <span
                                                                                        class="sr-only">{{ $stars[3] }}%</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end 4 -->
                                                                        <div class="col-xs-3 col-md-3 text-right">
                                                                            3
                                                                        </div>
                                                                        <div class="col-xs-8 col-md-9">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-success"
                                                                                    role="progressbar" aria-valuenow="20"
                                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                                    style="width: {{ $stars[5] }}%">
                                                                                    <span
                                                                                        class="sr-only">{{ $stars[5] }}%</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end 3 -->
                                                                        <div class="col-xs-3 col-md-3 text-right">
                                                                            2
                                                                        </div>
                                                                        <div class="col-xs-8 col-md-9">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-success"
                                                                                    role="progressbar" aria-valuenow="20"
                                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                                    style="width: {{ $stars[7] }}%">
                                                                                    <span
                                                                                        class="sr-only">{{ $stars[7] }}%</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end 2 -->
                                                                        <div class="col-xs-3 col-md-3 text-right">
                                                                            1
                                                                        </div>
                                                                        <div class="col-xs-8 col-md-9">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-success"
                                                                                    role="progressbar" aria-valuenow="80"
                                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                                    style="width: {{ $stars[9] }}%">
                                                                                    <span
                                                                                        class="sr-only">{{ $stars[9] }}%</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end 1 -->
                                                                    </div>
                                                                    <!-- end row -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="aa-review-nav">

                                                @foreach ($service->ratings as $rating)
                                                    <li>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4 class="media-heading">
                                                                    <strong>{{ $rating->user->name }}</strong> -
                                                                    <span>{{ $rating->created_at }}</span>
                                                                </h4>
                                                                <div class="aa-product-rating">
                                                                <span class="fa @if ($rating->rating >= 1) fa-star @else
                                                                        fa-star-o @endif"></span>
                                                                <span class="fa @if ($rating->rating >= 1) fa-star @else
                                                                        fa-star-o @endif"></span>
                                                                <span class="fa @if ($rating->rating >= 1) fa-star @else
                                                                        fa-star-o @endif"></span>
                                                                <span class="fa @if ($rating->rating >= 1) fa-star @else
                                                                        fa-star-o @endif"></span>
                                                                <span class="fa @if ($rating->rating >= 1) fa-star @else
                                                                        fa-star-o @endif"></span>
                                                                </div>
                                                                <p>{{ $rating->comment }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>

                                        @else
                                            <h4>Be the First To Review The Photo</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- User profile -->
                        <div class="row">
                            <div class="col-md-9">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">About the Seller</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="profile__avatar">
                                            <a href="{{ route('sellers.show', $service->seller) }}">
                                                <img src="{{ asset($service->seller->sellerImage()) }}" alt="...">
                                            </a>

                                        </div>
                                        <div class="profile__header">
                                            <a href="{{ route('sellers.show', $service->seller) }}">
                                                <h4>{{ $service->seller->sellername }} </h4>
                                            </a>
                                            <p class="text-muted">
                                                {{ $service->seller->description }}
                                            </p>
                                            <p>
                                                <a href="{{ $service->seller->url }}">{{ $service->seller->url }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if ($service->seller->user()->isNot(auth()->user()))
                                    <button data-toggle="modal" data-target="#message"
                                        class="profile__contact-btn btn btn-lg btn-block btn-info">Contact
                                        Seller</button>
                                @endif
                            </div>
                        </div>
                        <!-- Related product -->
                        <div class="aa-product-related-item">
                            <h3>Related Products</h3>
                            <ul class="aa-product-catg aa-related-item-slider">
                                <!-- start single product item -->
                                @foreach ($services as $service)
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="{{ route('services.show', $service) }}"><img
                                                    src="{{ asset($service->serviceImage()) }}"></a>
                                            @if ($service->seller->user()->isNot(auth()->user()))
                                                <form action="{{ route('carts.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                    <input type="hidden" name="price" value="{{ $service->price }}">
                                                    <button class="aa-add-card-btn btn-block"><span
                                                            class="fa fa-shopping-cart"></span>Add To
                                                        Cart</button>
                                                </form>
                                            @endif
                                            <figcaption>
                                                <h4 class="aa-product-title"><a href="#">{{ $service->name }}</a>
                                                </h4>
                                                <span class="aa-product-price">Rp.
                                                    {{ number_format($service->price) }}</span>
                                                {{-- <span class="aa-product-price"><del>$65.50</del></span> --}}

                                                @php
                                                    $average = $service->ratings->average('rating');
                                                @endphp
                                                @if ($average != 0)
                                                    <div class="price" style="margin-top: 5px">
                                                        <span class="edd_price"><span class="icon">★</span><strong>
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
                                                    data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span
                                                        class="fa fa-heart-o"></span></a>
                                            @endif
                                            <a href="{{ route('services.download', $service) }}" data-toggle="tooltip"
                                                data-placement="top" title="Download"><span
                                                    class="fa fa-download"></span></a>
                                            <a href="{{ route('services.show', $service) }}"><span
                                                    class="fa fa-search"></span></a>
                                        </div>
                                        <!-- product badge -->
                                        <span class="aa-badge aa-sale" href="#">SALE!</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->

    <!-- Subscribe section -->
    <section id="aa-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-subscribe-area">
                        <h3>Subscribe our newsletter </h3>
                        <p>Support Our Website</p>
                        <form action="" class="aa-subscribe-form">
                            <input type="email" name="" id="" placeholder="Enter your Email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
