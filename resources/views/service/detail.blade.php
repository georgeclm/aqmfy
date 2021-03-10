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
                <h4>Category: {{ $service->category->name }}</h4>
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
                <a href="{{ route('sellers.show', $service->seller) }}"><strong>
                        <h4>{{ $service->seller->sellername }}
                    </strong></h4>
                </a>
                <h4>From {{ $service->seller->address }}</h4>
                <h4>{{ $service->seller->url }}</h4>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @if (count($stars) != 0)
                    @foreach ($service->ratings as $rating)
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <span class="heading"><strong>{{ $service->ratings->count() }} Reviews</strong></span>
                        <span class="fa fa-star @if ($average>= 1) checked @endif"></span>
                        <span class="fa fa-star @if ($average>= 2) checked @endif"></span>
                        <span class="fa fa-star @if ($average>= 3) checked @endif"></span>
                        <span class="fa fa-star @if ($average>= 4) checked @endif"></span>
                        <span class="fa fa-star @if ($average>= 5) checked @endif"></span>
                        <span class="heading"><strong> {{ $average }}</strong></span>

                        <hr style="border:3px solid #f1f1f1">

                        <div class="row">
                            <div class="side">
                                <div class="h5">5 Stars</div>
                            </div>
                            <div class="middle">
                                <div class="progress mt-1">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $stars[1] }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div class="h5">{{ number_format($stars[0]) }}</div>
                            </div>
                            <div class="side">
                                <div class="h5">4 Stars</div>
                            </div>
                            <div class="middle">
                                <div class="progress mt-1">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $stars[3] }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div class="h5">{{ number_format($stars[2]) }}</div>
                            </div>
                            <div class="side">
                                <div class="h5">3 Stars</div>
                            </div>
                            <div class="middle">
                                <div class="progress mt-1">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $stars[5] }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div class="h5">{{ number_format($stars[4]) }}</div>
                            </div>
                            <div class="side">
                                <div class="h5">2 Stars</div>
                            </div>
                            <div class="middle">
                                <div class="progress mt-1">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $stars[7] }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div class="h5">{{ number_format($stars[6]) }}</div>
                            </div>
                            <div class="side">
                                <div class="h5">1 Star</div>
                            </div>
                            <div class="middle">
                                <div class="progress mt-1">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $stars[9] }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div class="h5">{{ number_format($stars[8]) }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="h5 link-web pt-1">
                            {{ $rating->user->name }} <strong>★ {{ $rating->rating }}</strong>
                        </div>
                        <div class="container h5">
                            {{ $rating->comment }}
                        </div>

                    @endforeach
                @endif

            </div>
        </div>
    @endsection
