<div class="card-body" id="profile-settings">
    <select id="table-select" class="text-center" onchange="showTable(this.value)">
        <option value="completed" @if ($selectedOption === 'completed') selected @endif>Completed</option>
        <option value="cancelled-restaurant" @if ($selectedOption === 'cancelled-restaurant') selected @endif>Cancelled by Restaurant
        </option>
        <option value="cancelled-guest" @if ($selectedOption === 'cancelled-guest') selected @endif>Cancelled by Guest</option>
        <option value="no-shows" @if ($selectedOption === 'no-shows') selected @endif>No Shows</option>
    </select>

    <table class="table" id="table-completed">

        <thead>
            <tr>
                <td colspan="12" class="section-heading">
                    <h5><strong class="text-success">Completed</strong></h5>
                </td>
            </tr>
            <tr>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="id">ID <span class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="name">Name <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="date">Date <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="status">Status <span
                            class="sort-arrow"></span></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inactiveReservations as $reservation)
                @if ($reservation->status == 'Completed')
                    <tr>
                        <td colspan="3">{{ $reservation->id }}</td>
                        <td colspan="3">{{ $reservation->name }}</td>
                        <td colspan="3">{{ $reservation->date }}</td>
                        <td colspan="3">{{ $reservation->status }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <table class="table" id="table-cancelled-restaurant" style="display: none;">
        <thead>
            <tr>
                <td colspan="12" class="section-heading">
                    <h5><strong class="text-warning text-center">Cancelled by Restaurant</strong></h5>
                </td>
            </tr>
            <tr>
                <th class="full-width-th hello" colspan="3">
                    <a href="#" class="column-heading" data-column="id">ID <span class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="name">Name <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="date">Date <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="status">Status <span
                            class="sort-arrow"></span></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inactiveReservations as $reservation)
                @if ($reservation->status == 'Cancelled by Restaurant')
                    <tr>
                        <td colspan="3">{{ $reservation->id }}</td>
                        <td colspan="3">{{ $reservation->name }}</td>
                        <td colspan="3">{{ $reservation->date }}</td>
                        <td colspan="3">{{ $reservation->status }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <table class="table" id="table-cancelled-guest" style="display: none;">
        <thead>
            <tr>
                <td colspan="12" class="section-heading">
                    <h5><strong class="text-warning">Cancelled by Guest</strong></h5>
                </td>
            </tr>
            <tr>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="id">ID <span class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="name">Name <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="date">Date <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="status">Status <span
                            class="sort-arrow"></span></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inactiveReservations as $reservation)
                @if ($reservation->status == 'Cancelled by Guest')
                    <tr>
                        <td colspan="3">{{ $reservation->id }}</td>
                        <td colspan="3">{{ $reservation->name }}</td>
                        <td colspan="3">{{ $reservation->date }}</td>
                        <td colspan="3">{{ $reservation->status }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <table class="table" id="table-no-shows" style="display: none;">
        <thead>
            <tr>
                <td colspan="12" class="section-heading">
                    <h5><strong class="text-warning">No Shows</strong></h5>
                </td>
            </tr>
            <tr>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="id">ID <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="name">Name <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="date">Date <span
                            class="sort-arrow"></span></a>
                </th>
                <th class="full-width-th" colspan="3">
                    <a href="#" class="column-heading" data-column="status">Status <span
                            class="sort-arrow"></span></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inactiveReservations as $reservation)
                @if ($reservation->status == 'No Show')
                    <tr>
                        <td colspan="3">{{ $reservation->id }}</td>
                        <td colspan="3">{{ $reservation->name }}</td>
                        <td colspan="3">{{ $reservation->date }}</td>
                        <td colspan="3">{{ $reservation->status }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

</div>
