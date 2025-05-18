<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Manup Template">
    <meta name="keywords" content="Manup, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">


    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

    <!-- Header Section Begin -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section set-bg" data-setbg="img/hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-text">
                        <span>5 to 9 may 2019, mardavall hotel, New York</span>
                        <h2>Change Your Mind<br /> To Become Sucess</h2>
                        <a href="#" class="primary-btn">Buy Ticket</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="img/hero-right.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Home About Section Begin -->
    <section class="home-about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ha-pic">
                        <img src="img/h-about.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ha-text">
                        <h2>About Conference</h2>
                        <p>When I first got into the online advertising business, I was looking for the magical
                            combination that would put my website into the top search engine rankings, catapult me to
                            the forefront of the minds or individuals looking to buy my product, and generally make me
                            rich beyond my wildest dreams! After succeeding in the business for this long, I’m able to
                            look back on my old self with this kind of thinking and shake my head.</p>
                        <ul>
                            <li><span class="icon_check"></span> Write On Your Business Card</li>
                            <li><span class="icon_check"></span> Advertising Outdoors</li>
                            <li><span class="icon_check"></span> Effective Advertising Pointers</li>
                            <li><span class="icon_check"></span> Kook 2 Directory Add Url Free</li>
                        </ul>
                        <a href="#" class="ha-btn">Discover Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home About Section End -->

    <!-- Schedule Section Begin -->
    <section class="schedule-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Our Schedule This Week</h2>
                        <p>Do not miss anything topic about the event</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="schedule-tab">
                        <div class="tab-scroll-wrapper">
                            <ul class="nav nav-tabs" role="tablist">
                                @php
                                    $dayIndex = 1;
                                @endphp
                                @foreach($eventsByDate as $date => $events)
                                    <li class="nav-item">
                                        <a 
                                            class="nav-link @if($loop->first) active @endif" 
                                            data-toggle="tab" 
                                            href="#tabs-{{ $dayIndex }}" 
                                            role="tab"
                                        >
                                            <h5>Day {{ $dayIndex }}</h5>
                                            <p>{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</p>
                                        </a>
                                    </li>
                                    @php $dayIndex++; @endphp
                                @endforeach
                            </ul><!-- Tab panes -->

                            <div class="tab-content">
                                @php $dayIndex = 1; @endphp
                                @foreach($eventsByDate as $date => $events)
                                    <div class="tab-pane @if($loop->first) active @endif" id="tabs-{{ $dayIndex }}" role="tabpanel">
                                        @foreach ($events as $event)
                                            <div class="st-content">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="sc-pic">
                                                                <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->nama_event }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="sc-text">
                                                                <h4>{{ $event->nama_event }}</h4>
                                                                <ul>
                                                                    <li><i class="fa fa-user"></i> {{ $event->narasumber }}</li>
                                                                    <li><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <ul class="sc-widget">
                                                                <li><i class="fa fa-clock-o"></i> {{ $event->waktu_mulai }} - {{ $event->waktu_selesai }}</li>
                                                                <li><i class="fa fa-map-marker"></i> {{ $event->lokasi }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @php $dayIndex++; @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
    <!-- Schedule Section End -->

    <!-- Footer Section Begin -->
    @include('layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>