@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Pembayaran SPP</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Pembayaran SPP</li>
      </ol>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped nowrap" id="mytable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->tanggal}}</td>
                    <td>{{$item->jumlah}}</td>
                    <td>{{$item->keterangan}}</td>
                    <td>
                      <a class='btn btn-warning btn-sm mr-1' target="_blank" href='{{route('admin.spp.resi',$item->id)}}' title='Cetak'>
                        <i class='fa fa-print' style='color:white'></i>
                      </a>
                      <a data-url="{{ route('spp.destroy', $item->id) }}" type="button" class='btn btn-danger btn-sm delete' title='Hapus' data-toggle='modal'
                        data-target='#exampleModal2'>
                        <i class='fa fa-trash' style='color:white'></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- DataTable with Hover -->
  </div>
</div>

<script>
  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    const url = $(this).data('url');
    $('#deleteFormClient').attr('action', url);
  });
</script>

<form action="" method="POST" id="deleteFormClient">
  @method('DELETE')
  @csrf    
  <!-- Awal Modal Hapus -->
  <div class='modal fade' id='exampleModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
    aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Hapus Data</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          Yakin data akan dihapus?
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tidak</button>
          <button type="submit" class='btn btn-primary btn-ok text-white'>Ya</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Modal Hapus -->
</form>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#mytable').DataTable();
    } );
</script>
@endsection

