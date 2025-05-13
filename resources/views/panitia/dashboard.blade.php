<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Event</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar_panitia')

  <div class="content-wrapper">
    <div class="content-header container-fluid">
      <h1>Data Event</h1>
       <a href="{{ route('panitia.events.create') }}" class="btn btn-primary mb-3">Tambah Event</a>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

    
      <!-- Table daftar event -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Lokasi</th>
            <th>Narasumber</th>
            <th>Poster</th>
            <th>Biaya</th>
            <th>Max Peserta</th>
          </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $event->nama_event }}</td>
            <td>{{ $event->tanggal }}</td>
            <td>{{ $event->waktu }}</td>
            <td>{{ $event->lokasi }}</td>
            <td>{{ $event->narasumber }}</td>
            <td><img src="{{ asset('storage/' . $event->poster) }}" width="120"></td>
            <td>Rp {{ number_format($event->biaya_registrasi) }}</td>
            <td>{{ $event->jumlah_peserta }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>

    </div>
  </div>

</div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
