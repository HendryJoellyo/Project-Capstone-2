<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Tim Keuangan</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar')

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Tim Keuangan</h1>
          </div><div class="col-sm-6 text-right"> {{-- Add text-right here --}}
            <a href="{{ route('admin.keuangans.create') }}" class="btn btn-primary">Tambah Data Tim Keuangan</a>
          </div></div></div></div>
    <div class="content">
      <div class="container-fluid">

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Nomor HP</th>
              <th>Email</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($keuangans as $keuangan)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $keuangan->nama }}</td>
              <td>{{ $keuangan->nomor_hp }}</td>
              <td>{{ $keuangan->email }}</td>
              <td>
                @php
                  $user = \App\Models\User::where('email', $keuangan->email)->first();
                @endphp
                {{ $user && $user->status ? 'Aktif' : 'Nonaktif' }}
              </td>
              <td>
                @if($user)
                <form action="{{ route('admin.keuangans.toggleStatus', ['id' => $user->id_users]) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-sm {{ $user->status ? 'btn-warning' : 'btn-success' }}">
                    {{ $user->status ? 'Nonaktifkan' : 'Aktifkan' }}
                  </button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div></div>
    </div>
  </div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>