<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Scan QR Code</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar_panitia')

  <div class="content-wrapper">
    <div class="content-header container-fluid">
      <h3>Scan QR Code Kehadiran</h3>

      <div id="reader" style="width:300px;"></div>
      <p id="result" class="mt-3 font-weight-bold"></p>
    </div>
  </div>

</div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function onScanSuccess(decodedText, decodedResult) {
    $.ajax({
      url: "{{ route('panitia.events.absen_qr') }}",
      method: "POST",
      data: { data: decodedText },
      success: function(response){
        if(response.status === 'success'){
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: response.message,
          }).then(() => {
            // Balik ke halaman event member
            window.location.href = '/panitia/event-member';
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: response.message
          });
        }
      },
      error: function(xhr){
        console.log(xhr.responseText);
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Gagal mengirim data.'
        });
      }
    });
  }

  function onScanFailure(error) {
    // optional: console.log(error);
  }

  let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

</body>
</html>
