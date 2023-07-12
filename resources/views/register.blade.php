<x-layout>
    <section class="about_section layout_padding">
        <div class="container  ">
            <div class="heading_container heading_center mb-5">
                <h2>
                    Register to a unique gastronomic experience!
                </h2>
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('failure'))
                    <div class="alert alert-danger">
                        {{ Session::get('failure') }}
                    </div>
                @endif
            </div>

            <div class="row ">
                <div class="col-md-4 ">
                    <div class="img-box">
                        <img src="images/login1.png" alt="login Image">
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form_container ">


                        <form method="POST" action="/register-user">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="name form-control" id="name" name="name"
                                        required>
                                    <span class="name-notice notice"> @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="emailuser form-control" id="email" name="email"
                                        required>
                                    <span class="email-notice"> @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="address">Home Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                    @error('address')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                    @error('city')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip" required>
                                    @error('zip')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="phone form-control" id="phone" name="phone"
                                        required> <span class="phone-notice notice">
                                        @error('phone')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="password form-control" id="password" name="password"
                                        required>
                                    <span class="password-notice notice">
                                        @error('password')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" class="confirm-password form-control" id="confirm-password"
                                        name="confirm-password" required>
                                    <span class="confirm-password-notice notice">
                                        @error('confirm-password')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
                                        required>
                                    <label class="form-check-label" for="invalidCheck2">
                                        Agree to terms and conditions
                                    </label>
                                    <p class="mt-4 mb-4">Already have an Account? <a href="/login">Login</a></p>
                                </div>
                            </div>
                            <button class="btn btn-primary col-md-4" type="submit">Register</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
