<x-layout>

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
                <h3 class="text-center jumbotron">Change your Profile Picture here</h3>
                <div class="row mx-auto justify-content-center">
                    <img class="photo-to-change" id="imagePreview" src="{{ $profilePicture }}" alt="profile_picture">
                </div>
                <div class="row mx-auto justify-content-center">
                    <form action="/change-picture/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <br>
                        <div class="mt-5">
                            <label for="image" class="custom-file-button">
                                Upload
                                <input type="file" name="image" id="image" required>
                            </label>
                        </div>
                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                </div>
                <div class="row mx-auto justify-content-center mt-5">
                    <button class="btn btn-primary">Change Picture</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-layout>
