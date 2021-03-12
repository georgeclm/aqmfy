@extends('layouts.app')
@section('title', 'Seller - Colance')
@section('content')

    <div class="container custom-login">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-sm-offset-4">
                <h4>Seller Profile</h4>
                <form action="{{ route('sellers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Seller Name</label>
                        <input type="text" name="sellername" class="form-control" id="exampleInputName"
                            value="{{ old('sellername') }}" aria-describedby="emailHelp" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputAddress" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="exampleInputAddress"
                            value="{{ old('address') }}" aria-describedby="emailHelp" placeholder="Domicili" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUrl" class="form-label">Website Link</label>
                        <input type="text" name="url" class="form-control" id="exampleInputUrl" aria-describedby="emailHelp"
                            value="{{ old('url') }}" placeholder="Website" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description of You</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Seller Picture</label>
                        <input type="file" class="form-control @error('image')is-invalid @enderror" name="image"
                            value="{{ old('image') }}" aria-describedby="emailHelp">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-outline-success">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection
