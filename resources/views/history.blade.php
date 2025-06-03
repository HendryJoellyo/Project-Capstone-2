<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>History</title>

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

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@include('layouts.header')

<div class="container mt-5">
  <h2>History Pendaftaran Event</h2>
  <hr>
  @forelse($history as $item)
  <div class="history-item mb-3 p-3 border rounded">
    <h5>{{ $item->event->nama_event }}</h5>
    <p>Tanggal: {{ \Carbon\Carbon::parse($item->event->tanggal)->format('d M Y') }}</p>

    <div class="d-flex justify-content-between align-items-center">
  <div>
    Status:
    @if($item->status_pembayaran == 'pending')
      <span class="text-warning">Pending</span>
    @elseif($item->status_pembayaran == 'proses')
      <span style="color:orange;">Sedang Diproses</span>
    @elseif($item->status_pembayaran == 'verified')
      <span class="text-success">Terverifikasi</span>
    @elseif($item->status_pembayaran == 'rejected')
      <span class="text-danger">Ditolak</span>
    @endif

    @if($item->status_pembayaran == 'verified')
      <p style="font-style: italic; font-size: small; color:rgb(184, 184, 184); font-weight: bold; margin-bottom: 0;">
        *Tunjukan QR-Code pada panitia saat menghadiri Event
      </p>
    @endif
  </div>

  @if($item->status_pembayaran == 'verified')
    <button class="btn btn-sm btn-primary"
      onclick="showQrCode('{{ $item->id_event_registrations }}')">
      <i class="fa fa-qrcode"></i> Lihat QR
    </button>
  @endif
</div>

  </div>
  @empty
  <p>Belum ada history event.</p>
  @endforelse
</div>

<!-- Js Plugins -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    updateHistoryNotif();
  });

  function showQrCode(registrationId) {
  let qrCanvas = document.createElement('canvas');
  let qr = new QRious({
    element: qrCanvas,
    value: registrationId,
    size: 200
  });

  Swal.fire({
    title: 'QR Code Peserta',
    html: qrCanvas,
    confirmButtonText: 'Tutup'
  });
}

</script>

</body>
</html>
