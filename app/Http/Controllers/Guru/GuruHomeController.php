<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guru');
    }

    public function index()
    {
        return view('guru.dashboard.index');
    }
}
