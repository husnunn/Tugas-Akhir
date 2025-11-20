<?php

namespace App\Http\Controllers\Api\Individu\P4;

use App\Http\Controllers\Controller;
use App\Models\Individu\P4\IdvP402M;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class P402IdvApi extends Controller
{
    public function index()
    {
        $data = IdvP402M::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
    public function store(Request $request)
    {
        $today = Carbon::now();

        // $validated = $request->validate([
        //     'kondisi_pekerjaan' => 'required',
        //     'pekerjaan_utama' => 'required',
        //     'jsk' => 'required',
        // ]);

        $data = IdvP402M::create([
            'id' => "IDVP402-" . strtotime(date("Y-m-d H:i:s")),
            'id_individu_p1' => $request->id_individu_p1,
            'id_master_sarkes' => $request->id_master_sarkes,
            'jml_berkunjung' => $request->jml_berkunjung,

            'id_buat' => Auth::user()->id,
            'id_update' => Auth::user()->id,
            'tgl_buat' => $today,
            'tgl_update' => $today
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P402 berhasil disimpan',
            'data' => $data
        ]);
    }
    public function show($id)
    {
        $data = IdvP402M::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P402 berhasil di Tampilkan',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $today = Carbon::now();
        $data = IdvP402M::where('id', $id)->update([
            'id_master_sarkes' => $request->id_master_sarkes,
            'jml_berkunjung' => $request->jml_berkunjung,

            // 'id_buat' => Auth::user()->id,
            'id_update' => Auth::user()->id,
            // 'tgl_buat' => $today,
            'tgl_update' => $today
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P402 berhasil di update',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        IdvP402M::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Data Individu P402 Berhasil Dihapus"
        ]);
    }

    public function showByIdP1($id)
    {
        $data = IdvP402M::where('id_individu_p1', $id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P402 berdasarkan ID P1',
            'data' => $data
        ]);
    }
}
