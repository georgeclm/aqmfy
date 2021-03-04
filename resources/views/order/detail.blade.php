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
                        <td>Rp. 0</td>
                    </tr>
                    <tr>
                        <td>Delivery Charges</td>
                        <td>Rp. 10</td>
                    </tr>
                    <tr>
                        <td>Total amount</td>
                        <td>Rp. {{ number_format($total + 10) }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <form action="/order1" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="address" type="email" placeholder="Enter your address" class="form-control"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Payment Method:</label> <br><br>
                        <input type="radio" value="cash" class="form-check-input" name="payment" id=""><span> Online
                            Payment</span> <br><br>
                        <input type="radio" value="cash" class="form-check-input" name="payment" id=""><span> Cash On
                            Delivery</span><br><br>
                        <input type="radio" value="cash" class="form-check-input" name="payment" id=""><span> Shop
                            Outlet</span> <br><br>
                    </div>
                    <input type="hidden" name="product_id" value="{{ $serviceId }}">

                    <button type="submit" class="btn btn-outline-success">Pay Now</button>
                </form>
            </div>
        </div>
    </div>

@endsection
