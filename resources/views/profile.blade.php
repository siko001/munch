<x-layout>
    {{-- Logged-in user --}}
    <section class="book_section ">
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success text-center mt-5">
                    {{ Session::get('success') }}
                </div>
            @elseif (Session::has('failure'))
                <div class="alert alert-danger text-center mt-5">
                    {{ Session::get('failure') }}
                </div>
            @endif
        </div>
    </section>
    @if (Auth::user())
        <script>
            window.location.href = '{{ url('/profile/settings') }}';
        </script>

        {{-- Logged-in staff-member --}}
    @elseif(Auth::guard('staff')->check())
        <script>
            window.location.href = '{{ url('/staff-profile/settings') }}';
        </script>


        {{-- Non logged-in Visitors --}}
    @else
        <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center login-cards">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <a href="/login-staff">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-content text-center">
                                <div class="image-container">
                                    <img src="{{ asset('images/staff3.png') }}" alt="Staff Image"
                                        class="staff card-img-top" id="staf">
                                </div>
                                <h1 class="staff card-text text-center">Staff Login</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <a href="/login">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-content text-center">
                                <div class="image-container">
                                    <img src="{{ asset('images/user.png') }}" alt="User Image" class="user card-img-top"
                                        id="user">
                                </div>
                                <h1 class="user card-text text-center">User Login</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endif
</x-layout>
