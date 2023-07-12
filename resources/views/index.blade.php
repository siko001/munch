<x-layout>

    {{-- Hero Section Component --}}
    <x-carousel>
    </x-carousel>




    <!-- offer section -->
    <section class="offer_section layout_padding-bottom">
        <div class="offer_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2> Deals Offerings</h2>
                </div>
                {{-- Deal As Component Data From IndexController --}}
                <x-deals :activeDeal="$activeDeal" :allDealsExcludingNow="$allDealsExcludingNow" :cartItem="$cartItem">
                </x-deals>

            </div>
    </section>
    <!-- end offer section -->



    <!-- food section -->
    {{-- Menu As Component Data From IndexController --}}
    <x-food :products="$products">

    </x-food>
    <div class="btn-box">
        <a href="/menu">
            View More
        </a>
    </div>
    </div>
    </section>
    <!-- end food section -->





    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container  ">
            <div class="heading_container heading_center">
                <h2>
                    Who Are We?
                </h2>
            </div>
            <x-about>
            </x-about>
            <br>
            <br>
            <br>
            <a href="/about">
                Read More
            </a>
        </div>
    </section>
    <!-- end about section -->




    <!-- book section -->
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Book A Table
                </h2>
            </div>
            {{-- Table Compoent That Acts Both for index and 1 of the pages --}}
            <x-form>
            </x-form>

        </div>
    </section>
    <!-- end book section -->



    <!-- client section -->
    <section class="client_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center psudo_white_primary mb_45">
                <h2>
                    What other Munchers say about us?
                </h2>
            </div>
            {{-- "Featured" comments As Component Data From IndexController --}}
            <x-comments :allcommentsfromusers="$allcommentsfromusers">
            </x-comments>
        </div>
    </section>
    <button id="backToTopButton" title="Back to Top">
        <h2>↑</h2>
    </button>
    <!-- end client section -->


</x-layout>
