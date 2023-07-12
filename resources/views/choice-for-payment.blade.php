<x-layout>

    <section class="book_section layout_padding">
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                        <li class="nav-item">
                            <p class="nav-link settings">Already Registered? <a href="/login">Login Here</a></p>
                        </li>
                        <a class="nav-link settings  {{ request()->is('proceed-to-payment') ? 'active' : '' }}"
                            href="/proceed-to-payment">Pay As A Guest</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <div class="form_container custom-container">
                        <form method="POST" action="/proccess-payment-guest">
                            <input type="hidden" name="delMethod" value="{{ session('delMethod') }}">
                            <input type="hidden" name="specialNotes" value="{{ session('specialNotes') }}">
                            <input type="hidden" name="timeToDel" value="{{ session('timeToDel') }}">

                            @method('POST');
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control form-control-sm" id="name"
                                        name="name" required>
                                    <span class="name-notice notice">
                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-sm" id="emai"
                                        name="email" required>
                                    <span class="email-notice">
                                        @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="address">Home Address</label>
                                    <input type="text" class="form-control form-control-sm" id="address"
                                        name="address" required>
                                    @error('address')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control form-control-sm" id="city"
                                        name="city" required>
                                    @error('city')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control form-control-sm" id="zip"
                                        name="zip" required>
                                    @error('zip')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control form-control-sm" id="phone"
                                        name="phone" required>
                                    <span class="phone-notice notice">
                                        @error('phone')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Proceed With Payment</button>
                        </form>


                    </div>
                </div>
            </div>

    </section>
</x-layout>
