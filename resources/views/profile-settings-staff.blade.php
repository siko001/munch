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

                <h2 style="margin: 0 auto;">Profile</h2>
            </div>

            <x-staffnavbar>
            </x-staffnavbar>

            <div class="card-body" id="profile-settings">
                <form action="/update-profile/staff/{{ Auth::guard('staff')->user()->id }}" method="POST">
                    @method('PUT')
                    <input type="hidden" name="name" id="nameFieldInput" value="">
                    <input type="hidden" name="email" id="emailFieldInput" value="">
                    <input type="hidden" name="phone" id="phoneFieldInput" value="">
                    <input type="hidden" name="zip" id="zipFieldInput" value="">
                    <input type="hidden" name="city" id="cityFieldInput" value="">
                    <input type="hidden" name="address" id="addressFieldInput" value="">

                    @csrf
                    @if (Auth::guard('staff')->user()->active !== true)
                        <h5>
                            <div class="row">
                                <div class="col-sm-2 mb-2 underline">Name</div>
                                <div class="col-sm-8 mb-2 yeah" id="nameField">
                                    <span class="yeah">{{ Auth::guard('staff')->user()->name }}</span>
                                    @error('name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                    <span class="name-notice"></span>
                                </div>
                                <div class="col-sm-2" id="buttonContainer">
                                    <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                        data-id="nameField" data="name">
                                    </button>
                                </div>
                            </div>
                            <span class="name-notice"></span>
                            <hr>
                            <div class="row">
                                <div class="col-sm-2 mb-3 underline">Email</div>

                                <div class="col-sm-8 mb-2 yeah" id="emailField">
                                    <span class="yeah">{{ Auth::guard('staff')->user()->email }}</span>

                                </div>
                                <div class="col-sm-2">
                                    @if (Auth::guard('staff')->user()->Role == 'Manager')
                                        <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                            data-id="emailField" data="email">
                                        </button>
                                    @else
                                    @endif
                                </div>
                            </div>
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <span class="email-notice"></span>
                            <hr>

                            <div class="row">
                                <div class="col-sm-2 mb-3 underline">Phone</div>
                                <div class="col-sm-8 mb-2 yeah" id="phoneField">
                                    <span class="yeah">{{ Auth::guard('staff')->user()->phone }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                        data-id="phoneField" data="phone">
                                    </button>
                                </div>
                            </div>
                            <span class="phone-notice"></span>
                            <hr>
                            <div class="row">
                                <div class="col-sm-2 mb-3 underline">Role</div>
                                <div class="col-sm-8 mb-2 yeah" id="phoneField">
                                    <span class="yeah">{{ Auth::guard('staff')->user()->Role }}</span>
                                </div>
                                <div class="col-sm-2">

                                </div>
                            </div>

                            <hr>
                        </h5>


                        <div class="row">
                            <div class="col-sm-12 text-large"><a href="/profile/change-password">Change Password</a>
                            </div>
                        </div>
                        <hr>
                    @else
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h3>
                                    PROFILE IS NOT ACTIVE PLEASE RE-ACTIVATE TO CHANGE PROFILE SETTINGS
                                </h3>
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        {{-- If Manager cannot disable profile --}}
                        @if (Auth::guard('staff')->user()->Role == 'Manager')
                        @else
                            @if (Auth::guard('staff')->user()->isActive == true)
                                <div class="col-sm mb-4 mt-4 number1">
                                    <a href="/profile/disable/{id}" class="btn btn-danger number1">Disable
                                        Profile</a>
                                </div>
                            @endif
                        @endif
                        <div class="col-sm mb-4 mt-4 d-flex number3 justify-content-center align-items-center">
                            <div class="text-center">
                                @if (Auth::guard('staff')->user()->isActive != true)
                                    <a href="/profile/activate/{id}" class="btn btn-success">Activate
                                        Profile</a>
                                @else
                                    <button type="submit" class="btn btn-success number3">Save Settings</button>
                                @endif
                            </div>
                        </div>

                        @if (Auth::guard('staff')->user()->isActive != true)
                        @else
                            <div class="col-sm mb-4 mt-4 number2">
                                <a href="/staff-profile/settings" class="btn btn-danger number2">Undo Edit</a>
                            </div>
                        @endif
                    </div>
                    <hr>


                </form>

            </div>
        </div>

    </section>
</x-layout>
