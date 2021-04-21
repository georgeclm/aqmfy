@extends('layouts.app')
@section('title', 'Aqmfy - Best Photostock You Can Get')

@section('home')

    <!-- Start slider -->
    <section id="aa-slider">
        <div class="aa-slider-area">
            <div id="sequence" class="seq">
                <div class="seq-screen">
                    <ul class="seq-canvas">
                        @foreach ($services as $service)
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
                                    <li class="active"><a href="#Nature" data-toggle="tab">Nature</a></li>
                                    <li><a href="#Sport" data-toggle="tab">Sport</a></li>
                                    <li><a href="#Fashion" data-toggle="tab">Fashion</a></li>
                                    <li><a href="#Social" data-toggle="tab">Social</a></li>
                                    <li><a href="#Abstract" data-toggle="tab">Abstract</a></li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Start men product category -->
                                    @foreach ($categories as $category)
                                        <div class="tab-pane fade in active" id="{{ $category->name }}">
                                            <ul class="aa-product-catg">
                                                <!-- start single product item -->

                                                @foreach ($category->services as $service)
                                                    <li>
                                                        <figure>
                                                            <a class="aa-product-img"
                                                                href="{{ route('services.show', $service) }}"><img
                                                                    src="{{ asset($service->serviceImage()) }}"></a>
                                                            <a class="aa-add-card-btn" href="#"><span
                                                                    class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                            <figcaption>
                                                                <h4 class="aa-product-title"><a
                                                                        href="#">{{ $service->name }}</a>
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
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add to Wishlist"><span
                                                                    class="fa fa-heart-o"></span></a>
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Download"><span class="fa fa-download"></span></a>
                                                            <a href="#" data-toggle2="tooltip" data-placement="top"
                                                                title="Quick View" data-toggle="modal"
                                                                data-target="#quick-view-modal"><span
                                                                    class="fa fa-search"></span></a>
                                                        </div>
                                                        <!-- product badge -->
                                                        <span class="aa-badge aa-sale" href="#">SALE!</span>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    @endforeach
                                    <a class="aa-browse-btn" href="product.html">Browse all Product <span
                                            class="fa fa-long-arrow-right"></span></a>
                                </div>


                                <!-- quick view modal -->
                                <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                                <div class="row">
                                                    <!-- Modal view slider -->
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="aa-product-view-slider">
                                                            <div class="simpleLens-gallery-container" id="demo-1">
                                                                <div class="simpleLens-container">
                                                                    <div class="simpleLens-big-image-container">
                                                                        <a class="simpleLens-lens-image"
                                                                            data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                                                            <img src="img/view-slider/medium/polo-shirt-1.png"
                                                                                class="simpleLens-big-image">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="simpleLens-thumbnails-container">
                                                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                        data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                                                        data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                                                        <img
                                                                            src="img/view-slider/thumbnail/polo-shirt-1.png">
                                                                    </a>
                                                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                        data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                                                        data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                                                        <img
                                                                            src="img/view-slider/thumbnail/polo-shirt-3.png">
                                                                    </a>

                                                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                        data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                                                        data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                                                        <img
                                                                            src="img/view-slider/thumbnail/polo-shirt-4.png">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal view content -->
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="aa-product-view-content">
                                                            <h3>Labek</h3>
                                                            <div class="aa-price-block">
                                                                <span class="aa-product-view-price">$34.99</span>
                                                                <p class="aa-product-avilability">Avilability: <span>In
                                                                        stock</span></p>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                Officiis animi, veritatis quae repudiandae quod nulla porro
                                                                quidem, itaque quis quaerat!</p>
                                                            <h4>Size</h4>
                                                            <div class="aa-prod-view-size">
                                                                <a href="#"></a>
                                                                <a href="#"></a>
                                                                <a href="#"></a>
                                                                <a href="#"></a>
                                                            </div>
                                                            <div class="aa-prod-quantity">
                                                                <form action="">
                                                                    <select name="" id="">
                                                                        <option value="0" selected="1">1</option>
                                                                        <option value="1">2</option>
                                                                        <option value="2">3</option>
                                                                        <option value="3">4</option>
                                                                        <option value="4">5</option>
                                                                        <option value="5">6</option>
                                                                    </select>
                                                                </form>
                                                                <p class="aa-prod-category">
                                                                    Category: <a href="#">Label</a>
                                                                </p>
                                                            </div>
                                                            <div class="aa-prod-view-bottom">
                                                                <a href="#" class="aa-add-to-cart-btn"><span
                                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                                <a href="#" class="aa-add-to-cart-btn">View Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- / quick view modal -->
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
                                                    <a class="aa-add-card-btn" href="#"><span
                                                            class="fa fa-shopping-cart"></span>Add To Cart</a>
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
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Download"><span class="fa fa-download"></span></a>
                                                    <a href="#" data-toggle2="tooltip" data-placement="top"
                                                        title="Quick View" data-toggle="modal"
                                                        data-target="#quick-view-modal"><span
                                                            class="fa fa-search"></span></a>
                                                </div>
                                                <!-- product badge -->
                                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a class="aa-browse-btn" href="product.html">Browse all Product <span
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
                                                    <a class="aa-add-card-btn" href="#"><span
                                                            class="fa fa-shopping-cart"></span>Add To Cart</a>
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
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Download"><span class="fa fa-download"></span></a>
                                                    <a href="#" data-toggle2="tooltip" data-placement="top"
                                                        title="Quick View" data-toggle="modal"
                                                        data-target="#quick-view-modal"><span
                                                            class="fa fa-search"></span></a>
                                                </div>
                                                <!-- product badge -->
                                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a class="aa-browse-btn" href="product.html">Browse all Product <span
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
                                                    <a class="aa-add-card-btn" href="#"><span
                                                            class="fa fa-shopping-cart"></span>Add To Cart</a>
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
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Download"><span class="fa fa-download"></span></a>
                                                    <a href="#" data-toggle2="tooltip" data-placement="top"
                                                        title="Quick View" data-toggle="modal"
                                                        data-target="#quick-view-modal"><span
                                                            class="fa fa-search"></span></a>
                                                </div>
                                                <!-- product badge -->
                                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a class="aa-browse-btn" href="product.html">Browse all Product <span
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
                                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                            </div>
                        </div>
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-clock-o"></span>
                                <h4>30 DAYS MONEY BACK</h4>
                                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                            </div>
                        </div>
                        <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-phone"></span>
                                <h4>SUPPORT 24/7</h4>
                                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Support section -->






@endsection
