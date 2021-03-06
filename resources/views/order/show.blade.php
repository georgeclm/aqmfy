@extends('layouts.app')
@section('title', 'Order details - Colance')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb h1">
                        <li class="breadcrumb-item text-success">Order details</li>
                        <li class="breadcrumb-item ">Confirm & Pay</li>
                    </ol>
                </div><br>
                <h1>Customize Your Package</h1><br>
                <div class="row">
                    <div class="col-md-3">
                        <img width="150" src="{{ asset("storage/product/{$service->image}") }}" alt="">
                    </div>
                    <div class="col-md-5">
                        <div class="">
                            <h2>{{ $service->name }}</h2>
                        </div>
                    </div>
                    <div class="col-md-1">


                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <h5>Rp. {{ number_format($service->price) }}</h5>

                    </div>

                </div>
                <hr>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 m-auto">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><strong>Summary</strong></h5>
                        <div class="d-flex mb-4">
                            <p class="card-text">Subtotal</p>
                            <div class="ms-auto">Rp. {{ number_format($service->price) }}</div>
                        </div>
                        <div class="d-flex">
                            <p class="card-text">Service Fee</p>
                            <div class="ms-auto">Rp. {{ number_format(($service->price * 10) / 100) }}</div>
                        </div>
                        <hr>
                        <div class="d-flex">
                            <p class="card-text"><strong>Total</strong> </p>
                            <div class="ms-auto"><strong>Rp. {{ number_format(($service->price * 110) / 100) }}</strong>
                            </div>
                        </div>
                        <div class="d-flex">
                            <p class="card-text">Delivery Time</p>
                            <div class="ms-auto">{{ $service->delivery_time }} day</div>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('orders.pay', $service) }}" class="btn btn-lg btn-success mb-2">Continue to
                                Checkout</a>
                            <div class="text-muted">You won't be charged yet</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
