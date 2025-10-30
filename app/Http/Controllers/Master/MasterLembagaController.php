<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Lembaga_P800;
use Illuminate\Support\Facades\Auth;

class MasterLembagaController extends Controller
{
    public function index()
    {
        $lembaga = Lembaga_P800::all();
        return view('pages.desa.master.masterlembaga', compact('lembaga'));
        // return response()->json($data);
    }
}
