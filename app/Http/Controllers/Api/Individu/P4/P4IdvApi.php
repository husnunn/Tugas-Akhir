<?php

namespace App\Http\Controllers\Api\Individu\P4;

use App\Http\Controllers\Controller;
use App\Models\Individu\P4\IdvP4M;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class P4IdvApi extends Controller
{
    public function index()
    {
        $data = IdvP4M::all();

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

        $data = IdvP4M::create([
            'id' => "IDVP4-" . strtotime(date("Y-m-d H:i:s")),
            'id_individu_p1' => $request->id_individu_p1,
            'tunanetra' => $request->tunanetra,
            'tunarungu' => $request->tunarungu,
            'tunawicara' => $request->tunawicara,
            'tunadaksa' => $request->tunadaksa,
            'tunagrahita' => $request->tunagrahita,
            'tunalaras' => $request->tunalaras,
            'cacat_eks_sakitkusta' => $request->cacat_eks_sakitkusta,
            'cacat_ganda' => $request->cacat_ganda,
            'dipasung' => $request->dipasung,

            'id_buat' => Auth::user()->id,
            'id_update' => Auth::user()->id,
            'tgl_buat' => $today,
            'tgl_update' => $today
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P4 berhasil disimpan',
            'data' => $data
        ]);
    }
    public function show($id)
    {
        $data = IdvP4M::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P4 berhasil di Tampilkan',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $today = Carbon::now();
        $data = IdvP4M::where('id', $id)->update([
            'tunanetra' => $request->tunanetra,
            'tunarungu' => $request->tunarungu,
            'tunawicara' => $request->tunawicara,
            'tunadaksa' => $request->tunadaksa,
            'tunagrahita' => $request->tunagrahita,
            'tunalaras' => $request->tunalaras,
            'cacat_eks_sakitkusta' => $request->cacat_eks_sakitkusta,
            'cacat_ganda' => $request->cacat_ganda,
            'dipasung' => $request->dipasung,

            // 'id_buat' => Auth::user()->id,
            'id_update' => Auth::user()->id,
            // 'tgl_buat' => $today,
            'tgl_update' => $today
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P4 berhasil di update',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        IdvP4M::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Data Individu P4 Berhasil Dihapus"
        ]);
    }

    public function showByIdP1($id)
    {
        $data = IdvP4M::where('id_individu_p1', $id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Data Individu P4 berdasarkan ID P1',
            'data' => $data
        ]);
    }
}
