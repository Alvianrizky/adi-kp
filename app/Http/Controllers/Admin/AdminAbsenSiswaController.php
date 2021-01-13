<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenSiswa;
use App\Models\Siswa;

class AdminAbsenSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $data = AbsenSiswa::all();

        return view('admin.absen_siswa.index', compact('data'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('admin.absen_siswa.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        AbsenSiswa::create([
            'nama'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'absen'         => $request->absen,
            'keterangan'    => $request->keterangan,
        ]);
        alert()->success('Data Berhasil Disimpan', 'Success!');
        return redirect()->route('admin.absen.siswa.index');
    }

    public function edit($id)
    {
        $siswa = Siswa::all();
        $data =  AbsenSiswa::findOrFail($id);

        return view('admin.absen_siswa.edit', compact('data', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        AbsenSiswa::where('id', $id)->update([
            'nama'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'absen'         => $request->absen,
            'keterangan'    => $request->keterangan,
        ]);
        alert()->success('Data Berhasil Disimpan', 'Success!');
        return redirect()->route('admin.absen.siswa.index');
    }

    public function delete($id)
    {
        $data = AbsenSiswa::findOrFail($id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return redirect()->route('admin.absen.siswa.index');
    }
}
