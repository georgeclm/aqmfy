@extends('layouts.app')
@section('title', 'Edit Seller Profile - Colance')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-sm-offset-4">
                <h4>Edit your Seller Profile</h4>
                <form action="{{ route('sellers.update', $seller) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name of seller</label>
                        <input type="text" name="sellername" class="form-control" id="exampleInputEmail1"
                            value="{{ old('sellername') ?? $seller->sellername }}" aria-describedby="emailHelp"
                            placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                            value="{{ old('address') ?? $seller->address }}" aria-describedby="emailHelp"
                            placeholder="Domicili">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Website Link</label>
                        <input type="text" name="url" class="form-control" id="exampleInputEmail1"
                            value="{{ old('url') ?? $seller->url }}" aria-describedby="emailHelp" placeholder="Website">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Seller Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                            value="{{ old('image') }}" aria-describedby="emailHelp">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Update Profile</button>
                </form>

            </div>
        </div>
    </div>
@endsection
