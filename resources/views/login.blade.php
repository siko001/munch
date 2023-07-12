<x-layout>

    <section class="about_section layout_padding">
        <div class="container  ">
            <div class="heading_container heading_center mb-4">
                <h2>
                    Login
                </h2>
                @if (Session::has('success'))
                    <div class="alert alert-success mt-5">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('failure'))
                    <div class="alert alert-danger mt-5">
                        {{ Session::get('failure') }}
                    </div>
                @endif
            </div>


            <div class="row">
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="images/register.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form_container ">


                        <form method="POST" action="/login-user">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    @error('password')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember-me">
                                <label class="form-check-label" for="remember-me">Remember me</label>
                            </div>
                            <div class="form-row">
                                <p class="small">Never experienced munch munch?! <a href="/register">Change That
                                        here!</a></p>
                            </div>
                            <div class="form-row">
                                <p class="small">Forgot your password? <a href="/forgot-password">Get it back</a></p>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-primary mt-3" type="submit">Login</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
    </section>
</x-layout>
