<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link settings  {{ request()->is('profile/settings') ? 'active' : '' }}"
                    href="/profile/settings">Account settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/active-orders/*') ? 'active' : '' }}"
                    href="/profile/active-orders/{{ Auth::user()->id }}">Active Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/past-orders/*') ? 'active' : '' }}"
                    href="/profile/past-orders/{{ Auth::user()->id }}">Past Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/reservations') ? 'active' : '' }}"
                    href="/profile/reservations">Reservations</a>
            </li>
        </ul>
    </div>
