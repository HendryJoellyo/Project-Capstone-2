<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - Bantuan Pendaftaran Event</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Hapus properti flexbox dari body */
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0; /* Hapus padding-top jika sudah diatur di header */
            background-color: #f4f7f6;
            color: #333;
            /* HAPUS PROPERTI INI:
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            */
        }

        /* Container untuk konten utama (selain header) */
        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px); /* Sesuaikan 80px dengan perkiraan tinggi header Anda */
            width: 100%;
            padding: 20px 0; /* Tambahkan sedikit padding atas/bawah */
            box-sizing: border-box; /* Agar padding tidak menambah lebar */
        }

        .contact-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 90%;
            text-align: center;
            /* margin: 50px auto; (Jika Anda ingin margin tetap) */
        }

        .contact-container h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 2.5em;
            font-weight: 600;
        }

        .contact-container p {
            font-size: 1.1em;
            margin-bottom: 20px;
            color: #555;
        }

        .contact-info {
            margin-top: 30px;
            padding: 20px;
            background-color: #e8f5e9; /* Warna hijau muda */
            border-left: 5px solid #4CAF50; /* Garis hijau */
            border-radius: 8px;
            display: inline-block; /* Agar background hanya selebar konten */
        }

        .contact-info p {
            margin: 10px 0;
            font-size: 1.1em;
            color: #333;
        }

        .contact-info strong {
            color: #1a4d2e; /* Warna hijau lebih gelap */
        }

        .contact-info a {
            color: #1976D2; /* Biru */
            text-decoration: none;
            font-weight: 600;
        }

        .contact-info a:hover {
            text-decoration: underline;
            color: #1565C0;
        }

        .icon {
            margin-right: 10px;
            vertical-align: middle;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contact-container {
                padding: 25px;
            }
            .contact-container h1 {
                font-size: 2em;
            }
            .contact-container p, .contact-info p {
                font-size: 1em;
            }
            .content-wrapper {
                 min-height: calc(100vh - 60px); /* Sesuaikan tinggi header untuk mobile */
            }
        }
    </style>
</head>
<body>
    @include('layouts.header') {{-- Header Anda tetap di sini --}}

    {{-- Bungkus konten kontak dalam div baru --}}
    <div class="content-wrapper">
        <div class="contact-container">
            <h1>Butuh Bantuan? Hubungi Kami!</h1>
            <p>Jika Anda mengalami kendala dalam proses pendaftaran event atau memiliki pertanyaan lainnya, jangan ragu untuk menghubungi tim dukungan kami. Kami siap membantu Anda!</p>

            <div class="contact-info">
                <p><img src="https://img.icons8.com/ios-filled/24/4CAF50/new-post.png" alt="Email Icon" class="icon"><strong>Email Dukungan:</strong></p>
                <p><a href='#'>admin@gmail.com</a></p>
                <p><a href='#'>panitia@gmail.com</a></p>
                <p>Kami akan berusaha membalas email Anda secepatnya dalam waktu 1x24 jam kerja.</p>
            </div>

            <p style="margin-top: 30px;">Terima kasih atas kesabaran Anda!</p>
        </div>
    </div>
</body>
</html>