<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tambah Event</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar_panitia')

  <div class="content-wrapper">
    <div class="content-header container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

      <h1>Tambah Event</h1>
      <br>

      <form action="{{ route('panitia.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama Event</label>
            <input type="text" name="nama_event" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Waktu</label>
            <input type="time" name="waktu" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Narasumber</label>
            <input type="text" name="narasumber" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Poster Kegiatan</label>
            <input type="file" name="poster" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label>Biaya Registrasi</label>
            <input type="number" name="biaya_registrasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jumlah Maksimal Peserta</label>
            <input type="number" name="jumlah_peserta" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buka Event</button>
    </form>
    </div>
  </div>

</div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>






