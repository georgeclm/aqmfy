@extends('layouts.app')
@section('title', 'Edit Seller Profile - Aqmfy')
@section('content')
    <div class="container">
        <div class="row gutters mt-3">
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <br><br><br>
                <form action="{{ route('sellers.update', $seller) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h5 class="mb-2 text-primary">Edit your Seller Profile</h5>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group  @error('sellername') has-error @enderror">
                                        <label for="fullName">Seller Name</label>
                                        <input type="text" class="form-control" id="fullName" placeholder="Enter full name"
                                            name="sellername" value="{{ old('sellername') ?? $seller->sellername }}">
                                        @error('sellername')
                                            <span id="helpBlock2" class="help-block"
                                                style="font-size: 12px;color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group ">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" id="eMail" placeholder="Enter email ID"
                                            value={{ $seller->user->email }} disabled>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group @error('phone_num') has-error @enderror">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Enter phone number"
                                            name="phone_num" value="{{ old('phone') ?? $seller->phone_num }}">
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
                                            value="{{ old('url') ?? $seller->url }}">
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
                                            value={{ old('address') ?? $seller->address }} placeholder="Enter Street">
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
                                            value="{{ old('description') ?? $seller->description }}"
                                            placeholder="Enter Description">
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
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
