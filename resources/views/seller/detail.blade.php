@extends('layouts.app')
@section('title', "{$seller->sellername} - Aqmfy")

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-9">
                <br><br><br><br>

                <!-- User profile -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">User profile</h4>
                    </div>
                    <div class="panel-body">
                        <div class="profile__avatar">
                            <img src="{{ asset($seller->sellerImage()) }}" alt="...">
                        </div>
                        <div class="profile__header">
                            <h4>{{ $seller->sellername }} </h4>
                            <p class="text-muted">
                                {{ $seller->description }}
                            </p>
                            <p>
                                <a href="{{ $seller->url }}">{{ $seller->url }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- User info -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">User info</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table profile__table">
                            <tbody>
                                <tr>
                                    <th><strong>Location</strong></th>
                                    <td>{{ $seller->address }}</td>
                                </tr>
                                <tr>
                                    <th><strong>Followers</strong></th>
                                    <td>{{ $seller->followers->count() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Latest posts -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Latest posts</h4>
                    </div>
                    <div class="panel-body">
                        <div class="profile__comments">
                            <div class="profile-comments__item">
                                <div class="profile-comments__controls">
                                    <a href="#"><i class="fa fa-share-square-o"></i></a>
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                    <a href="#"><i class="fa fa-trash-o"></i></a>
                                </div>
                                <div class="profile-comments__avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="...">
                                </div>
                                <div class="profile-comments__body">
                                    <h5 class="profile-comments__sender">
                                        Richard Roe <small>2 hours ago</small>
                                    </h5>
                                    <div class="profile-comments__content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, corporis.
                                        Voluptatibus odio perspiciatis non quisquam provident, quasi eaque officia.
                                    </div>
                                </div>
                            </div>
                            <div class="profile-comments__item">
                                <div class="profile-comments__controls">
                                    <a href="#"><i class="fa fa-share-square-o"></i></a>
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                    <a href="#"><i class="fa fa-trash-o"></i></a>
                                </div>
                                <div class="profile-comments__avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="...">
                                </div>
                                <div class="profile-comments__body">
                                    <h5 class="profile-comments__sender">
                                        Richard Roe <small>5 hours ago</small>
                                    </h5>
                                    <div class="profile-comments__content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero itaque dolor
                                        laboriosam dolores magnam mollitia, voluptatibus inventore accusamus illo.
                                    </div>
                                </div>
                            </div>
                            <div class="profile-comments__item">
                                <div class="profile-comments__controls">
                                    <a href="#"><i class="fa fa-share-square-o"></i></a>
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                    <a href="#"><i class="fa fa-trash-o"></i></a>
                                </div>
                                <div class="profile-comments__avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="...">
                                </div>
                                <div class="profile-comments__body">
                                    <h5 class="profile-comments__sender">
                                        Richard Roe <small>1 day ago</small>
                                    </h5>
                                    <div class="profile-comments__content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, esse, magni
                                        aliquam quisquam modi delectus veritatis est ut culpa minus repellendus.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <br><br><br><br>
                <!-- Contact user -->
                <p>
                    @if ($seller->user()->isNot(auth()->user()))
                        <button data-bs-toggle="modal" data-bs-target="#message"
                            class="profile__contact-btn btn btn-lg btn-block btn-info">
                            Contact user
                        </button>
                        <follow-button route={{ route('follows.add', $seller->id) }} follows="{{ $follows }}">
                        </follow-button>
                    @else
                        <a href="{{ route('services.create') }}"
                            class="profile__contact-btn btn btn-lg btn-block btn-info">
                            Add Photo
                        </a>
                        <a href="{{ route('sellers.edit', $seller) }}"
                            class="profile__contact-btn btn btn-lg btn-block btn-info">
                            Update Profile
                        </a>
                    @endif

                </p>

                <hr class="profile__contact-hr">

                <!-- Contact info -->
                <div class="profile__contact-info">
                    <div class="profile__contact-info-item">
                        <div class="profile__contact-info-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="profile__contact-info-body">
                            <h5 class="profile__contact-info-heading">Phone number</h5>
                            {{ $seller->phone_num }}
                        </div>
                    </div>

                    <div class="profile__contact-info-item">
                        <div class="profile__contact-info-icon">
                            <i class="fa fa-envelope-square"></i>
                        </div>
                        <div class="profile__contact-info-body">
                            <h5 class="profile__contact-info-heading">E-mail address</h5>
                            <a href="mailto:{{ $seller->user->email }}">{{ $seller->user->email }}</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ asset($seller->sellerImage()) }}" class="rounded-circle" width="200px" height="200px">

            </div>
            <div class="link-web col-sm-4">
                <a href="{{ route('services.index') }}" class="btn btn-outline-primary mb-3">Back</a>
                <h2><strong>{{ $seller->sellername }}</strong></h2>
                <h3>{{ $seller->address }}</h3>
                <a class="h3" href="{{ $seller->url }}" target="blank">{{ $seller->url }}</a>
                <div class="h4 mt-2">
                    <strong>{{ $seller->followers->count() }}</strong>
                    followers
                </div>
            </div>
            <div class="col-sm-4">
                <div class="h4"><strong> Description</strong></div>
                <div class="h5">{{ $seller->description }}</div>
            </div>
            @if ($seller->user()->is(auth()->user()))
                <div class="col-sm-2 align-self-end">
                    <a href="{{ route('services.create') }}" class="btn btn-outline-success mb-3">Add
                        Service</a>
                    <a href="{{ route('sellers.edit', $seller) }}" class="btn btn-outline-secondary mb-3">Update
                        Seller
                        Profile</a>
                </div>
            @else
                <follow-button route={{ route('follows.add', $seller->id) }} follows="{{ $follows }}">
                </follow-button>
            @endif

        </div>
        <div class="row">
            <div class="container trending-wrapper mb-5">
                @if ($services->count())
                    <h3 class='mb-4 text-center'>
                    @if ($seller->user()->is(auth()->user()))Your Services @else
                            {{ $seller->sellername }} Services @endif
                    </h3>
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
                                                        <a href="{{ route('orders.show', $service) }}"
                                                            class="learn-more detailslearn"><i
                                                                class="fa fa-shopping-cart"></i>
                                                            Purchase</a>
                                                    @endif
                                                    <a href="{{ route('services.show', $service) }}"
                                                        class="learn-more detailslearn"><i class="fa fa-link"></i>
                                                        Details</a>
                                                </p>
                                            </div>
                                            <span class="maxproduct"><img src="{{ asset($service->serviceImage()) }}"
                                                    alt=""></span>
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

                @else
                    <h3>
                        @if ($seller->user()->is(auth()->user()))You didn't Sell any
                            Service
                        Yet @else
                            {{ $seller->sellername }} Didn't Have any Services Yet @endif
                    </h3>
                @endif
            </div>
        </div>
    </div> --}}
@endsection
