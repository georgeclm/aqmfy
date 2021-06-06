<div id="cart-view">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    @if ($carts->count())
                        <div class="cart-view-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)

                                            <tr>
                                                <td>
                                                    <form wire:submit.prevent="removeFromCart({{ $cart->id }})"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="aa-remove-product"><span
                                                                class="fa fa-times"></span></button>
                                                    </form>

                                                </td>
                                                <td><a href="{{ route('services.show', $cart->service) }}"><img
                                                            style="width: 150px"
                                                            src="{{ $cart->service->serviceImage() }}" alt="img"></a>
                                                </td>
                                                <td><a class="aa-cart-title"
                                                        href="{{ route('services.show', $cart->service) }}">{{ $cart->service->name }}</a>
                                                </td>
                                                <td> Rp. {{ number_format($cart->service->price) }}</td>
                                                <td><input class="aa-cart-quantity" type="number"
                                                        value="{{ $cart->quantity }}" disabled></td>
                                                <td>Rp. {{ number_format($cart->price) }}</td>
                                            </tr>
                                        @endforeach

                                        {{-- <tr>
                                                <td colspan="6" class="aa-cart-view-bottom">
                                                    <div class="aa-cart-coupon">
                                                        <input class="aa-coupon-code" type="text" placeholder="Coupon">
                                                        <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                                                    </div>
                                                    <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                                                </td>
                                            </tr> --}}
                                    </tbody>
                                </table>
                            </div>

                            <!-- Cart Total view -->
                            <div class="cart-view-total">
                                <h4>Cart Totals</h4>
                                <table class="aa-totals-table">
                                    <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>Rp. {{ number_format($subtotal) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td>Rp. {{ number_format($tax) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>Rp. {{ number_format($total) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="{{ route('checkout') }}" class="aa-cart-view-btn">Proced to
                                    Checkout</a>
                            </div>
                        </div>
                    @else
                        <div class="d-grid gap-2 col-5 mx-auto text-center">
                            <br><br>
                            <h2 class="mb-3 fs-1">Cart is empty </h2>
                            <a class="btn btn-primary btn-lg" href="{{ route('wishlists.show') }}">Check
                                Wishlist</a>
                        </div>
                        <br><br><br>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            new Notify({
                status: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                effect: 'fade',
                speed: 300,
                customClass: null,
                customIcon: null,
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                gap: 20,
                distance: 20,
                type: 2,
                position: 'right top'
            })

        </script>
    @endif

</div>
