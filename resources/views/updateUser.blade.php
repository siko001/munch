<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center mb-5">

                <h3>
                    Your Are Editing {{ $user->name }}'s Profile Details
                </h3>
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

            <div class="card-body" id="profile-settings">

                <form action="/update/useracc/{{ $user->id }}" method="POST">
                    @method('PUT')
                    <input type="hidden" name="name" id="nameFieldInput" value="">
                    <input type="hidden" name="email" id="emailFieldInput" value="">
                    <input type="hidden" name="phone" id="phoneFieldInput" value="">
                    <input type="hidden" name="zip" id="zipFieldInput" value="">
                    <input type="hidden" name="city" id="cityFieldInput" value="">
                    <input type="hidden" name="address" id="addressFieldInput" value="">

                    @csrf
                    <h5>
                        <div class="row">
                            <div class="col-sm-2 mb-3 text-center underline">Name</div>
                            <div class="col-sm-8 mb-2 yeah" id="nameField">
                                <span class="yeah">{{ $user->name }}</span>
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-2 text-center">
                                <button onclick="handleButtonClick(this)" class="round fa fa-pencil" data-id="nameField"
                                    data="name">
                                </button>
                            </div>
                        </div>
                        <span class="name-notice text-center"></span>
                        <hr>

                        <div class="row">
                            <div class="col-sm-2 mb-3 text-center underline">Email</div>
                            <div class="col-sm-8 mb-2 yeah" id="emailField">
                                <span class="yeah">{{ $user->email }}</span>
                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-2 text-center">
                                <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                    data-id="emailField" data="email">
                                </button>
                            </div>
                        </div>
                        <span class="email-notice text-center"></span>
                        <hr>

                        <div class="row">
                            <div class="col-sm-2 mb-3 text-center underline">Phone</div>
                            <div class="col-sm-8 mb-2 yeah" id="phoneField">
                                <span class="yeah">{{ $user->phone }}</span>
                            </div>
                            <div class="col-sm-2 text-center">
                                <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                    data-id="phoneField" data="phone">
                                </button>
                            </div>
                        </div>
                        <span class="phone-notice text-center"></span>
                        <hr>

                        <div class="row">
                            <div class="col-sm-2 mb-3 text-center underline">Address</div>
                            <div class="col-sm-8 mb-2 yeah" id="addressField">
                                <span class="yeah">{{ $user->address }}</span>
                                @error('address')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-2 text-center">
                                <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                    data-id="addressField" data="address">
                                </button>
                            </div>
                        </div>
                        <span class="address-notice text-center"></span>
                        <hr>
                        <div class="row">
                            <div class="col-sm-2 mb-3 text-center underline">Zip Code</div>
                            <div class="col-sm-8 mb-2 yeah" id="zipField">
                                <span class="yeah">{{ $user->zip }}</span>
                                @error('zip')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-2 text-center">
                                <button onclick="handleButtonClick(this)" class="round fa fa-pencil" data-id="zipField"
                                    data="zip">
                                </button>
                            </div>
                        </div>
                        <span class="zip-notice text-center"></span>
                        <hr>
                        <div class="row">
                            <div class="col-sm-2 text-center mb-3 underline">City</div>
                            <div class="col-sm-8 mb-2 yeah" id="cityField">
                                <span class="yeah">{{ $user->city }}</span>
                                @error('city')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-2 text-center">
                                <button onclick="handleButtonClick(this)" class="round fa fa-pencil"
                                    data-id="cityField" data="city">
                                </button>
                            </div>
                        </div>

                        <span class="city-notice text-center"></span>
                        <hr>
                    </h5>

                    <div class="d-flex justify-content-center">
                        <a href="/update/user/{{ $user->id }}" class="btn btn-info mx-5 mt-5">Undo the Edit</a>
                        <button type="submit" class="btn btn-success mx-5 mt-5">Edit Account
                            Details</button>
                    </div>

                </form>
            </div>
    </section>
</x-layout>
