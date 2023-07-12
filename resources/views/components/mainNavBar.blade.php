<nav class="navbar navbar-expand-lg custom_nav-container ">
    <a class="navbar-brand" href="/">
        <span>
            Munch Munch
        </span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  mx-auto ">
            <li class="nav-item ">
                @if (Auth::guard('staff')->check())
                    <a class="nav-link {{ request()->is('add-product') ? 'active' : '' }}" href="/add-product">Add
                        Product
                        <span class="sr-only"></span></a>
                @else
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home
                        <span class="sr-only"></span></a>
                @endif
            </li>
            <li class="nav-item">
                @if (Auth::guard('staff')->check())
                    <a class="nav-link {{ request()->is('menu') || request()->is('edit-menu/*') ? 'active' : '' }}"
                        href="/menu">Edit Menu
                        <span class="sr-only"></span></a>
                @else
                    <a class="nav-link {{ request()->is('menu1') ? 'active' : '' }}" href="/menu1">Menu
                        <span class="sr-only"></span></a>
                @endif

            </li>
            <li class="nav-item">
                @if (Auth::guard('staff')->check())
                    <a class="nav-link {{ request()->is('orders') || request()->is('orders/active') || request()->is('orders/past') ? 'active' : '' }}"
                        href="/orders/active">orders
                        <span class="sr-only"></span></a>
                @else
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">about
                        <span class="sr-only"></span></a>
                @endif

            </li>
            <li class="nav-item">
                @if (Auth::guard('staff')->check())
                    <a class="nav-link {{ request()->is('restaurant/staff/active') || request()->is('restaurant/staff/inactive') || request()->is('restaurant/bookings/upcoming') || request()->is('restaurant/bookings/past') || request()->is('restaurant/users/active') || request()->is('restaurant/users/inactive') ? 'active' : '' }}"
                        href="/restaurant/staff/active">Manage Restaurant
                        <span class="sr-only"></span></a>
                @else
                    <a class="nav-link {{ request()->is('book-table') ? 'active' : '' }}" href="/book-table">Book
                        Table
                        <span class="sr-only"></span></a>
                @endif
            </li>

        </ul>
        <div class="user_option ">
            <a href="/profile"
                class="user_link link nav-link {{ request()->is('profile') || request()->is('login') || request()->is('register') || request()->is('login-staff') || request()->is('register-staff') || request()->is('profile/settings') || request()->is('profile/active-orders/*') || request()->is('profile/past-orders/*') || request()->is('profile/reservations') || request()->is('profile/change-password') || request()->is('staff-profile/settings') ? 'active' : '' }}">
                <i id="mela" class="fa fa-user"></i>
            </a>
            @if (Auth::guard('staff')->user())
            @else
                <a class="cart_link link fa nav-link {{ request()->is('cart') ? 'active' : '' }}" href="/cart">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;"
                        xml:space="preserve">
                        <g>
                            <g>
                                <path
                                    d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                            </g>
                        </g>
                        <g>
                            <g>

                                <path
                                    d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                            </g>
                        </g>
                    </svg>

                </a>
                @if (Cart::count() > 0)
                    <span class="red-dot">
                        <p class="cartTotal">{{ Cart::count() }}</p>
                    </span>
                @endif
            @endif

            @if (Auth::check())
                <a href="/logout" class="order_online"> Logout</a>
            @elseif(Auth::guard('staff')->check())
                <a href="/logout-staff" class="order_online">Logout*</a>
            @else
                <a href="/profile" class="order_online">Login</a>
            @endif
            </a>
            @if (Auth::user())
                <a href="/change-profile-picture/{{ $user->id }}">
                    <div class="profile-picture">
                        <!-- User profile picture image -->
                        <img src="{{ $profilePicture }}" alt="Profile Picture" class="profile-picture__image">
                    </div>
                </a>
            @endif
        </div>
    </div>
</nav>
