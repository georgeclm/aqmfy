@extends('layouts.app')
@section('title', "Search Results for '{$query}'- Colance")

@section('content')
    <div class="container">
        <div class="col-sm-4">
            <a href="#" class="btn btn-outline-secondary">Filter</a>
        </div>
        <div class="col-md-12">
            <div class="trending-wrapper m-auto">
                <div class="h2 my-4">Result for "{{ $query }}"</div>
                <x-services :services="$services" />
            </div>
        </div>
    </div>
@endsection
