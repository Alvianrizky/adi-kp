@extends('layouts.admin')
@section('css')

@endsection
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Password</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Password</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('guru.change.password.index') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Password Lama</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="current_password" id="current_password" required >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Password Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_password" id = "new_password" required >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputTitle3" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_confirm_password" id = "new_confirm_password" required >
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary btn-sm span6 kanan">submit</button>
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

