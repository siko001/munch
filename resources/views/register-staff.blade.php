<x-layout>
    <section class="about_section layout_padding">
        <div class="container  ">
            <div class="heading_container heading_center mb-5">
                <h2>
                    New Staff Member? Register your profile below!
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
                <div class="col-md-5 ">
                    <div class="img-box">
                        <img src="images/staff4.png" alt="">
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form_container ">


                        <form method="POST" action="/register-staffmember">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="name form-control name" id="name" name="name"
                                        required>
                                    <span class="name-notice">
                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="emailstaff form-control" id="emailstaff" name="email"
                                        required>
                                    <span class="email-notice">
                                        @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="phone form-control" id="phone" name="phone"
                                        required>
                                    <span class="phone-notice">
                                        @error('phone')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex flex-column">
                                        <label for="role">Your Role</label>
                                        <select required id="role" name="role"
                                            class="form-control remove-option-space">
                                            <option selected disabled>Manager</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Food server">Food server</option>
                                            <option value="Chef">Chef</option>
                                        </select>
                                    </div>
                                    @error('role')
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
                                    <span class="password-notice">
                                        @error('password')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" class="confirm-password form-control" id="confirm-password"
                                        name="confirm-password" required>
                                    <span class="confirm-password-notice">
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
                                        Agree to sell your soul?
                                    </label>
                                    <p class="mt-4 mb-4">Already have an Account? <a href="/login-staff">Login</a></p>
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
