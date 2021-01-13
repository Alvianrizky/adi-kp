<?php

namespace App\Http\Controllers\Guru;

use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\User;
use Illuminate\Support\Facades\Hash;

class GuruSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guru');
    }

    public function index()
    {
        $siswa = Siswa::all();
        return view('guru.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('guru.siswa.create');
    }

    public function store(Request $request)
    {
        $user = Siswa::Create([
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'tempat_lahir'      => $request->tempat_lahir,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'nama_ayah'         => $request->ayah,
            'nama_ibu'          => $request->ibu,
            'nama_wali'         => $request->wali,
        ]);

        if ($user) {
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
        return view('guru.siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        return view('guru.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $user = Siswa::where('id', $id)->update([
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'tempat_lahir'      => $request->tempat_lahir,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'nama_ayah'         => $request->ayah,
            'nama_ibu'          => $request->ibu,
            'nama_wali'         => $request->wali,
        ]);

        if ($user) {
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
}
