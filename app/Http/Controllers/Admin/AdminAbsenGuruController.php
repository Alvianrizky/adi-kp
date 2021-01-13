<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenGuru;
use App\Models\Guru;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Exports\DataAbsenGuruExport;
use App\Imports\DataAbsenGuruImport;
use Excel;

class AdminAbsenGuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $data = AbsenGuru::all();
        return view('admin.absen_guru.index', compact('data'));
    }

    public function create()
    {
        $guru = Guru::all();
        return view('admin.absen_guru.create', compact('guru'));
    }

    public function store(Request $request)
    {
        $validator_required = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nama' => 'required',
            'absen' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $absen_guru = AbsenGuru::create([
            'nama'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'absen'         => $request->absen,
            'keterangan'    => $request->keterangan,
        ]);

        if ($absen_guru == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return redirect()->route('admin.absen.guru.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $guru = Guru::all();
        $data =  AbsenGuru::findOrFail($id);
        return view('admin.absen_guru.edit', compact('data', 'guru'));
    }

    public function update(Request $request, $id)
    {
        $validator_required = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nama' => 'required',
            'absen' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $absen_guru = AbsenGuru::where('id', $id)->update([
            'nama'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'absen'         => $request->absen,
            'keterangan'    => $request->keterangan,
        ]);

        if ($absen_guru == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return redirect()->route('admin.absen.guru.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function delete($id)
    {
        $data = AbsenGuru::findOrFail($id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return redirect()->route('admin.absen.guru.index');
    }

    public function export_excel(){
        return Excel::download(new DataAbsenGuruExport, 'data_absen_guru.xlsx');
    }

    public function import_excel_view() 
    {
        return view('admin.absen_guru.import');
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
        $excel = Excel::import(new DataAbsenGuruImport, $file);

        if ($excel == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('admin.absen.guru.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }
}
