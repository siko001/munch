<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container text-center">
                <h2 style="margin: 0 auto;">Profile</h2>
            </div>

            <x-subnav>
            </x-subnav>

            <div class="card-body" id="profile-settings">

                <table>
                    <thead>
                        <th class="noUnderline green head">Upcoming Reservations</th>
                    </thead>
                </table>

                <table class="mt-5 mb-5">
                    <thead>
                        <th class="full-width-th" colspan="3">
                            <a href="#" class="column-heading " data-column="id">ID <span
                                    class="sort-arrow"></span></a>
                        </th>
                        <th class="full-width-th" colspan="3">
                            <a href="#" class="column-heading " data-column="date">Date <span
                                    class="sort-arrow"></span></a>
                        </th>
                        <th class="full-width-th" colspan="3">
                            <a href="#" class="column-heading " data-column="staus">Status <span
                                    class="sort-arrow"></span></a>
                        </th>
                    </thead>


                    <tbody>
                        <!-- Table body content here -->
                        @foreach ($userUpcomingReservations as $reservation)
                            <tr>
                                <td colspan="3">
                                    <a href="#" data-user-role="user" class="open-overlay"
                                        data-button-for="activeReservation"
                                        data-route-id="{{ $reservation->id }}">{{ $reservation->id }}</a>
                                </td>
                                <td colspan="3">{{ $reservation->date }}</td>
                                <td> <strong
                                        class="{{ $reservation->status == 'Confirmed' ? 'green' : '' }}">{{ $reservation->status }}</strong>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <span class="underline between mb-5"></span>

                <table class="mt-5">
                    <thead class="mb-5">
                        <th class="noUnderline green head">Past Reservations</th>
                    </thead>
                </table>

                <table class="mt-5">
                    <thead>
                        <th class="full-width-th" colspan="3">
                            <a href="#" class="column-heading " data-column="id">ID <span
                                    class="sort-arrow"></span></a>
                        </th>
                        <th class="full-width-th" colspan="3">
                            <a href="#" class="column-heading " data-column="date">Date <span
                                    class="sort-arrow"></span></a>
                        </th>
                        <th class="full-width-th" colspan="3">
                            <a href="#" class="column-heading " data-column="status">Status <span
                                    class="sort-arrow"></span></a>
                        </th>
                    </thead>

                    <tbody>
                        @foreach ($userPastReservations as $reservation)
                            <tr>
                                <td colspan="3">
                                    <a href="#" class="open-overlay" data-button-for="pastReservation"
                                        data-route-id="{{ $reservation->id }}">{{ $reservation->id }}</a>
                                </td>
                                <td colspan="3">{{ $reservation->date }}</td>
                                <td colspan="3">
                                    <strong
                                        class="{{ $reservation->status == 'Cancelled by Restaurant' || $reservation->status == 'Cancelled by Guest' ? 'red' : '' }}">
                                        {{ $reservation->status }}
                                    </strong>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </section>

</x-layout>


<x-cardOverlay>
</x-cardOverlay>
