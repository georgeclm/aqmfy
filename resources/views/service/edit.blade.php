@extends('layouts.app')
@section('title', 'Edit Service - Colance')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-sm-offset-4">
                <h4>Edit your Gig</h4>
                <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name of Service</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                            value="{{ old('name') ?? $service->name }}" aria-describedby="emailHelp" placeholder="Name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                            value="{{ old('price') ?? $service->price }}" aria-describedby="emailHelp" placeholder="0"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Delivery Time (Days)</label>
                        <input type="number" name="delivery_time" class="form-control" id="exampleInputEmail1"
                            value="{{ old('delivery_time') ?? $service->delivery_time }}" aria-describedby="emailHelp"
                            placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Revision Time</label>
                        <input type="number" name="revision_time" class="form-control" id="exampleInputEmail1"
                            value="{{ old('revision_time') ?? $service->revision_time }}" aria-describedby="emailHelp"
                            placeholder="0" required>
                    </div>


                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" id="exampleInputEmail1"
                            value="{{ old('category') ?? $service->category }}" aria-describedby="emailHelp"
                            placeholder="Category" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="exampleInputEmail1" rows=5
                            value="{{ old('description') ?? $service->description }}" aria-describedby="emailHelp"
                            placeholder="Description"
                            required>{{ old('description') ?? $service->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Service Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                            value="{{ old('image') }}" aria-describedby="emailHelp">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Update Service</button>
                </form>

            </div>
        </div>
    </div>
@endsection
