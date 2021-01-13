@extends('layouts.guru')
@section('css')
@endsection
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Show Siswa</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputTitle3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$siswa->nama}}" class="form-control-plaintext" name="nama" id = "nama" readonly >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTitle3" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$siswa->alamat}}" class="form-control-plaintext" name="alamat" id = "alamat" readonly >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTitle3" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$siswa->tempat_lahir}}" class="form-control-plaintext" name="tempat_lahir" id = "tempat_lahir" readonly >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTitle3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$siswa->tanggal_lahir}}" class="form-control-plaintext" name="tanggal_lahir" id = "tanggal_lahir" readonly >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTitle3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" value="{{$siswa->email}}" class="form-control-plaintext" name="email" id = "email" readonly >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTitle3" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$siswa->phone}}" class="form-control-plaintext" name="phone" id="phone" readonly>
                            </div>
                        </div>

                            {{-- </fieldset> --}}
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm">kembali</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- #/ container -->
@endsection
@section('js')

@endsection

