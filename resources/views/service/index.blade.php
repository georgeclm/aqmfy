@extends('layouts.app')
@section('title', 'Colance')

@section('content')
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="3"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="4"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="5"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="6"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($services as $item)
                <div class="carousel-item {{ $item->id == 1 ? 'active' : '' }}" data-bs-interval="10000">
                    <a href="{{ route('services.show', $item->id) }}">
                        <div class="text-center">
                            <img src="{{ asset("storage/product/{$item->image}") }}" class="slider-img" alt="...">

                        </div>
                        <div class="carousel-caption d-none d-md-block slider-text">
                            <h5>{{ $item->name }}</h5>
                            <p>{{ Str::limit($item->description, 25) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <div class="container mb-5 mt-5">
        <div class="col-md-12 text-center">
            <h3 class='mb-4'>Trending Products</h3>
            <div class="row row-cols-1 row-cols-md-6">
                @if ($services->count())
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
                @else
                    <div class="h4">Product Not Found</div>
                @endif
            </div>

        </div>
    </div>
@endsection
