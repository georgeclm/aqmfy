@extends('layouts.app')
@section('title', 'Aqmfy - Best Photostock You Can Get')

@section('home')

    <!-- Start slider -->
    <section id="aa-slider" style="margin-bottom: 5px">
        <div class="aa-slider-area">
            <div id="sequence" class="seq">
                <div class="seq-screen">
                    <ul class="seq-canvas">
                        @foreach ($services->take(7) as $service)
                            <li>
                                <div class="seq-model">
                                    <img data-seq src="{{ asset($service->serviceImage()) }}">
                                </div>
                                <div class="seq-title">
                                    <h2 data-seq style="color: white">{{ $service->name }}</h2>
                                    <p data-seq style="color: white">
                                        {{ Str::of($service->description)->title()->words(20) }}</p>
                                    <a data-seq href="{{ route('services.show', $service) }}"
                                        class="aa-shop-now-btn aa-secondary-btn">CHECK IT OUT</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- slider navigation btn -->
                <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                    <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                    <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
                </fieldset>
            </div>
        </div>
    </section>
    <!-- / slider -->
    <!-- Products section -->
    <section id="aa-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-product-area">
                            <div class="aa-product-inner">
                                <!-- start prduct navigation -->
                                <ul class="nav nav-tabs aa-products-tab">
                                    <li><a href="#nature" data-toggle="tab">Nature</a></li>
                                    <li><a href="#sport" data-toggle="tab">Sport</a></li>
                                    <li><a href="#fashion" data-toggle="tab">Fashion</a></li>
                                    <li><a href="#social" data-toggle="tab">Social</a></li>
                                    <li><a href="#abstrac" data-toggle="tab">Abstrac</a></li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Start men product category -->
                                    @foreach ($categories as $category)
                                        <div class="tab-pane fade in active" id="{{ strtolower($category->name) }}">
                                            <ul class="aa-product-catg">
                                                <!-- start single product item -->
                                                @foreach ($category->services as $service)
                                                    <li style="margin-bottom:0px !important">
                                                        <figure>
                                                            <a class="aa-product-img"
                                                                href="{{ route('services.show', $service) }}"><img
                                                                    src="{{ asset($service->serviceImage()) }}"></a>
                                                            @if ($service->seller->user()->isNot(auth()->user()))
                                                                <form action="{{ route('carts.store') }}" method="POST">
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
                                                                {{-- <span class="aa-product-price"><del>$65.50</del></span> --}}

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
                                                                title="Download"><span class="fa fa-download"></span></a>
                                                            <a href="{{ route('services.show', $service) }}"><span
                                                                    class="fa fa-search"></span></a>
                                                        </div>
                                                        <!-- product badge -->
                                                        <span class="aa-badge aa-sale" href="#">SALE!</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    <a class="aa-browse-btn" href="{{ route('services.all') }}">Browse all Product <span
                                            class="fa fa-long-arrow-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- popular section -->
    <section id="aa-popular-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-popular-category-area">
                            <!-- start prduct navigation -->
                            <ul class="nav nav-tabs aa-products-tab">
                                <li class="active"><a href="#popular" data-toggle="tab">Popular</a></li>
                                <li><a href="#featured" data-toggle="tab">Featured</a></li>
                                <li><a href="#latest" data-toggle="tab">Latest</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Start men popular category -->
                                <div class="tab-pane fade in active" id="popular">
                                    <ul class="aa-product-catg aa-popular-slider">
                                        <!-- start single product item -->
                                        @foreach ($services as $service)
                                            <li>
                                                <figure>
                                                    <a class="aa-product-img"
                                                        href="{{ route('services.show', $service) }}"><img
                                                            src="{{ asset($service->serviceImage()) }}"></a>
                                                    @if ($service->seller->user()->isNot(auth()->user()))
                                                        <form action="{{ route('carts.store') }}" method="POST">
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
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                    @endif
                                                    <a href="{{ route('services.download', $service) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Download"><span
                                                            class="fa fa-download"></span></a>
                                                    <a href="{{ route('services.show', $service) }}"><span
                                                            class="fa fa-search"></span></a>
                                                </div>
                                                <!-- product badge -->
                                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a class="aa-browse-btn" href="{{ route('services.all') }}">Browse all Product <span
                                            class="fa fa-long-arrow-right"></span></a>
                                </div>
                                <!-- / popular product category -->

                                <!-- start featured product category -->
                                <div class="tab-pane fade" id="featured">
                                    <ul class="aa-product-catg aa-featured-slider">
                                        @foreach ($services as $service)
                                            <li>
                                                <figure>
                                                    <a class="aa-product-img"
                                                        href="{{ route('services.show', $service) }}"><img
                                                            src="{{ asset($service->serviceImage()) }}"></a>
                                                    @if ($service->seller->user()->isNot(auth()->user()))
                                                        <form action="{{ route('carts.store') }}" method="POST">
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
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                    @endif
                                                    <a href="{{ route('services.download', $service) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Download"><span
                                                            class="fa fa-download"></span></a>
                                                    <a href="{{ route('services.show', $service) }}"><span
                                                            class="fa fa-search"></span></a>
                                                </div>
                                                <!-- product badge -->
                                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a class="aa-browse-btn" href="{{ route('services.all') }}l">Browse all Product <span
                                            class="fa fa-long-arrow-right"></span></a>
                                </div>
                                <!-- / featured product category -->

                                <!-- start latest product category -->
                                <div class="tab-pane fade" id="latest">
                                    <ul class="aa-product-catg aa-latest-slider">
                                        @foreach ($services as $service)
                                            <li>
                                                <figure>
                                                    <a class="aa-product-img"
                                                        href="{{ route('services.show', $service) }}"><img
                                                            src="{{ asset($service->serviceImage()) }}"></a>
                                                    @if ($service->seller->user()->isNot(auth()->user()))
                                                        <form action="{{ route('carts.store') }}" method="POST">
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
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                    @endif
                                                    <a href="{{ route('services.download', $service) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Download"><span
                                                            class="fa fa-download"></span></a>
                                                    <a href="{{ route('services.show', $service) }}"><span
                                                            class="fa fa-search"></span></a>
                                                </div>
                                                <!-- product badge -->
                                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a class="aa-browse-btn" href="{{ route('services.all') }}">Browse all Product <span
                                            class="fa fa-long-arrow-right"></span></a>
                                </div>
                                <!-- / latest product category -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / popular section -->
    <!-- Support section -->
    <section id="aa-support">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-support-area">
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-truck"></span>
                                <h4>FREE SHIPPING</h4>
                            </div>
                        </div>
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-clock-o"></span>
                                <h4>30 DAYS MONEY BACK</h4>
                            </div>
                        </div>
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-phone"></span>
                                <h4>SUPPORT 24/7</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Support section -->
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
    <!-- / Subscribe section -->





@endsection
