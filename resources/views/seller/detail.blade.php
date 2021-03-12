@extends('layouts.app')
@section('title', "{$seller->sellername} - Colance")

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ asset($seller->sellerImage()) }}" class="rounded-circle" width="200px" height="200px">

            </div>
            <div class="col-sm-4">
                <a href="{{ route('services.index') }}" class="btn btn-outline-primary mb-3">Back</a>
                <h2><strong>{{ $seller->sellername }}</strong></h2>
                <h3>From {{ $seller->address }}</h3>
                <h3>Website: {{ $seller->url }}</h3>
                <div class="h4">
                    <strong>{{ $seller->followers->count() }}</strong>
                    followers
                </div>
            </div>
            <div class="col-sm-4">
                <div class="h4"><strong> Description</strong></div>
                <div class="h5">{{ $seller->description }}</div>
            </div>

            @if ($seller->user_id == auth()->id())
                <div class="col-sm-2 align-self-end">
                    <a href="{{ route('services.create') }}" class="btn btn-outline-success mb-3">Add Service</a>
                    <a href="{{ route('sellers.edit', $seller) }}" class="btn btn-outline-secondary mb-3">Update
                        Seller
                        Profile</a>
                </div>
            @else
                <follow-button user-id={{ $seller->id }} follows="{{ $follows }}"></follow-button>
            @endif

        </div>
        <div class="row">
            <div class="container trending-wrapper mb-5">
                <div class="col-md-12 text-center">
                    @if ($services->count() == 0)
                        <h3 class="">
                            @if (auth()->id() == $seller->user_id)You didn't Sell any
                                Service
                            Yet @else
                                {{ $seller->sellername }} Didn't Have any Services Yet @endif
                        </h3>
                    @else
                        <h3 class='mb-4'>
                        @if (auth()->id() == $seller->user_id)Your Services @else
                                {{ $seller->sellername }} Services @endif
                        </h3>

                        <div class="row row-cols-1 row-cols-md-6">
                            @foreach ($services as $service)
                                <div class="col mb-4 link-web">
                                    <a href="{{ route('services.show', $service) }}">
                                        <div class="card h-100 rounded" style="width: 12rem;">
                                            <img src="{{ asset("storage/product/{$service->image}") }}"
                                                class="card-img-top"
                                                style="width: 12rem; height: 12rem; background-size: cover; background-position: center;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $service->name }}</h6>
                                                <h5 class="card-text"> Rp. {{ number_format($service->price) }}</h5>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
