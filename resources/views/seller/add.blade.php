@extends('layouts.app')
@section('title', 'Seller - Aqmfy')
@section('content')
    <div class="container">
        <div class="row gutters mt-3">
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <br><br><br>
                <form action="{{ route('sellers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h5 class="mb-2 text-primary">Become a Seller</h5>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group  @error('sellername') has-error @enderror">
                                        <label for="fullName">Seller Name</label>
                                        <input type="text" class="form-control" id="fullName" placeholder="Enter full name"
                                            name="sellername" value="{{ old('sellername') }}">

                                        @error('sellername')
                                            <span id="helpBlock2" class="help-block"
                                                style="font-size: 12px;color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group @error('email') has-error @enderror">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" id="eMail" placeholder="Enter email ID"
                                            value={{ auth()->user()->email }} disabled>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group @error('phone_num') has-error @enderror">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Enter phone number"
                                            name="phone_num" value="{{ old('phone') }}">
                                        @error('phone_num')
                                            <span id="helpBlock2" class="help-block"
                                                style="font-size: 12px;color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group @error('url') has-error @enderror">
                                        <label for="website">Website URL</label>
                                        <input type="url" class="form-control" placeholder="Website url" name="url"
                                            value="{{ old('url') }}">
                                        @error('url')
                                            <span id="helpBlock2" class="help-block"
                                                style="font-size: 12px;color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mt-3 mb-2 text-primary">Detail</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group @error('address') has-error @enderror">
                                        <label for="Address">Address</label>
                                        <input type="name" class="form-control" name="address"
                                            value="{{ old('address') }}" placeholder="Enter Street">
                                        @error('address')
                                            <span id="helpBlock2" class="help-block"
                                                style="font-size: 12px;color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group @error('description') has-error @enderror">
                                        <label for="Description">Description</label>
                                        <input type="name" class="form-control" name="description"
                                            value="{{ old('description') }}" placeholder="Enter Description">
                                        @error('description')
                                            <span id="helpBlock2" class="help-block"
                                                style="font-size: 12px;color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group @error('image') has-error @enderror">
                                        <label for="exampleInputFile">Profile Image</label>
                                        <input type="file" id="exampleInputFile" name="image">
                                        @error('image')
                                            <span id="helpBlock2" class="help-block"
                                                style="font-size: 12px;color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Become a Seller</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="container custom-login">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-sm-offset-4">
                <h4>Seller Profile</h4>
                <form action="{{ route('sellers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Seller Name</label>
                        <input type="text" name="sellername" class="form-control @error('sellername')is-invalid @enderror"
                            id="exampleInputName" value="{{ old('sellername') }}" aria-describedby="emailHelp"
                            placeholder="Name" required>
                        @error('sellername')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputAddress" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control @error('address')is-invalid @enderror"
                            id="exampleInputAddress" value="{{ old('address') }}" aria-describedby="emailHelp"
                            placeholder="Domicili" required>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUrl" class="form-label">Website Link</label>
                        <input type="text" name="url" class="form-control @error('url')is-invalid @enderror"
                            id="exampleInputUrl" aria-describedby="emailHelp" value="{{ old('url') }}"
                            placeholder="Website">
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description of You</label>
                        <textarea class="form-control @error('description')is-invalid @enderror"
                            id="exampleFormControlTextarea1" rows="3"
                            name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
    </div> --}}
@endsection
