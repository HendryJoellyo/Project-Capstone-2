<header class="header-section">
    <div class="container">
        <div class="logo">
            <!-- <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a> -->
        </div>
        <div class="nav-menu">
            <nav class="mainmenu mobile-menu">
               <ul>
    <li class="{{ Route::currentRouteName() == 'index' ? 'active' : '' }}"><a href="{{ url('/home') }}">Home</a></li>
    <li class="{{ Route::currentRouteName() == 'history' ? 'active' : '' }}">
        <a href="{{ route('history') }}">
            History
            @if($notificationCount > 0)
                <span  id="historyNotif" class="badge-notif">{{ $notificationCount }}</span>
            @endif
        </a>
    </li>
    <li class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}"><a href="{{ url('/contact') }}">Contact</a></li>
    @guest
        <li><a href="{{ route('register') }}">Register</a></li>
    @endguest
</ul>

            </nav>

            @guest
                <!-- Kalau belum login -->

                <a href="{{ route('login') }}" class="primary-btn top-btn"><i class="fa fa-user"></i> Login</a>
            @else
                @if (Auth::user()->role && Auth::user()->role->nama_role === 'Member')
                    <!-- Kalau yang login itu Member -->
                    <div class="dropdown" style="display: inline-block; margin-left: 15px;">
                        <button class="primary-btn top-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-user"></i> {{ Auth::user()->nama }}
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Kalau login tapi bukan Member -->
                    <a href="{{ route('register') }}" class="primary-btn top-btn">Register</a>
                    <a href="{{ route('login') }}" class="primary-btn top-btn"><i class="fa fa-user"></i> Login</a>

                @endif
            @endguest

        </div>
        <div id="mobile-menu-wrap"></div>
    </div>

</header>
