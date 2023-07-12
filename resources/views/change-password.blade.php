<x-layout>

    <section class="book_section layout_padding">
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
            <div class="heading_container text-center">
                <h2 style="margin: 0 auto;">Change your password</h2>
            </div>

            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">

                            @if (Auth::guard('staff')->user())
                                <a class="nav-link settings" href="/staff-profile/settings">Back To Account Settings</a>
                            @else
                                <a class="nav-link settings" href="/profile/settings">Back To Account Settings</a>
                            @endif
                        </li>
                    </ul>
                </div>

                <div class="card-body" id="profile-settings">
                    @if (Auth::guard('staff')->user())
                        <form method="POST"
                            action="/profile/change-password-staff/{{ Auth::guard('staff')->user()->id }}">
                        @else
                            <form method="POST" action="/profile/change-password/{{ Auth::user()->id }}">
                    @endif
                    @method('PUT')
                    <h5>
                        @csrf

                        <div class="row">
                            <div class="col-sm-4 mb-3 underline">Current Password</div>
                            <div class="col-sm-7 mb-2 yeah" id="currentPasswordField">
                                <span class="yeah"><input type="password" placeholder="********"
                                        class="password-input" name="currentPassword"></span>
                                @error('currentPassword')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <span class="currentPassword-notice"></span>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4 mb-3 underline">New Password</div>
                            <div class="col-sm-7 mb-2 yeah" id="newPasswordField">
                                <span class="yeah"><input type="password" placeholder="********"
                                        class="password-input" name="newPassword"></span>
                                @error('newPassword')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>
                        <span class="confirmNewPassword-notice"></span>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4 mb-3 underline">Confirm New Password</div>
                            <div class="col-sm-7 mb-2 yeah" id="confirmNewPasswordField">
                                <span class="yeah"><input type="password" placeholder="********"
                                        class="password-input" name="confirmNewPassword"></span>
                                @error('confirmNewPassword')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <span class="confirmNewPassword-notice"></span>
                        <hr>

                        <button class="btn btn-success">Change Password</button>
                        </form>
                </div>


                </h5>
            </div>
    </section>

</x-layout>
