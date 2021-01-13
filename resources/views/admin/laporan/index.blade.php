@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">LAPORAN</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">LAPORAN</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="table-responsive p-3">
          <form action="{{route('admin.spp.cetak')}}" method="POST" target="_blank">
            @csrf
            @method('get')
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Dari Tanggal</label>
                  <input type="date" name="start" class="form-control" id="start" style="width: 200px;" required>
                  <label>Sampai Tanggal</label>
                  <input type="date" name="stop" class="form-control" id="stop" style="width: 200px;" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input type="submit" class="btn btn-info" value="Cetak">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')

@endsection

