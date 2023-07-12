<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link settings  {{ request()->is('staff-profile/settings') ? 'active' : '' }}"
                    href="/staff-profile/settings">Account settings</a>
            </li>
        </ul>
    </div>
    {{-- 



    <li class="nav-item">
                <a class="nav-link {{ request()->is('staff-profile/active-orders') ? 'active' : '' }}"
                    href="/staff-profile/active-orders">Active Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('staff-profile/past-orders') ? 'active' : '' }}"
                    href="/profile/past-orders">Past Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('staff-profile/reservations') ? 'active' : '' }}"
                    href="/profile/reservations">Upcoming Reservations</a>
            </li>


            @if (Auth::guard('staff')->user()->Role == 'Manager')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('staff-profile/reservations') ? 'active' : '' }}"
                        href="/profile/reservations">Past Reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('staff-profile/reservations') ? 'active' : '' }}"
                        href="/profile/reservations">Staff Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('staff-profile/reservations') ? 'active' : '' }}"
                        href="/profile/reservations">Registered Users</a>
                </li>
            @else
            @endif --}}
