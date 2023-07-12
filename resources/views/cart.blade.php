<x-layout>
    <div class="container">
        <div class="contentbar">
            <!-- Start row -->
            <div class="row">
                <!-- Start col -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title">Cart</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-xl-8">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success text-center mt-5">
                                            {{ Session::get('success') }}
                                        </div>
                                    @elseif (Session::has('failure'))
                                        <div class="alert alert-danger text-center mt-5">
                                            {{ Session::get('failure') }}
                                        </div>
                                    @endif
                                    Items: {{ Cart::count() }}
                                    <div class="cart-container">

                                        <div class="cart-head">
                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#ID</th>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Qty</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col" class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $count = 1;
                                                        @endphp

                                                        @foreach (Cart::content() as $product)
                                                            @php
                                                                $productTotal = $product->qty * $product->price;
                                                                
                                                            @endphp
                                                            <tr>
                                                                <th scope="row">{{ $product->id }}</th>


                                                                <td>{{ $product->name }}</td>
                                                                <td>
                                                                    <div
                                                                        class="form-group mb-0 d-flex align-items-center justify-content-center">
                                                                        <a href="/decrement-product/{{ $product->rowId }}"
                                                                            class="btn btn-outline-primary btn-sm extra decrement-btn"><i
                                                                                class="fa fa-minus sm"
                                                                                aria-hidden="true"></i></a>
                                                                        <p class="prd-qty">{{ $product->qty }}</p>
                                                                        <a href="/increment-product/{{ $product->rowId }}"
                                                                            class="btn btn-outline-primary btn-sm extra increment-btn"><i
                                                                                class="fa fa-plus"
                                                                                aria-hidden="true"></i></a>
                                                                    </div>



                                                                </td>
                                                                <td>{{ $product->price }}€</td>
                                                                <td class="text-right">{{ $productTotal }}€</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="cart-body">
                                            <div class="row">
                                                <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                    <div class="order-note">
                                                        <form method="POST" action="/apply-discount">
                                                            @csrf
                                                            <div class="form-group">

                                                                <div class="input-group">
                                                                    @error('coupon')
                                                                        <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                    <input style="color:red" type="text"
                                                                        class="form-control" placeholder="Coupon Code"
                                                                        name="coupon" value="{{ $cartCouponCode }}"
                                                                        @if ($cartCouponCode) readonly @endif>
                                                                    <div class="input-group-append">
                                                                        @unless ($cartCouponCode != null)
                                                                            <button class="input-group-text" type="submit"
                                                                                id="button-addonTags">Apply</button>
                                                                        @endunless
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <form action="/proceed-to-payment" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="specialNotes">Special notes for
                                                                    order</label>
                                                                <textarea class="form-control" style="min-height:100px;max-height:100px" name="specialNotes" id="specialNotes"
                                                                    rows="3" placeholder="Message here"></textarea>
                                                            </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                                    <div class="order-total table-responsive ">
                                                        <table class="table table-borderless text-right">
                                                            <tbody>
                                                                @if (session('discount'))
                                                                    <div class="alert alert-success">
                                                                        {{ session('discount') }} Total discount:
                                                                        {{ session('totalDiscount') }} €
                                                                    </div>
                                                                @endif
                                                                <tr>
                                                                    <td class="f-w-7 font-18">
                                                                        <h4>Total ::</h4>
                                                                    </td>
                                                                    <td class="f-w-7 font-18">
                                                                        <h4>{{ Cart::total() }} €</h4>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- IF CART IS 0 NO PROCEDD --}}
                                        @if (Cart::subtotal() == '0')
                                        @else
                                            {{-- CHECK IF IT@S LOGGED IN USER --}}
                                            @if (Auth::user())
                                                {{-- IF LOGGED IN USER CHECK IF PROFILE IS ACTIVE --}}
                                                @if (Auth::user()->active == false)
                                                    <div class="cart-footer">
                                                        <div class="row">
                                                            <h3 class="text-center mx-auto">Please <a
                                                                    href="/profile/settings">Re-active
                                                                    Account</a> to continue
                                                            </h3>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="cart-footer">
                                                        <div class="row">
                                                            <div class="col-md-6 mt-3">
                                                                <label for="delMethod">Pick-up/Delivery</label>
                                                                <br>
                                                                <select class="form-control" id="delMethod"
                                                                    name="delMethod">
                                                                    <option selected>Delivery</option>
                                                                    <option>Pick Up</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mt-3 mb-3">
                                                                @error('timeToDel')
                                                                    <div class="error">{{ $message }}</div>
                                                                @enderror
                                                                <label for="timeToDel">Time</label>
                                                                <br>
                                                                <input type="time" name="timeToDel" min="13:30"
                                                                    max="21:30" id="timeInput">

                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-6 text-right">
                                                                <a href="/empty-cart" class="btn btn-danger mb-2">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    Empty Cart
                                                                </a>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <button class="btn btn-success mb-2">Proceed to Checkout
                                                                    <i class="ri-arrow-right-line ml-2"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- IF GUEST WANTING TO CHECKOUT --}}
                                            @else
                                                <div class="cart-footer">
                                                    <div class="row">
                                                        <div class="col-md-6 mt-3">
                                                            <label for="delMethod">Pick-up/Delivery</label>
                                                            <br>
                                                            <select class="form-control" id="delMethod"
                                                                name="delMethod">
                                                                <option selected>Delivery</option>
                                                                <option>Pick Up</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mt-3 mb-3">
                                                            @error('timeToDel')
                                                                <div class="error">{{ $message }}</div>
                                                            @enderror
                                                            <label for="timeToDel">Time</label>
                                                            <br>

                                                            <input name="timeToDel" type="time" min="13:30"
                                                                max="21:30" id="timeInput">

                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-6 text-right">
                                                            <a href="/empty-cart" class="btn btn-danger mb-2">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                Empty Cart
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <button class="btn btn-success mb-2">Proceed to Checkout
                                                                <i class="ri-arrow-right-line ml-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
    </div>
</x-layout>
