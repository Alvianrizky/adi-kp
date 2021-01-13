<?php

namespace App\Http\Controllers\Admin;

use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spp;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade as PDF;

class AdminSppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $data = Spp::all();
        return view('admin.spp.index', compact('data'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('admin.spp.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $data = Spp::create([
            'name'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'jumlah'        => $request->jumlah,
            'keterangan'    => $request->keterangan,
        ]);
        if ($data) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('spp.index');
        } else {
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::all();
        $spp =  Spp::findOrFail($id);;
        return view('admin.spp.edit', compact('spp', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $data = Spp::where('id', $id)->update([
            'name'          => $request->nama,
            'tanggal'       => $request->tanggal,
            'jumlah'        => $request->jumlah,
            'keterangan'    => $request->keterangan,
        ]);
        if ($data) {
            alert()->success('Data Berhasil Disimpan', 'Success!');
            return Redirect::route('spp.index');
        } else {
            alert()->error('Data Gagal Disimpan', 'Error!');
            return Redirect::back();
        }
    }

    public function destroy($id)
    {
        $data = Spp::where('id', $id)->delete();
        if($data){
            alert()->success('Data Berhasil Dihapus', 'Success!');
        }else{
            alert()->error('Data Gagal Dihapus', 'Error!');
        }
        return Redirect::route('spp.index');
    }

    public function laporan()
    {
        return view('admin.laporan.index');
    }

    public function resi($id)
    {
        $data = Spp::where('id', $id)->first();
        return PDF::loadview('admin.laporan.resi', compact('data'))->stream('spp resi');
    }

    public function cetak(Request $request)
    {
        $data = Spp::whereBetween('tanggal', [$request->start, $request->stop])->get();
        return PDF::loadview('admin.laporan.print', compact('data'))->stream('spp cetak' . $request->start . '-' . $request->stop);
    }
}
