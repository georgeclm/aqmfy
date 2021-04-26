<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            <!-- start prduct navigation -->
                            <!-- Tab panes -->
                            <ul class="nav nav-tabs aa-products-tab">
                                <li><a href="#nature" data-toggle="tab">Nature</a></li>
                                <li><a href="#sport" data-toggle="tab">Sport</a></li>
                                <li><a href="#fashion" data-toggle="tab">Fashion</a></li>
                                <li><a href="#social" data-toggle="tab">Social</a></li>
                                <li><a href="#abstrac" data-toggle="tab">Abstrac</a></li>

                            </ul>
                            @if ($services->count())
                                <div class="col-md-12 text-muted mb-3">Found {{ $services->count() }} results</div>
                                <div class="tab-content">
                                    <!-- Start men product category -->
                                    <div class="tab-pane fade in active">
                                        <ul class="aa-product-catg">
                                            <!-- start single product item -->
                                            @foreach ($services as $service)
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
                                    <a class="aa-browse-btn" href="{{ route('services.all') }}">Browse all Product
                                        <span class="fa fa-long-arrow-right"></span></a>
                                </div>
                            @else
                                <div class="h4">Photos Not Found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
