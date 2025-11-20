<?php

namespace App\Http\Controllers\Api\Keluarga\P4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga\P4\KgP424M;
use Illuminate\Support\Facades\Log;
use App\Models\Keluarga\P2\KgP2M;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class P424Api extends Controller
{

    public function showByIdP2($id)
    {
        $data = KgP424M::where('id_kg_p2', $id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Data keluarga berdasarkan ID P2',
            'data' => $data
        ]);
    }

    // GET LIST DATA
    public function index(Request $request)
    {
        try {
            $idKgP2 = $request->id_kg_p2;

            if (!$idKgP2) {
                return response()->json([
                    'status' => false,
                    'message' => 'Parameter id_kg_p2 diperlukan.'
                ], 400);
            }

            $data = KgP424M::with('masterApst')
                ->where('id_kg_p2', $idKgP2)
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan.',
                'data' => $data
            ], 200);
        } catch (\Throwable $e) {
            Log::error('[P4-424-INDEX] ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // CREATE DATA
    public function store(Request $request)
    {
        $request->validate([
            'id_kg_p2' => 'required',
            'id_master_akses_sarpras' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $datap2 = KgP2M::find($request->id_kg_p2);

            if (!$datap2) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data P2 tidak ditemukan.'
                ], 404);
            }

            $data = KgP424M::create([
                'id' => "KGP424-" . strtotime(date("Y-m-d H:i:s")),
                'id_buat' => Auth::id() ?? null,
                'id_survey' => $datap2->id_survey,
                'tgl_buat' => now(),
                'tgl_update' => now(),
                'id_kg_p2' => $request->id_kg_p2,

                'id_master_akses_sarpras' => $request->id_master_akses_sarpras,
                'jenis_transportasi' => $request->jenis_transportasi,
                'penggunaan_transportasi' => $request->penggunaan_transportasi,
                'biaya_sekali' => $request->biaya_sekali,
                'waktu_tempuh' => $request->waktu_tempuh,
                'kemudahan' => $request->kemudahan
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan.',
                'data' => $data
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('[P4-424-STORE] ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // SHOW DETAIL
    public function show($id)
    {
        $data = KgP424M::with('masterApst')->find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail data ditemukan.',
            'data' => $data
        ], 200);
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = KgP424M::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $data->update(array_merge(
            $request->all(),
            [
                'id_update' => Auth::id(),
                'tgl_update' => Carbon::now(),
            ]
        ));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $data
        ], 200);
    }

    // DELETE DATA
    public function destroy($id)
    {
        $data = KgP424M::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus.'
        ], 200);
    }
}
