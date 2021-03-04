@extends('layouts.app')
@section('title', 'Seller - Colance')

@section('content')

    <div class="container custom-login">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-sm-offset-4">
                <h4>Seller Profile</h4>
                <form action="{{ route('sellers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Seller Name</label>
                        <input type="text" name="sellername" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Seller Address</label>
                        <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Domicili" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Seller Link</label>
                        <input type="text" name="url" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Website" required>
                    </div>

                    <button type="submit" class="btn btn-outline-success">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection
