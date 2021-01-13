@extends('layouts.guru')
@section('css')

@endsection
@section('contents')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kegiatan</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./home">Home</a></li>
      <li class="breadcrumb-item">Data Kegiatan</li>
    </ol>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped nowrap" id="mytable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Deskripsi</th>
              <th>Gambar</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($kegiatan as $item)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{date('d-M-Y', strtotime($item->tanggal))}}</td>
                  <td>{{$item->deskripsi}}</td>
                  <td> <img style="width: 50%" src="{{url("assets/images/kegiatan/" . $item->image)}}"></td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- DataTable with Hover -->
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

