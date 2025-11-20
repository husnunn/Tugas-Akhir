<?php

namespace App\Http\Controllers\Api\Keluarga\P4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga\P4\KgP423M;
use Illuminate\Support\Facades\Log;
use App\Models\Keluarga\P2\KgP2M;
use Illuminate\Support\Facades\Auth;

class P423Api extends Controller
{

    public function showByIdP2($id)
    {
        $data = KgP423M::where('id_kg_p2', $id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Data keluarga berdasarkan ID P2',
            'data' => $data
        ]);
    }

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

            $data = KgP423M::with('masterNakes')
                ->where('id_kg_p2', $idKgP2)
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan.',
                'data' => $data
            ], 200);
        } catch (\Throwable $e) {
            Log::error("[P423 INDEX] " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    /**
     * POST /api/kg/p423
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kg_p2' => 'required',
            'id_master_tenkes' => 'required',
        ]);

        try {
            $datap2 = KgP2M::find($request->id_kg_p2);

            if (!$datap2) {
                return response()->json([
                    'status' => false,
                    'message' => 'id_kg_p2 tidak ditemukan.'
                ], 404);
            }

            $data = KgP423M::create([
                'id' => "KGP423-" . strtotime(now()),
                'id_kg_p2' => $request->id_kg_p2,
                'id_master_tenkes' => $request->id_master_tenkes,
                'jarak' => $request->jarak,
                'waktu_tempuh' => $request->waktu_tempuh,
                'kemudahan' => $request->kemudahan,

                'id_survey' => $datap2->id_survey,
                'id_buat' => Auth::id(),
                'id_update' => Auth::id(),
                'tgl_buat' => now(),
                'tgl_update' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan.',
                'data' => $data
            ], 201);
        } catch (\Throwable $e) {
            Log::error("[P423 STORE] " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    /**
     * GET /api/kg/p423/{id}
     */
    public function show($id)
    {
        $data = KgP423M::with('masterNakes')->find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail data.',
            'data' => $data
        ], 200);
    }

    /**
     * PUT/PATCH /api/kg/p423/{id}
     */
    public function update(Request $request, $id)
    {
        $data = KgP423M::find($id);

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
                'tgl_update' => now()
            ]
        ));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $data
        ], 200);
    }

    /**
     * DELETE /api/kg/p423/{id}
     */
    public function destroy($id)
    {
        $data = KgP423M::find($id);

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
