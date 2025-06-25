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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Role</h1>
          </div><div class="col-sm-6 text-right"> {{-- Add text-right here --}}
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Tambah Role</a>
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
              <th>Nama Role</th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $role)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $role->nama_role }}</td>
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