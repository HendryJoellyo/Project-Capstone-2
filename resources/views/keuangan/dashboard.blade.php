<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  <title>Keuangan Dashboard</title>
</head>

  @include('layouts.navbar')
  @include('layouts.sidebar_keuangan')

  <div class="content-wrapper">
    <div class="content-header container-fluid">
      <h1>Data Event Member</h1>
        <table class="table table-bordered">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama Event</th>
                  <th>Nama Member</th>
                  <th>Bukti Pembayaran</th>
                  <th>Status Pembayaran</th>
              </tr>
          </thead>
          <tbody>
      @foreach($registrations as $key => $reg)
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $reg->event->nama_event }}</td>
          <td>{{ $reg->user->nama }}</td>
          <td>
            <a href="{{ asset('uploads/bukti_pembayaran/'.$reg->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
          </td>
          <td>
            @if($reg->status_pembayaran == 'pending' || $reg->status_pembayaran == 'proses')
              <button class="btn btn-success btn-sm" onclick="updateStatus({{ $reg->id_event_registrations }}, 'verified')">
                <i class="fas fa-check"></i> Verified
              </button>
              <button class="btn btn-danger btn-sm" onclick="updateStatus({{ $reg->id_event_registrations }}, 'rejected')">
                <i class="fas fa-times"></i> Rejected
              </button>
            @else
              <span class="badge 
                @if($reg->status_pembayaran == 'verified') badge-success 
                @elseif($reg->status_pembayaran == 'rejected') badge-danger 
                @endif">
                {{ ucfirst($reg->status_pembayaran) }}
              </span>
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>

      </table>
      </div>
      </div>
      


<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>


<script>
  function updateStatus(id, status) {
  Swal.fire({
    title: 'Apakah kamu yakin?',
    text: "Status akan diubah menjadi " + status,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, ubah!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("{{ route('keuangan.update.status.pembayaran') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
        },
        body: JSON.stringify({
          id: id,
          status: status
        })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error("Gagal mengubah status.");
        }
        return response.json();
      })
      .then(data => {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: data.message,
          confirmButtonColor: '#3085d6'
        }).then(() => {
          location.reload();
        });
      })
      .catch(error => {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Terjadi kesalahan.',
          confirmButtonColor: '#d33'
        });
      });
    }
  });
}

</script>

</body>
</html>