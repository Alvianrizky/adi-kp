<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonitoringSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Exports\DataMonitoringSiswaExport;
use App\Imports\DataMonitoringSiswaImport;
use Excel;

class GuruMonitoringSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guru');
    }

    public function index()
    {
        $data = MonitoringSiswa::all();
        return view('guru.monitoring.index', ['data' => $data]);
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('guru.monitoring.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $validator_required = Validator::make($request->all(), [
            'nama' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'image' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $validator_extension = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,jpg',
        ]);
        if ($validator_extension->fails()) {
            alert()->error('File Harus Berekstensi JPEG/JPG', 'Error!');
            return Redirect::back();
        }

        if ($file = $request->image) {
            $file = $request->image;
            $nama_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $destination = public_path("assets/images/monitoring");
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $nama_file, $extension);
            $monitoring_siswa = MonitoringSiswa::create([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->nama,
                'keterangan'    => $request->keterangan,
                'image'         => "assets/images/monitoring/" . $nama_file,
            ]);
        } else {
            $monitoring_siswa = MonitoringSiswa::create([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->tanggal,
                'keterangan'    => $request->keterangan,
            ]);
        }
        if ($monitoring_siswa == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return redirect()->route('guru.monitoring.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::all();
        $data = MonitoringSiswa::findOrFail($id);
        return view('guru.monitoring.edit', compact('data', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $validator_required = Validator::make($request->all(), [
            'nama' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
        ]);
        if ($validator_required->fails()) {
            alert()->error('Data Bertanda Bintang Tidak Boleh Kosong', 'Error!');
            return Redirect::back();
        }

        $validator_extension = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,jpg',
        ]);
        if ($validator_extension->fails()) {
            alert()->error('File Harus Berekstensi JPEG/JPG', 'Error!');
            return Redirect::back();
        }

        if ($file = $request->image) {
            $file = $request->image;
            $nama_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $destination = public_path("assets/images/monitoring");
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $nama_file, $extension);
            $monitoring_siswa = MonitoringSiswa::where('id', $id)->update([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->nama,
                'keterangan'    => $request->keterangan,
                'image'         => "assets/images/monitoring/" . $nama_file,
            ]);
        } else {
            $monitoring_siswa = MonitoringSiswa::where('id', $id)->update([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->nama,
                'keterangan'    => $request->keterangan,
            ]);
        }
        if ($monitoring_siswa == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return redirect()->route('guru.monitoring.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function delete($id)
    {
        $data = MonitoringSiswa::where('id', $id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return redirect()->back();
    }

    public function export_excel(){
        return Excel::download(new DataMonitoringSiswaExport, 'data_monitoring_siswa.xlsx');
    }

    public function import_excel_view() 
    {
        return view('guru.monitoring.import');
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
        $excel = Excel::import(new DataMonitoringSiswaImport, $file);

        if ($excel == true) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('guru.monitoring.index');
        }else{
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }
}
