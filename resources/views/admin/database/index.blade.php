@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Database</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./home">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Database</li>
    </ol>
  </div>
  <div class="card">
    <div class="card-body">
      <form class="form-inline">
        <div class="form-group">
          <a href="{{route('admin.database.download_database')}}" type="button" class="form-control btn btn-success mb-4">Download Database</a>
          <a href="{{route('admin.database.create')}}" type="button" class="form-control btn btn-warning mb-4 ml-2">Upload Database</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

