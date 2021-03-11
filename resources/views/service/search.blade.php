@extends('layouts.app')
@section('title', 'Search - Colance')

@section('content')
    <div class="container">
        <div class="col-sm-4">
            <a href="#" class="btn btn-outline-secondary">Filter</a>
        </div>
        <div class="col-md-12">
            <div class="trending-wrapper m-auto">
                <div class="h2 my-4">Result for Services</div>
                <div class="row row-cols-1 row-cols-md-6">
                    @if ($services->count())
                        @foreach ($services as $service)
                            <div class="col mb-4 link-web">
                                <a href="{{ route('services.show', $service) }}">
                                    <div class="card h-100 rounded" style="width: 12rem;">
                                        <img src="{{ asset("storage/product/{$service->image}") }}" class="card-img-top"
                                            style="width: 12rem; height: 12rem; background-size: cover; background-position: center;">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $service->name }}</h6>
                                            <h5 class="card-text">Rp. {{ number_format($service->price) }}</h5>
                                            <input type="hidden"
                                                value="{{ $average = $service->ratings->average('rating') }}">
                                            @if ($average != 0)
                                                <div class="ratingindex">
                                                    <span class="icon">★</span>
                                                </div>
                                                <span class=""><strong> {{ $average }}</strong><span
                                                        class="text-muted">({{ $service->ratings->count() }})</span></span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else

                </div>
                <div class="h4 text-center">No Service Found</div>
                @endif

            </div>
        </div>
    </div>
@endsection
