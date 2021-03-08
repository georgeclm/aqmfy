@extends('layouts.app')
@section('title', "{$service->name} by {$service->seller->sellername}")
@section('content')
    <br>
    <div class="container" width="65%">
        <div class="row">
            <div class="col-sm-6 m-auto text-center">
                <img class="detail-img" src="{{ asset("storage/product/{$service->image}") }}" alt="">
            </div>
            <div class="col-sm-6">
                <h2>{{ $service->name }}</h2>
                <h3>Price: Rp. {{ number_format($service->price) }}</h3>
                <h4>Category: {{ $service->category }}</h4>
                <h4>Delivery Time: {{ $service->delivery_time }} day</h4>
                <h4>Revisions: {{ $service->revision_time }}</h4>
                <br><br>
                @if (auth()->id() != $service->seller->id)
                    @guest
                    @else
                        <wishlist-button service-id="{{ $service->id }}" favorite="{{ $favorite }}"></wishlist-button>
                    @endguest

                    @error('service_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <a href="{{ route('orders.show', $service) }}" class="btn btn-success">Continue
                        (Rp. {{ number_format($service->price) }})</a>
                @else
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-outline-primary mb-4">Edit Your
                        Gig</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Remove Gig</button>
                    </form>


                @endif
            </div>


        </div><br>
        <div class="row">
            <div class="col-sm-6 ">
                <h2 class="text-center">About This Gig</h2> <br>
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
                <a href="{{ route('sellers.show', $seller) }}"><strong>
                        <h4>{{ $seller->sellername }}
                    </strong></h4>
                </a>
                <h4>From {{ $seller->address }}</h4>
                <h4>{{ $seller->url }}</h4>

            </div>
        </div>
    </div>
@endsection
