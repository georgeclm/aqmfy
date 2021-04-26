@extends('layouts.app')
@section('title', "{$service->name} by {$service->seller->sellername}")
@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="http://bappeda.bengkuluselatankab.go.id/wp-content/uploads/2019/09/cropped-background-keren-8.jpg"
            alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>T-Shirt</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('services.index') }}">Home</a></li>
                        <li><a href="#">Product</a></li>
                        <li class="active" style="color:rgb(189, 158, 158)">T-shirt</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-details">
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
                                    <button data-bs-toggle="modal" data-bs-target="#message"
                                        class="profile__contact-btn btn btn-lg btn-block btn-info">Contact
                                        Seller</button>
                                @endif
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
                                            <h4>{{ $service->ratings->count() }} Reviews for T-Shirt</h4>
                                            <ul class="aa-review-nav">
                                                @foreach ($service->ratings as $rating)
                                                    <li>

                                                        <div class="media">
                                                            <div class="media-left">
                                                                <a href="#">
                                                                    <img class="media-object"
                                                                        src="img/testimonial-img-3.jpg" alt="girl image">
                                                                </a>
                                                            </div>
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
                                            {{-- <h4>Add a review</h4>
                                            <div class="aa-your-rating">
                                                <p>Your Rating</p>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                            </div>
                                            <!-- review form -->
                                            <form action="" class="aa-review-form">
                                                <div class="form-group">
                                                    <label for="message">Your Review</label>
                                                    <textarea class="form-control" rows="3" id="message"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        placeholder="example@gmail.com">
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-default aa-review-submit">Submit</button>
                                            </form> --}}
                                        @else
                                            <h4>Be the First To Review The Photo</h4>
                                        @endif
                                    </div>
                                </div>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
                        <form action="" class="aa-subscribe-form">
                            <input type="email" name="" id="" placeholder="Enter your Email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Subscribe section -->

    {{-- <div class="container" width="65%">
        <div class="row">
            <div class="col-sm-6 m-auto text-center">
                <img class="detail-img" src="{{ asset($service->serviceImage()) }}" alt="">
            </div>
            <div class="col-sm-6">
                <h2>{{ $service->name }}</h2>
                <h3>Price: Rp. {{ number_format($service->price) }}</h3>
                <h4>Category: {{ $service->category->name }}</h4>
                <h4>Delivery Time: {{ $service->delivery_time }} day</h4>
                <br><br>
                @if ($service->seller->user()->isNot(auth()->user()))
                    @auth
                        <wishlist-button route="{{ route('wishlists.add', $service->id) }}" favorite="{{ $favorite }}">
                        </wishlist-button>
                    @endauth

                    @error('service_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <a href="{{ route('orders.show', $service) }}" class="btn btn-success">Continue
                        (Rp. {{ number_format($service->price) }})</a>
                    <a href="{{ route('services.download', $service) }}" class="btn btn-outline-success">Download Image
                    </a>

                    <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send a Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('messages.store') }}" id="ratingform" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <img src="{{ asset($service->seller->sellerImage()) }}"
                                                    class="rounded-circle mb-1" width="75px" height="75px">
                                                <h6>{{ $service->seller->sellername }}</h6>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <textarea name="message" placeholder="Your Message" class="form-control"
                                                        rows="7" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="subject" value="{{ $service->name }}">
                                        <input type="hidden" name="recipients[]"
                                            value="{{ $service->seller->user->id }}">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" form="ratingform" class="btn btn-primary" value="Send Message" />
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-outline-primary mb-4">Edit Your
                        Photo</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Remove Photo</button>
                    </form>


                @endif
            </div>


        </div><br>
        <div class="row">
            <div class="col-sm-6 ">
                <h2 class="text-center">About This Photo</h2> <br>
            </div>
            <div class="col-sm-6 ">
                <h2 class="text-center">About The Seller</h2> <br>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h4>{{ $service->description }}</h4>

            </div>
            <div class="col-sm-2">
                <img src="{{ asset($service->seller->sellerImage()) }}" class="rounded-circle" width="200px"
                    height="200px">
            </div>
            <div class="link-web col-sm-4 mt-5">
                <a href="{{ route('sellers.show', $service->seller) }}"><strong>
                        <h4>{{ $service->seller->sellername }}
                    </strong></h4>
                </a>
                <h4>From {{ $service->seller->address }}</h4>
                <h4>{{ $service->seller->url }}</h4>
                <div class="h4">
                    <strong>{{ $service->seller->followers->count() }}</strong>
                    followers
                </div>
                @if ($service->seller->user()->isNot(auth()->user()))

                    <button data-bs-toggle="modal" data-bs-target="#message" class="btn btn-outline-secondary">Contact
                        Seller</button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @if (count($stars) != 0)
                    <span class="heading"><strong>{{ $service->ratings->count() }} Reviews</strong></span>
                    <span class="fa fa-star @if ($average >= 1) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 2) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 3) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 4) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 5) checked @endif"></span>
                    <span class="heading"><strong> {{ number_format($average, 1) }}</strong></span>

                    <hr style="border:3px solid #f1f1f1">

                    <div class="row">
                        <div class="side">
                            <div class="h5">5 Stars</div>
                        </div>
                        <div class="middle">
                            <div class="progress mt-1">
                                <div class="progress-bar" role="progressbar" style="width: {{ $stars[1] }}%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div class="h5">{{ number_format($stars[0]) }}</div>
                        </div>
                        <div class="side">
                            <div class="h5">4 Stars</div>
                        </div>
                        <div class="middle">
                            <div class="progress mt-1">
                                <div class="progress-bar" role="progressbar" style="width: {{ $stars[3] }}%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div class="h5">{{ number_format($stars[2]) }}</div>
                        </div>
                        <div class="side">
                            <div class="h5">3 Stars</div>
                        </div>
                        <div class="middle">
                            <div class="progress mt-1">
                                <div class="progress-bar" role="progressbar" style="width: {{ $stars[5] }}%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div class="h5">{{ number_format($stars[4]) }}</div>
                        </div>
                        <div class="side">
                            <div class="h5">2 Stars</div>
                        </div>
                        <div class="middle">
                            <div class="progress mt-1">
                                <div class="progress-bar" role="progressbar" style="width: {{ $stars[7] }}%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div class="h5">{{ number_format($stars[6]) }}</div>
                        </div>
                        <div class="side">
                            <div class="h5">1 Star</div>
                        </div>
                        <div class="middle">
                            <div class="progress mt-1">
                                <div class="progress-bar" role="progressbar" style="width: {{ $stars[9] }}%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div class="h5">{{ number_format($stars[8]) }}</div>
                        </div>
                    </div>
                    <hr>
                    @foreach ($service->ratings as $rating)

                        <div class="h5 link-web pt-1">
                            {{ $rating->user->name }} <strong>★ {{ $rating->rating }}</strong>
                        </div>
                        <div class="container h5">
                            {{ $rating->comment }}
                        </div>
                        <hr>
                    @endforeach
                @endif

            </div>
        </div> --}}
@endsection
