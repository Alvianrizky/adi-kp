@extends('layouts.guru')
@section('css')

@endsection
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Monitoring</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Monitoring</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('guru.monitoring.update',$data->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Tanggal<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" value="{{$data->tanggal}}" name="tanggal" id = "tanggal" required >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Siswa<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="exampleFormControlSelect1" name="nama">
                                        <option value="NULL" hidden>Silahkan Pilih</option>
                                        @foreach ($siswa as $item)
                                            <option value="{{$item->nama}}" @if($item->nama==$data->nama) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Keterangan<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea rows="3" type="text" class="form-control" name="keterangan" id = "keterangan" required >{{$data->keterangan}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image" id = "image">
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary btn-sm span6 kanan">submit</button>
                                <a href="{{route('guru.monitoring.index')}}" class="btn btn-warning btn-sm">kembali</a>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- #/ container -->
@endsection
@section('js')

@endsection

