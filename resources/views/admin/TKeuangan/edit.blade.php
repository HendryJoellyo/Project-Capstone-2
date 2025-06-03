<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Data Tim Keuangan</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar')

  <div class="content-wrapper">
    <div class="content-header container-fluid">
      <h1>Edit Data Tim Keuangan</h1>

      <form action="{{ route('admin.keuangans.update', ['keuangans' => $keuangan->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" value="{{ $keuangan->nama }}" required>
        </div>
        <div class="form-group">
          <label>Nomor HP</label>
          <input type="text" name="nomor_hp" class="form-control" value="{{ $keuangan->nomor_hp }}" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="{{ $keuangan->email }}" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.keuangans.dashboard') }}" class="btn btn-secondary">Kembali</a>
      </form>

    </div>
  </div>

</div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
