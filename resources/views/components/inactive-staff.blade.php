<div class="card-body" id="profile-settings">
    <table>
        <thead>
            <th class="full-width-th" colspan="3">
                <a href="#" class="column-heading " data-column="id">ID <span class="sort-arrow"></span></a>
            </th>
            <th class="full-width-th" colspan="3">
                <a href="#" class="column-heading " data-column="name">Name <span class="sort-arrow"></span></a>
            </th>
        </thead>
        <tbody>
            <!-- Table body content here -->
            @foreach ($inactiveStaff as $staff)
                <tr>
                    <td colspan="3">
                        <a href="#" class="open-overlay" data-button-for="inactiveStaff"
                            data-route-id="{{ $staff->id }}"
                            data-user-role="{{ $userRole }}">{{ $staff->id }}</a>
                    </td>
                    <td colspan="3">{{ $staff->name }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>


<x-card-overlay>
</x-card-overlay>
