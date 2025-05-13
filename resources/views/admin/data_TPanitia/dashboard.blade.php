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
    <div class="content-header container-fluid">
      <h1>Data Panitia Event</h1>
      <a href="{{ route('admin.panitias.create') }}" class="btn btn-primary mb-3">Tambah Data Panitia Event</a>


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
            <a href="{{ route('admin.panitias.edit', ['panitias' => $panitia->id]) }}" class="btn btn-info btn-sm">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{ route('admin.panitias.destroy', ['panitias' => $panitia->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
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
