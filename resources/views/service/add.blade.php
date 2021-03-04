@extends('layouts.app')
@section('title', 'Add Service - Colance')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-sm-offset-4">
                <h4>Add Your Service</h4>
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name of Service</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Delivery Time</label>
                        <input type="number" name="delivery_time" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Revision Time</label>
                        <input type="number" name="revision_time" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="0" required>
                    </div>


                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Category" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="exampleInputEmail1" rows=5
                            aria-describedby="emailHelp" placeholder="Description" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Service Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Upload Service</button>
                </form>

            </div>
        </div>
    </div>
@endsection
