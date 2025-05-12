<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Role</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar')

  <div class="content-wrapper">
    <div class="content-header container-fluid">
      <h1>Data Role</h1>
      <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">Tambah Role</a>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $role)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $role->nama_role }}</td>
            <td>
            <a href="{{ route('admin.roles.edit', ['role' => $role]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.roles.destroy', ['role' => $role]) }}" method="POST"class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
