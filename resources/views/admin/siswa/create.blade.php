@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Siswa</a></li>
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
                        <form method="post" action="{{route('siswa.store')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Nama<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id = "nama">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Alamat<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea rows="3" type="text" class="form-control" name="alamat" id = "alamat" ></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tempat_lahir" id = "tempat_lahir">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_lahir" id = "tanggal_lahir">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id = "email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Nama Orang Tua/Wali<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_orang_tua_wali" id = "nama_orang_tua_wali">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Phone<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="phone" id ="phone">
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary btn-sm span6 kanan">submit</button>
                                <a href="{{route('siswa.index')}}" class="btn btn-warning btn-sm">kembali</a>
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

