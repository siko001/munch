<div class="card-body" id="profile-settings">
    <table id="upcomingRed">
        <thead>
            <th class="full-width-th" colspan="3">
                <a href="#" class="column-heading " data-column="id">ID <span class="sort-arrow"></span></a>
            </th>
            <th class="full-width-th" colspan="3">
                <a href="#" class="column-heading " data-column="date">Date <span class="sort-arrow"></span></a>
            </th>
            <th class="full-width-th" colspan="3">
                <a href="#" class="column-heading " data-column="name">Name <span class="sort-arrow"></span></a>
            </th>
            <th class="full-width-th" colspan="3">
                <a href="#" class="column-heading " data-column="status">Status <span
                        class="sort-arrow"></span></a>
            </th>

        </thead>
        <tbody>
            @foreach ($activeReservation as $res)
                <tr>
                    <td colspan="3"><a href="#" class="open-overlay" data-button-for="reservation"
                            data-route-id="{{ $res->id }}" data-user-role="{{ $userRole }}"
                            data-status="{{ $res->status }}">{{ $res->id }}</a></td>
                    <td colspan="3">{{ $res->date }}</td>
                    <td colspan="3">{{ $res->name }}</td>
                    <td colspan="3">{{ $res->status }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<x-card-overlay>
</x-card-overlay>
