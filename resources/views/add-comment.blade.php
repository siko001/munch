<x-layout>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <section class="offer_section layout_padding-bottom">
        <div class="offer_container">
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
                <h3 class="text-center jumbotron">Leave A comment For Order No. <strong>
                        {{ $order->order_number }}</strong></h3>
                <div class="justify-content-center  text-center">
                    <h5>Items</h5>
                    <br>
                    <ul style="list-style:none;">
                        @foreach ($orderDetails as $item)
                            <li style="position: relative;left:-27px;">
                                <p><strong>{{ $item->product_name }}</strong></p>
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                    <br>
                    <form action="/submit-comment/{{ $order->order_number }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Comment Title</label>
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <input style="width:50%" type="text" class="form-control mx-auto justify-content-center"
                                id="title" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating</label>
                            @error('rating')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="rating">
                                <input type="radio" id="star1" name="rating" value="5" required>
                                <label for="star1" title="1 star">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="4" required>
                                <label for="star2" title="2 stars">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3" required>
                                <label for="star3" title="3 stars">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="2" required>
                                <label for="star4" title="4 stars">&#9733;</label>
                                <input type="radio" id="star5" name="rating" value="1" required>
                                <label for="star5" title="5 stars">&#9733;</label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="description">Comment Description</label>
                            @error('description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <textarea style="width:60%;min-height:200px;max-height:200px" class="form-control mx-auto justify-content-center"
                                id="description" name="description" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </section>

</x-layout>
