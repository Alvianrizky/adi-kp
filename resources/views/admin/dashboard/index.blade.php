@extends('layouts.admin')
@section('css')
@endsection
@section('contents')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Home</h1>
  </div>
  <div class="card bg-primary">
    <div class="card-header text-black"><b>Selamat Datang</b></div>
      <div class="card-body text-white">
        <h5 class="card-title"><b>{{Auth::user()->name}}</b></h5>
        <p class="card-text">Anda login sebagai <b>{{Auth::user()->role}}</b>, silahkan gunakan fasilitas yang sudah disediakan
          dengan sebaik mungkin.</p>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
 <script src="{{url('assets/vendor/chart/Chart.min.js')}}"></script>
 <script src="{{url('assets/js/demo/chart-area-demo.js')}}"></script>
@endsection


