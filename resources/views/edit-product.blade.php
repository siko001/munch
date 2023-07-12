<x-layout>
    <section class="food_section layout_padding-bottom pt-5 mt-5">
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
            <div class="heading_container heading_center mb-3">
                <h3> You Are Editing {{ $product->name }}</h3>
            </div>

            <div class="row">

                <div class="col-lg-6">

                    <div class="filters-content d-flex justify-content-center align-items-center">
                        <div class="all {{ $product->category }}">
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
                                            @if ($product->avaliable)
                                                <form action="/out-of-stock/{{ $product->id }}" method="POST">
                                                    <div class="group-together">
                                                        <div class="circle green"></div>

                                                        @csrf
                                                        @method('PUT')
                                                        <button>Mark item out of Stock</button>
                                                    </div>
                                                </form>
                                            @else
                                                <form action="/back-in-stock/{{ $product->id }}" method="POST">
                                                    <div class="group-together">
                                                        <div class="circle red"></div>
                                                        @csrf
                                                        @method('PUT')
                                                        <button>Mark item Back in Stock</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="filters-content mx-auto mt-5">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-12">
                                <form method="POST" action="/update-product/{{ $product->id }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="{{ $product->name }}"
                                            name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" placeholder="{{ $product->price }}"
                                            name="price">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" style="max-height:115px;min-height:114px;" rows="4"
                                            placeholder="{{ $product->description }}" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="category" id="category-select"
                                            data-product-category="{{ $product->category }}">
                                            <option value="{{ $product->category }}" selected>{{ $product->category }}
                                            </option>
                                            <!-- Add the remaining category options below -->
                                            <option value="Category2">Category 2</option>
                                            <option value="Category3">Category 3</option>
                                            <option value="Category4">Category 4</option>
                                            <option value="Category5">Category 5</option>
                                        </select>



                                        <a href="/delete-product/{{ $product->id }}" class="btn btn-danger mx-5">
                                            Delete Item
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
</x-layout>
