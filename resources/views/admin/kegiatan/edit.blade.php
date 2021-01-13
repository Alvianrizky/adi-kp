@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Kegiatan</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Kegiatan</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    @include('partials.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('kegiatan.update',$data->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Tanggal Kegiatan<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" value="{{$data->tanggal}}" name="tanggal" id = "tanggal">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Deskripsi<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea rows="3" type="text" class="form-control" name="deskripsi" id = "deskripsi">{{$data->deskripsi}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Gambar<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="gambar" id = "gambar">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm span6 kanan">submit</button>
                                <a href="{{route('kegiatan.index')}}" class="btn btn-warning btn-sm">kembali</a>
                            </div>
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

