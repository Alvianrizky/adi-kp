<?php

namespace App\Http\Controllers\Admin;

use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Validator;
use App\Exports\DataKegiatanExport;
use App\Imports\DataKegiatanImport;
use Excel;

class AdminKegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validator_required = Validator::make($request->all(), [
            'tanggal' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $validator_extension = Validator::make($request->all(), [
            'gambar' => 'mimes:jpeg,jpg',
        ]);
        if ($validator_extension->fails()) {
            alert()->error('File Harus Berekstensi JPEG/JPG', 'Error!');
            return Redirect::back();
        }

        $file = $request->gambar;
        $nama_file = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $destination = public_path("assets/images/kegiatan");
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }
        $file->move($destination, $nama_file, $extension);

        $data = Kegiatan::create([
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'image'     => $nama_file,
        ]);
        if($data == true){
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('kegiatan.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $data = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator_required = Validator::make($request->all(), [
            'tanggal' => 'required',
            'deskripsi' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $validator_extension = Validator::make($request->all(), [
            'gambar' => 'mimes:jpeg,jpg',
        ]);
        if ($validator_extension->fails()) {
            alert()->error('File Harus Berekstensi JPEG/JPG', 'Error!');
            return Redirect::back();
        }

        if($request->gambar == null){
            $data = Kegiatan::where('id', $id)->update([
                'tanggal'   => $request->tanggal,
                'deskripsi' => $request->deskripsi,
            ]);
        }else{
            $file = $request->gambar;
            $nama_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $destination = public_path("assets/images/kegiatan");
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $nama_file, $extension);
    
            $data = Kegiatan::where('id', $id)->update([
                'tanggal'   => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'image'     => "assets/images/kegiatan/" . $nama_file,
            ]);
        }

        if($data == true){
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('kegiatan.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function destroy($id)
    {
        $data = Kegiatan::findOrFail($id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return Redirect::back();
    }

    public function export_excel(){
        return Excel::download(new DataKegiatanExport, 'data_kegiatan.xlsx');
    }

    public function import_excel_view() 
    {
        return view('admin.kegiatan.import');
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
        $excel = Excel::import(new DataKegiatanImport, $file);

        if ($excel == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('kegiatan.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

}
