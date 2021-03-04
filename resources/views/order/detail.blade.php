@extends('layouts.app')
@section('title', 'Order - Colance')

@section('content')
    <div class="container">
        <div class="col-sm-10">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>Amount</td>
                        <td>Rp. {{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>Rp. {{ number_format(($total * 10) / 100) }}</td>
                    </tr>

                    <tr>
                        <td>Total amount</td>
                        <td>Rp. {{ number_format(($total * 110) / 100) }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <form action="{{ route('orders.now') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="description" placeholder="Describe your request" class="form-control"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Payment Method:</label> <br><br>
                        <input type="radio" value="Gopay" class="form-check-input" name="payment"><span> Gopay</span>
                        <br><br>
                        <input type="radio" value="OVO" class="form-check-input" name="payment"><span>
                            OVO</span><br><br>
                        <input type="radio" value="BCA Transfer" class="form-check-input" name="payment"><span> BCA
                            Transfer</span> <br><br>
                    </div>
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <button type="submit" class="btn btn-outline-success">Pay Now</button>
                </form>
            </div>
        </div>
    </div>

@endsection
