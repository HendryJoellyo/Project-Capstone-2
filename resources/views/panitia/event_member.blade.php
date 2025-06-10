<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Event Member</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar_panitia')

  <div class="content-wrapper">
    <div class="content-header container-fluid">
      <h3>Event Member</h3>
      <form method="GET" action="">
        <div class="form-group">
          <label>Pilih Event:</label>
          <select class="form-control" name="id_event">
            <option value="">-- Pilih Event --</option>
            @foreach($events as $event)
              <option value="{{ $event->id_events}}">{{ $event->nama_event }} - {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</option>
            @endforeach
          </select>
        </div>
        <a href="{{ route('panitia.events.scan_qr') }}" class="btn btn-primary mt-4">Scan QR Code</a>
      </form>

      <!-- 📊 Dashboard Total Hadir -->
      <div id="summaryDashboard" class="mt-4"></div>

      <div id="memberList" class="mt-4"></div>
    </div>
  </div>

</div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

<script>
  let currentEventId = null;

  $(document).ready(function(){
    const savedEventId = localStorage.getItem('lastEventId');
    if(savedEventId){
      $('select[name="id_event"]').val(savedEventId).trigger('change');
    }

    $('select[name="id_event"]').on('change', function(){
      currentEventId = $(this).val();
      console.log("Event terpilih: " + currentEventId);
      localStorage.setItem('lastEventId', currentEventId);
      loadMember(currentEventId);
    });
  });

  function loadMember(eventId) {
    console.log("Load member untuk eventId: " + eventId);
    if(eventId){
      $.get('/panitia/event-member/' + eventId + '/list?ts=' + new Date().getTime(), function(data){
        console.log(data);
        const hadirData = data.filter(item => item.status_kehadiran === 'hadir');
        const totalHadir = hadirData.length;

        // 📊 Summary dashboard
        let summaryHtml = `
          <div class="alert alert-info" role="alert">
            📊 Total Peserta Hadir: <strong>${totalHadir}</strong> Orang
          </div>
        `;
        $('#summaryDashboard').html(summaryHtml);

        // 📋 Tabel peserta hadir
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        let html = '<table class="table table-bordered"><thead><tr><th>Nama</th><th>Upload Sertifikat</th></tr></thead><tbody>';
        
        if(hadirData.length > 0){
          hadirData.forEach(item => {
            html += `<tr>
                      <td>${item.user ? item.user.nama : 'Unknown'}</td>
                      <td>`;

            if(item.certificate) {
              // Sertifikat sudah ada — tampilkan link download
              const fileName = item.certificate.file_path.split('/').pop();
              html += `<a href="/${item.certificate.file_path}" target="_blank">
                         <i class="fas fa-file-download"></i> ${fileName}
                       </a>`;
            } else {
              // Belum ada — tampilkan form upload
              html += `<form action="/panitia/event-member/upload-sertifikat/${item.id_event_registrations}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="file" name="sertifikat" accept="application/pdf,image/*" required>
                        <button type="submit" class="btn btn-sm btn-success mt-1">Upload</button>
                      </form>`;
            }

            html += `</td></tr>`;
          });
        } else {
          html += `<tr><td colspan="2">Belum ada peserta yang hadir.</td></tr>`;
        }

        html += '</tbody></table>';
        $('#memberList').html(html);
      });
    } else {
      $('#memberList').empty();
      $('#summaryDashboard').empty();
    }
  }
</script>

@if(session('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}'
  });
</script>
@endif

</body>
</html>
