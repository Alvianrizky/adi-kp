@extends('layouts.guru')
@section('css')

@endsection
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pembayaran SPP</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Pembayaran SPP</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('guru.spp.update', $spp->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Nama Siswa<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="exampleFormControlSelect1" name="nama">
                                        <option value="NULL" hidden>Silahkan Pilih</option>
                                        @foreach ($siswa as $item)
                                            <option value="{{$item->nama}}" @if($item->nama==$spp->name) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Tanggal<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" value="{{$spp->tanggal}}" class="form-control" name="tanggal" id = "tanggal">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Jumlah<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$spp->jumlah}}" class="form-control" name="jumlah" id = "jumlah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$spp->keterangan}}" class="form-control" name="keterangan" id = "keterangan">
                                </div>
                            </div>

                                {{-- </fieldset> --}}
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm span6 kanan">submit</button>
                                <a href="{{route('guru.spp.index')}}" class="btn btn-warning btn-sm">kembali</a>
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

