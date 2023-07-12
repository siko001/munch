<div class="row">
    <div class="col-md-6">
        <div class="form_container">
            <form action="/reserve-table" method="POST">
                @csrf
                <div>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" placeholder="Your Full Name" name="name" />

                </div>
                <div>
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone" />

                </div>
                <div>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <input type="email" class="form-control" placeholder="Your Email" name="email" />

                </div>
                <div>
                    @error('people')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <select class="form-control nice-select wide" name="people">
                        <option value="" disabled selected>
                            How many persons?
                        </option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        <option value="" disabled>
                            9+ people? please call
                        </option>
                    </select>
                </div>

                <div>

                    <label>Seating Area</label>
                    <br> @error('seating_area')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <select class="form-control" name="seating_area">
                        <option selected value="random">Random</option>
                        <option value="indoor">Indoor</option>
                        <option value="outdoor">Outdoor</option>
                    </select>
                </div>
                <br>
                <br>
                <div>
                    <textarea class="form-control" placeholder="Special Requests" name="requests"
                        style="max-height:200px;min-height:199px;"></textarea>
                </div>



        </div>
    </div>
    <div class="col-md-6 text-center mt-4">
        <h2 class="mb-2">Location</h2>
        <div class="map_container mt-3" style="max-height: 335px;">
            <div id="googleMap"></div>
        </div>
        <div class="mt-4 mb-4">
            @error('date')
                <div class="error">{{ $message }}</div>
            @enderror
            <input type="date" class="form-control" name="date">
        </div>
        <div class="mb-3">
            @error('time')
                <div class="error">{{ $message }}</div>
            @enderror
            Time
            <input type="time" id="time" name="time" min="13:30" max="21:30" required><br>
        </div>
        <div class="form_container">
            <div class="btn_box">
                <button>Book Now</button>
            </div>
        </div>
        </form>
    </div>
</div>
