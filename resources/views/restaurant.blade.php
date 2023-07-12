<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center mb-5">
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


            <x-restaurantNavBar>
            </x-restaurantNavBar>
            @switch(request()->path())
                @case('restaurant/staff/active')
                    <x-active-staff :activeStaff="$activeStaff" :userRole="$userRole"></x-active-staff>
                @break

                @case('restaurant/staff/inactive')
                    <x-inactive-staff :inactiveStaff="$inactiveStaff" :userRole="$userRole"></x-inactive-staff>
                @break

                @case('restaurant/bookings/upcoming')
                    <x-upcoming-reservations :activeReservation="$activeReservation" :userRole="$userRole"></x-upcoming-reservations>
                @break

                @case('restaurant/bookings/past')
                    <x-past-reservations :inactiveReservations="$inactiveReservations" :userRole="$userRole" :selectedOption="$selectedOption"></x-past-reservations>
                @break

                @case('restaurant/users/active')
                    <x-active-users :activeUsers="$activeUsers" :userRole="$userRole"></x-active-users>
                @break

                @case('restaurant/users/inactive')
                    <x-inactive-users :inactiveUsers="$inactiveUsers" :userRole="$userRole"></x-inactive-users>
                @break

                @default
            @endswitch

        </div>
    </section>
</x-layout>
