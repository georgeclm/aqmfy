@extends('layouts.app')
@section('title', 'Edit Photo - Aqmfy')
@section('content')
    <br><br><br><br><br><br><br>
    <div class="container">
        <form class="well form-horizontal" action="{{ route('services.update', $service) }} " method="POST"
            id="contact_form" style="background-color:white !important; border:none !important;">
            @csrf
            @method('patch')
            <!-- Form Name -->
            <legend>
                <br><br><br>
                <div style="text-align: center">
                    <h2><b>Update your Photo</b></h2>
                </div>
            </legend><br>
            <!-- Text input-->
            <div class="form-group @error('name') has-error @enderror">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <input name="name" placeholder="Name" class="form-control" type="text"
                            value="{{ old('name') ?? $service->name }}">
                        @error('name')
                            <span id="helpBlock2" class="help-block"
                                style="font-size: 12px;color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group @error('price') has-error @enderror">
                <label class="col-md-4 control-label">Price</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <input name="price" placeholder="Price" class="form-control" type="number"
                            value="{{ old('price') ?? $service->price }}">
                        @error('price')
                            <span id="helpBlock2" class="help-block"
                                style="font-size: 12px;color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class=" form-group @error('category') has-error @enderror">
                <label class="col-md-4 control-label">Category</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <select name="category" class="form-control selectpicker">
                            <option value="" selected disabled hidden>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($service->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span id="helpBlock2" class="help-block"
                                style="font-size: 12px;color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group @error('description') has-error @enderror">
                <label class="col-md-4 control-label">Description</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="aa-checkout-single-bill">
                        <textarea name="description" cols="30" rows="3"
                            placeholder="Description">{{ old('description') ?? $service->description }}</textarea>
                        @error('description')
                            <span id="helpBlock2" class="help-block"
                                style="font-size: 12px;color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group @error('image') has-error @enderror">
                <label class="col-md-4 control-label">Image</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <input name="image" class="form-control" type="file"
                            value="{{ old('image') ?? $service->image }}">
                        @error('image')
                            <span id="helpBlock2" class="help-block"
                                style="font-size: 12px;color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit"
                        class="btn btn-warning">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUPDATE
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                </div>
            </div>
        </form>
    </div><!-- /.container -->
@endsection
