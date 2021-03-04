@extends('layouts.app')
@section('title', 'Seller Profile - Colance')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('services.index') }}" class="btn btn-outline-primary mb-3">Back</a>
                <h2>{{ $seller->sellername }}</h2>
                <h3>Address: {{ $seller->address }}</h3>
                <h3>Website: {{ $seller->url }}</h3>
            </div>
            <div class="col-sm-6 mt-auto">
                <a href="{{ route('services.create') }}" class="btn btn-outline-success mb-3">Add Service</a>
            </div>
        </div>
        <div class="row">
            <div class="container trending-wrapper mb-5">
                <div class="col-md-12 text-center">
                    @if ($services->count() == 0)
                        <h3 class="">You didn't sell any service yet</h3>
                    @else
                        <h3 class='mb-4'>Your Services</h3>
                        <div class="row row-cols-1 row-cols-md-6">
                            @foreach ($services as $item)
                                <div class="col mb-4 link-web">
                                    <a href="{{ route('services.show', $item->id) }}">
                                        <div class="card h-100 rounded" style="width: 12rem;">
                                            <img src="{{ asset("storage/product/{$item->image}") }}" class="card-img-top"
                                                style="width: 12rem; height: 12rem; background-size: cover; background-position: center;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $item->name }}</h6>
                                                <h5 class="card-text"> Rp. {{ number_format($item->price) }}</h5>

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
