<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link settings  {{ request()->is('restaurant/staff/active') ? 'active' : '' }}"
                    href="/restaurant/staff/active">Active Staff </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('restaurant/staff/inactive') ? 'active' : '' }}"
                    href="/restaurant/staff/inactive">Inactive Staff </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('restaurant/bookings/upcoming') ? 'active' : '' }}"
                    href="/restaurant/bookings/upcoming">Upcoming Reservations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('restaurant/bookings/past') ? 'active' : '' }}"
                    href="/restaurant/bookings/past">Past Reservations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link settings  {{ request()->is('restaurant/users/active') ? 'active' : '' }}"
                    href="/restaurant/users/active">Active Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('restaurant/users/inactive') ? 'active' : '' }}"
                    href="/restaurant/users/inactive">Inactive Users </a>
            </li>
        </ul>
    </div>
