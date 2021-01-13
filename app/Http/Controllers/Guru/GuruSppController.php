<?php

namespace App\Http\Controllers\Guru;

use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spp;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;
use App\Exports\DataSppExport;
use App\Imports\DataSppImport;
use Excel;

class GuruSppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guru');
    }

    public function index()
    {
        $data = Spp::all();
        return view('guru.spp.index', compact('data'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('guru.spp.create', compact('siswa'));
    }

    public function store(Request $request)
    {        
        $validator_required = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $data = Spp::create([
            'name'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'jumlah'        => $request->jumlah,
            'keterangan'    => $request->keterangan,
        ]);
        if ($data == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.spp.index');
        } else {
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::all();
        $spp =  Spp::findOrFail($id);;
        return view('guru.spp.edit', compact('spp','siswa'));
    }

    public function update(Request $request, $id)
    {
        $validator_required = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $data = Spp::where('id', $id)->update([
            'name'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'jumlah'        => $request->jumlah,
            'keterangan'    => $request->keterangan,
        ]);
        if ($data == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.spp.index');
        } else {
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function delete($id)
    {
        $data = Spp::where('id', $id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return Redirect::route('guru.spp.index');
    }

    public function laporan()
    {
        return view('guru.laporan.index');
    }

    public function resi($id)
    {
        $data = Spp::where('id', $id)->first();
        return PDF::loadview('guru.laporan.resi', compact('data'))->stream('spp resi');
    }

    public function cetak(Request $request)
    {
        $data = Spp::whereBetween('tanggal', [$request->start, $request->stop])->get();
        return PDF::loadview('guru.laporan.print', compact('data'))->stream('spp cetak' . $request->start . '-' . $request->stop);
    }

    public function export_excel(){
        return Excel::download(new DataSppExport, 'data_spp.xlsx');
    }

    public function import_excel_view() 
    {
        return view('guru.spp.import');
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
        $excel = Excel::import(new DataSppImport, $file);

        if ($excel == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.spp.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }
}
