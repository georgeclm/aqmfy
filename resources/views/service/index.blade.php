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
                                <div class="seq-title text-light">
                                    <h2 data-seq style="color: white">{{ $service->name }}</h2>
                                    <p data-seq>{{ Str::of($service->description)->title()->words(20) }}</p>
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

    <div class="container mb-5 mt-5">
        <h3 class='mb-4'>Trending Photos</h3>
        <div class="col-md-12">
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
                                                    class="learn-more detailslearn"><i class="fa fa-shopping-cart"></i>
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

        </div>
    </div>
@endsection
