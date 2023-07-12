<x-layout>
    <div class="container min-vh-100 justify-content-center align-items-center d-flex text-center">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-danger">
                        <h4> Please Verify Your Email Before Proceeding </h4>
                    </div>

                    <div class="card-body">
                        @if (Session::has('resent'))
                            <div class="alert alert-success text-center mt-5">
                                {{ Session::get('resent') }}
                            </div>
                        @endif

                        <p>{{ __('Please check your email for a verification link and a Welcome Letter.') }}</p>
                        <p>{{ __('If you did not receive or lost the email') }}<br> <a
                                href="/resend-verification-link/{{ Auth::user()->id }}">{{ __('click here to request another') }}</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
