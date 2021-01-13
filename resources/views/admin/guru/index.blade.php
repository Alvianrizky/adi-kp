@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./home">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
    </ol>
  </div>
  <div class="card">
    <div class="card-body">
      <form class="form-inline">
        <div class="form-group">
          <a href="{{route('guru.create')}}" type="button" class="form-control btn btn-success mb-4">Tambah Data Guru</a>
          <a href="{{route('admin.guru.export_excel')}}" target="_blank" class="form-control btn btn-primary mb-4 ml-2">Export Data Guru</a>
          <a href="{{route('admin.guru.import_excel_view')}}" type="button" class="form-control btn btn-warning mb-4 ml-2">Import Data Guru</a>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped nowrap" id="mytable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($guru as $item)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->email}}</td>
                  <td>    
                    <div class="form-inline d-flex flex-nowrap">
                      <a class='btn btn-success btn-sm mr-1' href='{{route('guru.show',$item->id)}}' title='Show'>
                        <i class='fa fa-file' style='color:white'></i>
                      </a>    
                      <a class='btn btn-primary btn-sm mr-1' href='{{route('guru.edit',$item->user_id)}}' title='Edit'>
                        <i class='fa fa-edit' style='color:white'></i>
                      </a>
                      <a data-url="{{ route('admin.guru.reset', $item->user_id) }}" type="button" class='btn btn-dark btn-sm  mr-1 reset' title='Reset Password' data-toggle='modal'
                        data-target='#exampleModal1'>
                        <i class='fa fa-redo' style='color:white'></i>
                      </a>
                      <a data-url="{{ route('guru.destroy', $item->user_id) }}" type="button" class='btn btn-danger btn-sm delete' title='Hapus' data-toggle='modal'
                        data-target='#exampleModal2'>
                        <i class='fa fa-trash' style='color:white'></i>
                      </a>
                    </div>
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.reset', function(e) {
    e.preventDefault();
    const url = $(this).data('url');
    $('#resetFormClient').attr('action', url);
  });
</script>

<form action="" method="POST" id="resetFormClient">
  @csrf    
  @method('PUT')
  <!-- Awal Modal Reset Password -->
  <div class='modal fade' id='exampleModal1' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
    aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Reset Password</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          Yakin password akan direset?
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tidak</button>
          <button type="submit" class='btn btn-primary btn-ok text-white'>Ya</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Modal Reset Password -->
</form>

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

