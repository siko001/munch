<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>Add A New Munchy Item</h2>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="/add-new-product" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" placeholder="Product Name" name="name"
                                    required minlength="3" maxlength="30" />
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                @error('price')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" id="myInput" step="0.01"
                                    placeholder="Price" name="price" required min="0.01" max="999999.99" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                @error('description')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <textarea style="min-height:100px; max-height:101px;" class="form-control" placeholder="Description" name="description"
                                    required minlength="10" maxlength="120" oninput="updateCharCount(this)"></textarea><span style="position: relative; top: -50px; left: 80%;"
                                    id="charCount">120/120</span>

                            </div>
                            <div class="form-group">
                                <label for="pax">What Category</label>
                                @error('category')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <select class="form-control nice-select wide" name="category">
                                    <option value="" disabled selected>Choose category</option>
                                    <option value="pizza">Pizza</option>
                                    <option value="burger">Burger</option>
                                    <option value="pasta">Pasta</option>
                                    <option value="salad">Salad</option>
                                    <option value="side">Side</option>

                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Upload Product</button>
                            </div>
                            @csrf

                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="map_container">
                        @csrf
                        <div style="max-width:300px:max-heigth:300px;object-fit:cover;" id="imagePreview"
                            class="mx-auto "></div>
                        <label for="image" class="custom-file-button mt-5 ">
                            Upload Product Photo
                            <input class="mt-5 " type="file" name="image" id="image"
                                onchange="previewImage(event)" required>
                        </label>

                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</x-layout>
