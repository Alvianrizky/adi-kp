<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Exports\DataAbsenSiswaExport;
use App\Imports\DataAbsenSiswaImport;
use Excel;

class GuruAbsenSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guru');
    }

    public function index()
    {
        $data = AbsenSiswa::all();

        return view('guru.absen_siswa.index', compact('data'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('guru.absen_siswa.create', compact('siswa'));
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

        $absen_siswa = AbsenSiswa::create([
            'nama'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'absen'         => $request->absen,
            'keterangan'    => $request->keterangan,
        ]);
        if ($absen_siswa == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return redirect()->route('guru.absen.siswa.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::all();
        $data =  AbsenSiswa::findOrFail($id);

        return view('guru.absen_siswa.edit', compact('data', 'siswa'));
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

        $absen_siswa = AbsenSiswa::where('id', $id)->update([
            'nama'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'absen'         => $request->absen,
            'keterangan'    => $request->keterangan,
        ]);
        if ($absen_siswa == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return redirect()->route('guru.absen.siswa.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function delete($id)
    {
        $data = AbsenSiswa::findOrFail($id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return redirect()->route('guru.absen.siswa.index');
    }

    public function export_excel(){
        return Excel::download(new DataAbsenSiswaExport, 'data_absen_siswa.xlsx');
    }

    public function import_excel_view() 
    {
        return view('guru.absen_siswa.import');
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
        $excel = Excel::import(new DataAbsenSiswaImport, $file);

        if ($excel == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.absen.siswa.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }
}
