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
      <h1>Data Tim Keuangan</h1>
      <a href="{{ route('admin.keuangans.create') }}" class="btn btn-primary mb-3">Tambah Data Tim Keuangan</a>


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
        @foreach($keuangans as $keuangan)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $keuangan->nama }}</td>
            <td>{{ $keuangan->nomor_hp }}</td>
            <td>{{ $keuangan->email }}</td>
            <td>
            <a href="{{ route('admin.keuangans.edit', ['keuangans' => $keuangan->id]) }}" class="btn btn-info btn-sm">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{ route('admin.keuangans.destroy', ['keuangans' => $keuangan->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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
