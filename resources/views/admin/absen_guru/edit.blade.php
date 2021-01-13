@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Guru</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Absen Guru</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('admin.absen.guru.update',$data->id)}}">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Tanggal<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" value="{{$data->tanggal}}" class="form-control" name="tanggal" id = "tanggal">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Guru<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="exampleFormControlSelect1" name="nama">
                                        <option value="NULL" hidden>Silahkan Pilih</option>
                                        @foreach ($guru as $item)
                                            <option value="{{$item->nama}}" @if($item->nama==$data->nama) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Absen<span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="exampleFormControlSelect1" name="absen">
                                        <option hidden>Silahkan Pilih</option>
                                        <option value="hadir" @if ($data->absen=='hadir') selected @endif>Hadir</option>
                                        <option value="izin" @if ($data->absen=='izin') selected @endif>Izin</option>
                                        <option value="sakit" @if ($data->absen=='sakit') selected @endif>Sakit</option>
                                        <option value="alfa" @if ($data->absen=='alfa') selected @endif>Alfa</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea rows="3" type="text" class="form-control" name="keterangan" id = "keterangan">{{$data->keterangan}}</textarea>
                                </div>
                            </div>

                                {{-- </fieldset> --}}
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm span6 kanan">submit</button>
                                <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm">kembali</a>
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

