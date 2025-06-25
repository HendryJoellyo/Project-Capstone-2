<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Panitia Event</title>
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
            <h1 class="m-0">Data Panitia Event</h1>
          </div><div class="col-sm-6 text-right">
            <a href="{{ route('admin.panitias.create') }}" class="btn btn-primary">Tambah Data Panitia Event</a>
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
              <th>Status</th> {{-- Added Status column --}}
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          @foreach($panitias as $panitia)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $panitia->nama }}</td>
              <td>{{ $panitia->nomor_hp }}</td>
              <td>{{ $panitia->email }}</td>
              <td>
                @php
                  // Find the associated user based on email
                  $user = \App\Models\User::where('email', $panitia->email)->first();
                @endphp
                {{-- Display status --}}
                {{ $user && $user->status ? 'Aktif' : 'Nonaktif' }}
              </td>
              <td>
                @if($user)
                <form action="{{ route('admin.panitias.toggleStatus', ['id' => $user->id_users]) }}" method="POST" class="d-inline">
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