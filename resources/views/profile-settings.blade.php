<x-layout>
    <section class="book_section layout_padding">
        @if (Session::has('success'))
            <div class="alert alert-success text-center mt-5">
                {{ Session::get('success') }}
            </div>
        @elseif (Session::has('failure'))
            <div class="alert alert-danger text-center mt-5">
                {{ Session::get('failure') }}
            </div>
        @endif
        <div class="container">
            <div class="heading_container text-center">
                <h2 style="margin: 0 auto;">Profile</h2>
            </div>

            <x-subnav>
            </x-subnav>

            <div class="card-body" id="profile-settings">
                <form action="/update-profile/{{ auth()->user()->id }}" method="POST">
                    @method('PUT')
                    <input type="hidden" name="name" id="nameFieldInput" value="">
                    <input type="hidden" name="email" id="emailFieldInput" value="">
                    <input type="hidden" name="phone" id="phoneFieldInput" value="">
                    <input type="hidden" name="zip" id="zipFieldInput" value="">
                    <input type="hidden" name="city" id="cityFieldInput" value="">
                    <input type="hidden" name="address" id="addressFieldInput" value="">

                    @csrf
                    @if (auth()->user()->active == true)
                        <h5>
                            <div class="row">
                                <div class="col-sm-2 mb-3 underline">Name</div>
                                <div class="col-sm-8 mb-2 yeah" id="nameField">
                                    <span class="yeah">{{ auth()->user()->name }}</span>
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
                                    <span class="yeah">{{ auth()->user()->email }}</span>
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                        data-id="emailField" data="email">
                                    </button>
                                </div>
                            </div>
                            <span class="email-notice"></span>
                            <hr>

                            <div class="row">
                                <div class="col-sm-2 mb-3 underline">Phone</div>
                                <div class="col-sm-8 mb-2 yeah" id="phoneField">
                                    <span class="yeah">{{ auth()->user()->phone }}</span>
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
                                <div class="col-sm-2 mb-3 underline">Address</div>
                                <div class="col-sm-8 mb-2 yeah" id="addressField">
                                    <span class="yeah">{{ auth()->user()->address }}</span>
                                    @error('address')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                        data-id="addressField" data="address">
                                    </button>
                                </div>
                            </div>
                            <span class="address-notice"></span>
                            <hr>
                            <div class="row">
                                <div class="col-sm-2 mb-3 underline">Zip Code</div>
                                <div class="col-sm-8 mb-2 yeah" id="zipField">
                                    <span class="yeah">{{ auth()->user()->zip }}</span>
                                    @error('zip')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                        data-id="zipField" data="zip">
                                    </button>
                                </div>
                            </div>
                            <span class="zip-notice"></span>
                            <hr>
                            <div class="row">
                                <div class="col-sm-2 mb-3 underline">City</div>
                                <div class="col-sm-8 mb-2 yeah" id="cityField">
                                    <span class="yeah">{{ auth()->user()->city }}</span>
                                    @error('city')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                        data-id="cityField" data="city">
                                    </button>
                                </div>
                            </div>

                            <span class="city-notice"></span>
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
                        @if (auth()->user()->active == true)
                            <div class="col-sm mb-4 mt-4 number1">
                                <a href="/profile/disable/{{ auth()->user()->id }}"
                                    class="btn btn-warning number1">Disable
                                    Profile</a>
                            </div>
                        @endif

                        <div class="col-sm mb-4 mt-4 d-flex number3 justify-content-center align-items-center">
                            <div class="text-center">
                                @if (auth()->user()->active != true)
                                    <a href="/profile/activate/{{ auth()->user()->id }}"
                                        class="btn btn-primary">Activate
                                        Profile</a>
                                @else
                                    <button type="submit" class="btn btn-success number3">Save Settings</button>
                                @endif
                            </div>
                        </div>

                        @if (auth()->user()->active != true)
                        @else
                            <div class="col-sm mb-4 mt-4 number2">
                                <a href="/profile/settings" class="btn btn-danger number2">Undo Edit</a>
                            </div>
                        @endif
                    </div>
                    <hr>


                </form>
            </div>
        </div>

    </section>

</x-layout>
