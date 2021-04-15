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
                                    <a href="{{ route('orders.show', $service) }}" class="learn-more detailslearn"><i
                                            class="fa fa-shopping-cart"></i>
                                        Purchase</a>
                                @endif
                                <a href="{{ route('services.show', $service) }}" class="learn-more detailslearn"><i
                                        class="fa fa-link"></i>
                                    Details</a>
                            </p>
                        </div>
                        <span class="maxproduct"><img src="{{ asset($service->serviceImage()) }}" alt=""></span>
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
