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
                    <a href="{{ route('services.create') }}" class="btn btn-outline-success mb-3">Add
                        Service</a>
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
                @if ($services->count())
                    <h3 class='mb-4 text-center'>
                    @if (auth()->id() == $seller->user_id)Your Services @else
                            {{ $seller->sellername }} Services @endif
                    </h3>
                    <x-services :services="$services" />
                @else
                    <h3>
                        @if (auth()->id() == $seller->user_id)You didn't Sell any
                            Service
                        Yet @else
                            {{ $seller->sellername }} Didn't Have any Services Yet @endif
                    </h3>
                @endif
            </div>
        </div>
    </div>
@endsection
