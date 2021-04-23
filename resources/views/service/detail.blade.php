@extends('layouts.app')
@section('title', "{$service->name} by {$service->seller->sellername}")
@section('content')
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <br><br>
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="{{ asset($service->serviceImage()) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <br><br>
                        <h3 class="product-title">{{ $service->name }}</h3>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star @if ($average>= 1) checked @endif"></span>
                                <span class="fa fa-star @if ($average>= 2) checked @endif"></span>
                                <span class="fa fa-star @if ($average>= 3) checked @endif"></span>
                                <span class="fa fa-star @if ($average>= 4) checked @endif"></span>
                                <span class="fa fa-star @if ($average>= 5) checked @endif"></span>
                            </div>
                            <span class="review-no" style="font-size: 14px">{{ number_format($average, 1) }}
                                reviews</span>
                        </div>
                        <div class="product-description">{{ $service->description }}</div>
                        <h4 class="price">current price: <span>Rp. {{ number_format($service->price) }}</span></h4>
                        <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                        {{-- <h5 class="sizes">sizes:
                            <span class="size" data-toggle="tooltip" title="small">s</span>
                            <span class="size" data-toggle="tooltip" title="medium">m</span>
                            <span class="size" data-toggle="tooltip" title="large">l</span>
                            <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                        </h5>
                        <h5 class="colors">colors:
                            <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                            <span class="color green"></span>
                            <span class="color blue"></span>
                        </h5> --}}
                        @if ($service->seller->user()->isNot(auth()->user()))
                            <form action="{{ route('carts.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                <input type="hidden" name="price" value="{{ $service->price }}">
                                <div class="action">
                                    <button class="add-to-cart btn btn-secondary" type="submit">add
                                        to cart</button>

                                    <a href="{{ route('wishlists.wish', $service->id) }}"
                                        class="like btn btn-secondary"><span class="fa fa-heart"></span></a>

                                </div>
                            </form>
                        @else
                            <div class="action">
                                <a href="{{ route('services.edit', $service) }}" class="add-to-cart btn btn-secondary"
                                    type="submit">Edit Your Photo</a>
                                <form action="{{ route('services.destroy', $service) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="add-to-cart btn btn-secondary">Remove Photo</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container" width="65%">
        <div class="row">
            <div class="col-sm-6 m-auto text-center">
                <img class="detail-img" src="{{ asset($service->serviceImage()) }}" alt="">
            </div>
            <div class="col-sm-6">
                <h2>{{ $service->name }}</h2>
                <h3>Price: Rp. {{ number_format($service->price) }}</h3>
                <h4>Category: {{ $service->category->name }}</h4>
                <h4>Delivery Time: {{ $service->delivery_time }} day</h4>
                <br><br>
                @if ($service->seller->user()->isNot(auth()->user()))
                    @auth
                        <wishlist-button route="{{ route('wishlists.add', $service->id) }}" favorite="{{ $favorite }}">
                        </wishlist-button>
                    @endauth

                    @error('service_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <a href="{{ route('orders.show', $service) }}" class="btn btn-success">Continue
                        (Rp. {{ number_format($service->price) }})</a>
                    <a href="{{ route('services.download', $service) }}" class="btn btn-outline-success">Download Image
                    </a>

                    <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send a Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('messages.store') }}" id="ratingform" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <img src="{{ asset($service->seller->sellerImage()) }}"
                                                    class="rounded-circle mb-1" width="75px" height="75px">
                                                <h6>{{ $service->seller->sellername }}</h6>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <textarea name="message" placeholder="Your Message" class="form-control"
                                                        rows="7" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="subject" value="{{ $service->name }}">
                                        <input type="hidden" name="recipients[]"
                                            value="{{ $service->seller->user->id }}">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" form="ratingform" class="btn btn-primary" value="Send Message" />
                                </div>
                            </div>
                        </div>
                    </div>

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
                <div class="h4">
                    <strong>{{ $service->seller->followers->count() }}</strong>
                    followers
                </div>
                @if ($service->seller->user()->isNot(auth()->user()))

                    <button data-bs-toggle="modal" data-bs-target="#message" class="btn btn-outline-secondary">Contact
                        Seller</button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @if (count($stars) != 0)
                    <span class="heading"><strong>{{ $service->ratings->count() }} Reviews</strong></span>
                    <span class="fa fa-star @if ($average >= 1) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 2) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 3) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 4) checked @endif"></span>
                    <span class="fa fa-star @if ($average >= 5) checked @endif"></span>
                    <span class="heading"><strong> {{ number_format($average, 1) }}</strong></span>

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
                    @foreach ($service->ratings as $rating)

                        <div class="h5 link-web pt-1">
                            {{ $rating->user->name }} <strong>★ {{ $rating->rating }}</strong>
                        </div>
                        <div class="container h5">
                            {{ $rating->comment }}
                        </div>
                        <hr>
                    @endforeach
                @endif

            </div>
        </div> --}}
@endsection
