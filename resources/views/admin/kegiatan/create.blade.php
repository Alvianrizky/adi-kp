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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('kegiatan.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Tanggal Kegiatan<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id = "tanggal">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Deskripsi<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea rows="3" type="text" class="form-control" name="deskripsi" id = "deskripsi"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Gambar<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="gambar" id = "gambar">
                                </div>
                            </div>

                            <div>
                                <button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="modal"
                                    data-target="#exampleModal3">submit</button>
                                <!-- Awal Modal Simpan -->
                                <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Simpan Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin data yang anda masukkan sudah benar?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tidak</button>
                                                <input type="submit" name="Submit" class="btn btn-primary" id="save-ok"
                                                    value="Ya"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Simpan -->
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

