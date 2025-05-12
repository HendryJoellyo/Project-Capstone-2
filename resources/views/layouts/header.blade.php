<header class="header-section">
        <div class="container">
            <div class="logo">
                <a href="./index.html">
                    <img src="img/logo.png" alt="">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.html">Home</a></li>
                        <li><a href="./about-us.html">About</a></li>
                        <li><a href="./schedule.html">Schedule</a></li>
                        <li><a href="./contact.html">Contacts</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </nav>
                <a href="{{ route('register') }}" class="primary-btn top-btn"><i class="fa fa-user"></i> Register</a>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>