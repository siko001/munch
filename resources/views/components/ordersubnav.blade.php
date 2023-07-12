<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link settings  {{ request()->is('orders/active') ? 'active' : '' }}"
                    href="/orders/active">Active Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('orders/past') ? 'active' : '' }}" href="/orders/past">Completed
                    Orders</a>
            </li>

        </ul>
    </div>
