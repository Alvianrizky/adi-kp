<?php

namespace App\Http\Controllers\Admin;

use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Exports\DataSiswaExport;
use App\Imports\DataSiswaImport;
use Excel;

class AdminSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $validator_required = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'nama_orang_tua_wali' => 'required',
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

        $user = Siswa::Create([
            'nama'                  => $request->nama,
            'alamat'                => $request->alamat,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'tempat_lahir'          => $request->tempat_lahir,
            'email'                 => $request->email,
            'nama_orang_tua_wali'   => $request->nama_orang_tua_wali,
            'phone'                 => $request->phone,
        ]);

        if ($user == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('siswa.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function show($id)
    {
        $siswa = Siswa::find($id);
        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $validator_required = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'nama_orang_tua_wali' => 'required',
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

        $user = Siswa::where('id', $id)->update([
            'nama'                  => $request->nama,
            'alamat'                => $request->alamat,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'tempat_lahir'          => $request->tempat_lahir,
            'email'                 => $request->email,
            'nama_orang_tua_wali'   => $request->nama_orang_tua_wali,
            'phone'                 => $request->phone,
        ]);

        if ($user == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('siswa.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function destroy($id)
    {
        $data = Siswa::where('id', $id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return Redirect::route('siswa.index');
    }

    public function export_excel(){
        return Excel::download(new DataSiswaExport, 'data_siswa.xlsx');
    }

    public function import_excel_view() 
    {
        return view('admin.siswa.import');
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
        $excel = Excel::import(new DataSiswaImport, $file);

        if ($excel == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('siswa.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }
}
