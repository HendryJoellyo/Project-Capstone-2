<header class="header-section">
    <div class="container">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
        </div>
        <div class="nav-menu">
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li class="active"><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about-us') }}">About</a></li>
                    <li><a href="{{ url('/schedule') }}">Schedule</a></li>
                    <li><a href="{{ url('/contact') }}">Contacts</a></li>

                    @guest
                        <!-- Kalau belum login -->
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endguest
                </ul>
            </nav>

            @guest
                <!-- Kalau belum login -->
                <a href="{{ route('login') }}" class="primary-btn top-btn"><i class="fa fa-user"></i> Login</a>
            @else
                <!-- Kalau sudah login -->
                <div class="dropdown" style="display: inline-block; margin-left: 15px;">
                    <button class="primary-btn top-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            @endguest
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
    
</header>
