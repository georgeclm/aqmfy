@extends('layouts.app')
@section('title', "{$service->name} - Colance")
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
                <h4>Description: {{ $service->description }}</h4>
                <h4>Category: {{ $service->category }}</h4>
                <br><br>
                <form action="{{ route('carts.store') }}" method="POST">
                    @csrf
                    <!--This input hidden to take the service id that is going to cart-->
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <button class="btn btn-primary">
                        Add to cart</button><br><br>

                </form>
                @error('service_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <form action='{{ route('orders.now') }}' method="POST">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <button class="btn btn-success">Buy Now</button>
                </form>


            </div>

        </div>
    </div>
@endsection
