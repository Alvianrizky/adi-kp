@extends('layouts.guru')
@section('css')

@endsection
@section('contents')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./home">Home</a></li>
      <li class="breadcrumb-item">Data Siswa</li>
    </ol>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped nowrap" id="mytable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Email</th>
              <th>Tempat/Tanggal Lahir</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($siswa as $item)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->alamat}}</td>
                  <td>{{$item->email}}</td>
                  <td>{{$item->tempat_lahir}}, {{date('d-M-Y', strtotime($item->tanggal_lahir))}}</td>
                  <td>     
                    <a class='btn btn-success btn-sm mr-1' href='{{route('guru.siswa.show',$item->id)}}' title='Show'>
                      <i class='fa fa-file' style='color:white'></i>
                    </a>
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#mytable').DataTable();
    } );
</script>
@endsection

