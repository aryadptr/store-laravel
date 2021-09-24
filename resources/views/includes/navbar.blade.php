<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand brand-navbar">
            <img src="/images/logo.svg" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}"
                        class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Rewards</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}"
                            class="nav-link {{ request()->is('/register') ? 'active' : '' }}">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign In</a>
                    </li>
                @endguest
            </ul>
            @auth
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Storage::url(Auth::user()->photo) }}" alt=""
                                class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('dashboard-settings-account') }}">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block mt-2" href="{{ route('cart') }}">
                            @php
                                $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp

                            @if ($carts > 0)
                                <img src="/images/icon-cart-filled.svg" alt="" />
                                <div class="card-badge">{{ $carts }}</div>
                            @else
                                <img src="/images/icon-cart-empty.svg" alt="" />
                            @endif
                        </a>
                    </li>
                </ul>

                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Hi, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block" href="{{ route('cart') }}"> Cart </a>
                    </li>
                </ul>

            @endauth
        </div>
    </div>
</nav>
