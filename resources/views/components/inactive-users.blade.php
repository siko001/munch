<div class="card-body" id="profile-settings">
    <table id="1">
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
            @foreach ($inactiveUsers as $user)
                <tr>
                    <td colspan="3"><a href="#" class="open-overlay" data-button-for="inactiveUsers"
                            data-user-role="{{ $userRole }}"
                            data-route-id="{{ $user->id }}">{{ $user->id }}</a></td>
                    <td colspan="3">{{ $user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<x-card-overlay>
</x-card-overlay>
