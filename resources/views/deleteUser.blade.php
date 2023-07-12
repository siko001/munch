<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center mb-5">
                <h3>
                    You're About To Delete {{ $user->name }}'s Profile Account
                </h3>
                <br>
                <h4 class="btn btn-warning btn-lg mt-5 mb-5" style="width:400px;">There Is No Going Back</h4>

                <a href="/delete/useracc/{{ $user->id }}" class="btn btn-danger btn-lg mt-5"
                    style="width:200px;">Delete Account!</a>
            </div>
        </div>
    </section>
</x-layout>
