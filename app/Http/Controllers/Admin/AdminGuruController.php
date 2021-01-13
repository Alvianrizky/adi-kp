<?php

namespace App\Http\Controllers\Admin;

use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Exports\DataGuruExport;
use App\Imports\DataGuruImport;
use Excel;

class AdminGuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $guru = Guru::all();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $validator_required = Validator::make($request->all(), [
            'email' => 'required',
            'nama' => 'required',
            'phone' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $validator_phone = Validator::make($request->all(), [
            'phone' => 'nullable|digits_between:1,14',
        ]);
        if ($validator_phone->fails()) {
            alert()->error('Nomor Telepon Harus Berupa Angka dan Maksimal 14 Digit', 'Error!');
            return Redirect::back();
        }

        $email_users_count = User::where('email', '=', $request->email)->count();
        if($email_users_count > 0 ){
            alert()->error('Email Sudah Digunakan', 'Error!');
            return Redirect::back();
        }

        $user1 = User::Create([
            'name'      => $request->nama,
            'email'     => $request->email,
            'password'  => Hash::make('password'),
            'role'      => 'guru',
        ]);
        $user2 = Guru::Create([
            'user_id'           => $user1->id,
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'email'             => $request->email,
            'phone'             => $request->phone
        ]);

        if ($user1 == true && $user2 == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function show($id)
    {
        $guru = Guru::find($id);
        return view('admin.guru.show', compact('guru'));
    }

    public function edit($id)
    {
        $guru = Guru::where('user_id', $id)->first();
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $validator_required = Validator::make($request->all(), [
            'nama' => 'required',
            'phone' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $validator_phone = Validator::make($request->all(), [
            'phone' => 'nullable|digits_between:1,14',
        ]);
        if ($validator_phone->fails()) {
            alert()->error('Nomor Telepon Harus Berupa Angka dan Maksimal 14 Digit', 'Error!');
            return Redirect::back();
        }

        $user1 = User::where('id', $id)->update([
            'name'      => $request->nama,
            'role'      => 'guru',
        ]);
        $user2 = Guru::where('user_id', $id)->update([
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'phone'             => $request->phone
        ]);
        if ($user1 == true && $user2 == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function destroy($id)
    {
        $data1 = Guru::where('user_id', $id)->delete();
        $data2 = User::where('id', $id)->delete();
        if($data1 && $data2){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return Redirect::route('guru.index');
    }

    public function reset($id)
    {
        $data = User::where('id', $id)->update([
            'password'  => Hash::make('password'),
        ]);
        if ($data) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function export_excel(){
        return Excel::download(new DataGuruExport, 'data_guru.xlsx');
    }

    public function import_excel_view() 
    {
        return view('admin.guru.import');
    }

    public function import_excel(Request $request)
    {
        $validator_required = Validator::make($request->all(), [
            'excel' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $validator_extension = Validator::make($request->all(), [
            'excel' => 'mimes:xlsx,xls',
        ]);
        if ($validator_extension->fails()) {
            alert()->error('File Harus Berekstensi XLSX/XLS', 'Error!');
            return Redirect::back();
        }

        $file = $request->file('excel');
        $excel = Excel::import(new DataGuruImport, $file);

        if ($excel == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }
}
