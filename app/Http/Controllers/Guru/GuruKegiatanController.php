<?php

namespace App\Http\Controllers\Guru;

use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;

class GuruKegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guru');
    }

    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('guru.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('guru.kegiatan.create');
    }

    public function store(Request $request)
    {
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
            'image'     => "assets/images/kegiatan/" . $nama_file,
        ]);
        if($data){
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
        return view('guru.kegiatan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
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

        if($data){
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
}
