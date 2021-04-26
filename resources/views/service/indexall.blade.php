@extends('layouts.app')
@if ($word)
    @section("title', 'Search Results for {$word} - Aqmfy")
    @elseif ($category_word)
    @section('title', "{$category_word} - Aqmfy")
    @else
    @section('title', 'All Photos - Aqmfy')

    @endif
    @section('home')
        <!-- catg header banner section -->
        <section id="aa-catg-head-banner">
            <img src="http://bappeda.bengkuluselatankab.go.id/wp-content/uploads/2019/09/cropped-background-keren-8.jpg"
                alt="fashion img">
            <div class="aa-catg-head-banner-area">
                <div class="container">
                    <div class="aa-catg-head-banner-content">
                        <h2>All Photos</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('services.index') }}">Home</a></li>
                            <li class="active" style="color:rgb(189, 158, 158)">Photos</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- / catg header banner section -->

        <!-- product category -->
        <section id="aa-product-category">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                        <div class="aa-product-catg-content">
                            <div class="aa-product-catg-head">
                                <div class="aa-product-catg-head-left">
                                    <form action="{{ route('services.all') }}" method="GET" class="aa-sort-form">
                                        <label for="">Sort by</label>
                                        <select name="sort_by" onchange="this.form.submit()">
                                            <option value="1" selected="Default">Default</option>
                                            <option value="2">Name</option>
                                            <option value="3">Price</option>
                                            <option value="4">Date</option>
                                        </select>
                                    </form>
                                    <form action="" class="aa-show-form">
                                        <label for="">Show</label>
                                        <select name="" disabled>
                                            <option value="1" selected="12">12</option>
                                            <option value="2">24</option>
                                            <option value="3">36</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="aa-product-catg-head-right">
                                    <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                                    <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                                </div>
                            </div><br>
                            @if ($word)
                                <br>
                                <h3>Result for "{{ $word }}"</h3>
                            @endif
                            @if ($category_word)
                                <br>
                                <h3>{{ $category_word }}</h3>
                            @endif
                            <div class="aa-product-catg-body">
                                <ul class="aa-product-catg">
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

                                    <!-- start single product item -->

                                </ul>

                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $services->links() }}
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                        <aside class="aa-sidebar">
                            <!-- single sidebar -->
                            <div class="aa-sidebar-widget">
                                <h3>Category</h3>
                                <ul class="aa-catg-nav">
                                    @foreach ($categories as $category)
                                        <form id="{{ $category->id }}" action="{{ route('services.all') }}" action="GET">
                                            <input type="hidden" name="category" value="{{ $category->id }}">
                                            <li><a href="javascript:{}"
                                                    onclick="document.getElementById('{{ $category->id }}').submit();">{{ $category->name }}</a>
                                            </li>
                                        </form>
                                    @endforeach

                            </div>
                            {{-- <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Tags</h3>
                            <div class="tag-cloud">
                                <a href="#">Fashion</a>
                                <a href="#">Ecommerce</a>
                                <a href="#">Shop</a>
                                <a href="#">Hand Bag</a>
                                <a href="#">Laptop</a>
                                <a href="#">Head Phone</a>
                                <a href="#">Pen Drive</a>
                            </div>
                        </div> --}}
                            <!-- single sidebar -->
                            <div class="aa-sidebar-widget">
                                <h3>Shop By Price</h3>
                                <!-- price range -->
                                <div class="aa-sidebar-price-range">
                                    <form action="">
                                        <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                                        </div>
                                        <span id="skip-value-lower" class="example-val">Free</span>
                                        <span id="skip-value-upper" class="example-val">100.00</span>
                                        <button class="aa-filter-btn" type="submit">Filter</button>
                                    </form>
                                </div>

                            </div>

                            {{-- <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Recently Views</h3>
                            <div class="aa-recently-views">
                                <ul>
                                    <li>
                                        <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Top Rated Products</h3>
                            <div class="aa-recently-views">
                                <ul>
                                    <li>
                                        <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        </aside>
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

    @endsection
