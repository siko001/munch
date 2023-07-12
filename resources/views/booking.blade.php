<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    {{ Session::get('success') }}
                </div>
            @elseif (Session::has('failure'))
                <div class="alert alert-danger text-center">
                    {{ Session::get('failure') }}
                </div>
            @endif
            <div class="heading_container">
                <h2>
                    Book A Table
                </h2>
            </div>

            <x-form>
            </x-form>

        </div>
    </section>
</x-layout>
