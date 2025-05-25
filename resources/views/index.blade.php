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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   

    <meta name="csrf-token" content="{{ csrf_token() }}">


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
                       <h2>Kuliah Nggak Cuma Belajar<br /> Yuk Ikut Event Seru Bareng!</h2>   
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
                        <h2>About Event</h2>
                        <p>Jujur aja, waktu pertama kali kepikiran bikin event, kami sempat mikir bakal gampang. 
                            Tinggal sebar info, langsung rame, terus acara sukses besar. Tapi ternyata, 
                            bikin event itu nggak sesederhana itu. Dari cari ide, diskusi, cari sponsor, sampai ngurus peserta, 
                            semua butuh effort dan kerjasama tim. Nah, dari situ kami belajar, kalau hal seru itu bukan cuma soal 
                            hasil akhirnya, tapi juga proses seru di baliknya. Makanya event ini kami adain, biar jadi wadah buat 
                            mahasiswa kumpul bareng, kenalan sama teman baru, nambah ilmu, dan pastinya dapet pengalaman seru yang 
                            nggak bakal dilupain waktu kuliah.
                        </p>
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
                                                                <img src="{{ asset('storage/' . $event->poster) }}" 
                                                                    alt="{{ $event->nama_event }}" 
                                                                    style="cursor:pointer" 
                                                                    onclick="openModal(this.src)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="sc-text">
                                                                <h4>{{ $event->nama_event }}</h4>
                                                                <ul>
                                                                    <li><i class="fa fa-user"  style="color: #1d6ac1;"></i> {{ $event->narasumber }}</li>
                                                                    <li><i class="fa fa-calendar"  style="color: #1d6ac1;"></i> {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <ul class="sc-widget">
                                                                <li><i class="fa fa-clock-o"></i> {{ $event->waktu_mulai }} - {{ $event->waktu_selesai }}</li>
                                                                <li><i class="fa fa-map-marker"></i> {{ $event->lokasi }}</li>
                                                                <li><i class="fa fa-group"></i> {{ $event->jumlah_peserta }} orang</li>
                                                                <li  style="color:red; font-weight: bold;"><i class="fa fa-group"></i>
                                                                    @if ($event->slot_tersedia > 0)
                                                                        {{ $event->slot_tersedia }} slot
                                                                    @else
                                                                        <span style="color: red; font-weight: bold;">Slot Habis</span>
                                                                    @endif
                                                                </li>
                                                                <li style="color: green; font-weight: bold;"><i class="fa fa-money" style="color: green;"></i> {{ $event->biaya_registrasi }} IDR</li>
                                                              @if ($event->slot_tersedia > 0)
                                                                @if(Auth::check() && Auth::user()->id_roles == 13)
                                                                    <li>
                                                                        <input type="hidden" name="event_id" value="{{ $event->id_events }}">
                                                                        <button onclick="daftarEvent(event, {{ $event->id_events }})" class="daftar">Daftar</button>
                                                                    </li>
                                                                    <li>
                                                                        @php
                                                                            $status = $registrations[$event->id_events] ?? null;
                                                                        @endphp

                                                                        @if($status == 'pending' || $status == 'settlement')
                                                                            <button onclick="triggerUpload({{ $event->id_events }})" class="BuktiBayar">
                                                                                Upload Bukti Bayar
                                                                            </button>
                                                                        @else
                                                                            <button class="BuktiBayar" disabled
                                                                                style="background:#ccc; cursor:not-allowed; opacity:0.6;">
                                                                                Upload Bukti Bayar
                                                                            </button>
                                                                        @endif
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <button class="daftar" onclick="showLoginAlert()">Daftar</button>
                                                                    </li>
                                                                @endif
                                                            @else
                                                                <li>
                                                                    <button class="daftar" disabled style="background:#ccc; cursor:not-allowed; opacity:0.6;">
                                                                        Slot Habis
                                                                    </button>
                                                                </li>
                                                            @endif

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
<form id="uploadBuktiForm" action="{{ route('upload.bukti') }}" method="POST" enctype="multipart/form-data" style="display:none">
    @csrf
    <input type="hidden" name="event_id" id="upload_event_id">
    <input type="file" name="bukti_pembayaran" id="upload_file_input" accept="image/*" onchange="document.getElementById('uploadBuktiForm').submit()">
</form>

    <!-- Modal untuk menampilkan gambar full -->
<div id="imageModal" class="image-modal" onclick="closeModal()">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<div id="loginModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
    <div style="background:#fff; padding:20px; margin:100px auto; width:300px; border-radius:8px; text-align:center;">
        <h4>Silakan login atau register dulu</h4>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        
        <br><br>
        <button onclick="closeLoginPopup()" class="btn btn-danger">Tutup</button>
    </div>
</div>


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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <script>
    const getSnapTokenUrl = "{{ route('get-snap-token') }}";
    </script>
    <script>
        function showLoginAlert() {
        Swal.fire({
            title: 'Pendaftaran ditolak',
            text: 'Silakan login atau register sebagai member untuk mendaftar event ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Register',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = "{{ route('register') }}";
            }
        });
    }
    </script>




</body>

</html>