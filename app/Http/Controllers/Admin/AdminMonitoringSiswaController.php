<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonitoringSiswa;
use App\Models\Siswa;

class AdminMonitoringSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $data = MonitoringSiswa::all();
        return view('admin.monitoring.index', ['data' => $data]);
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('admin.monitoring.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        if ($file = $request->image) {
            $file = $request->image;
            $nama_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $destination = public_path("assets/images/monitoring");
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $nama_file, $extension);
            MonitoringSiswa::create([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->nama,
                'keterangan'    => $request->keterangan,
                'image'         => "assets/images/monitoring/" . $nama_file,
            ]);
        } else {
            MonitoringSiswa::create([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->tanggal,
                'keterangan'    => $request->keterangan,
            ]);
        }
        alert()->success('Data Berhasil Disimpan', 'Success!');
        return redirect()->route('admin.monitoring.index');
    }

    public function edit($id)
    {
        $siswa = Siswa::all();
        $data = MonitoringSiswa::findOrFail($id);
        return view('admin.monitoring.edit', compact('data', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        if ($file = $request->image) {
            $file = $request->image;
            $nama_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $destination = public_path("assets/images/monitoring");
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $nama_file, $extension);
            MonitoringSiswa::where('id', $id)->update([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->nama,
                'keterangan'    => $request->keterangan,
                'image'         => $nama_file,
            ]);
        } else {
            MonitoringSiswa::where('id', $id)->update([
                'tanggal'       => $request->tanggal,
                'nama'          => $request->tanggal,
                'keterangan'    => $request->keterangan,
            ]);
        }
        alert()->success('Data Berhasil Disimpan', 'Success!');
        return redirect()->route('admin.monitoring.index');
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
}
