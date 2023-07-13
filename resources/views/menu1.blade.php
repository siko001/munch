<x-layout>
    <section class="food_section layout_padding-bottom pt-5 mt-5">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    @if (Auth::guard('staff')->user())
                        Edit The Menu
                    @else
                        Our Menu
                    @endif
                </h2>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success text-center mt-5">
                    {{ Session::get('success') }}
                </div>
            @elseif (Session::has('failure'))
                <div class="alert alert-danger text-center mt-5">
                    {{ Session::get('failure') }}
                </div>
            @endif
            <ul class="filters_menu">

                <li class="active" data-filter="*">All</li>
                <li data-filter=".burger">Burger</li>
                <li data-filter=".pizza">Pizza</li>
                <li data-filter=".pasta">Pasta</li>
                <li data-filter=".salad">Salads</li>
                <li data-filter=".side">Sides</li>
            </ul>
            <div class="filters-content">
                <div class="row grid" id="menuContainer" style="height: 5100px;">
                    <button id="backToTopButton" title="Back to Top">
                        <h2>↑</h2>
                    </button>
                </div>
            </div>

        </div>
    </section>
</x-layout>
