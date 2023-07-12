<section class="food_section layout_padding-bottom pt-5 mt-5">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Delights From Our Menu
            </h2>
        </div>

        <div class="filters-content">
            <div class="row grid">
                @foreach ($products as $product)
                    <a href="/menu1#{{ $product->id }}">
                        <div class="col-sm-6 col-lg-4 all {{ $product->category }}">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            {{ $product->name }}
                                        </h5>
                                        <p>
                                            {{ $product->description }}
                                        </p>
                                        <div class="options">
                                            <h6>
                                                {{ $product->price }}€
                                            </h6>
                                            <div class="group-together">
                                                {{ $product->category }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
