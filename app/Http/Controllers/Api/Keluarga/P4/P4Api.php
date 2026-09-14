<?php

namespace App\Http\Controllers\Api\Keluarga\P4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga\P4\KgP4M;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Keluarga\P2\KgP2M;

class P4Api extends Controller
{
    // ✅ Ambil data P4 berdasarkan id_kg_p2
    public function showByIdP2($id)
    {
        try {
            $data = KgP4M::where('id_kg_p2', $id)->first();

            return response()->json([
                'status' => true,
                'message' => 'Data P4 berdasarkan id_kg_p2',
                'data' => $data
            ]);
        } catch (Throwable $e) {
            Log::error("[P4 INDEX] " . $e->getMessage());
        }
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

            $data = KgP4M::where('id_kg_p2', $idKgP2)->get();

            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan.',
                'data' => $data
            ], 200);
        } catch (\Throwable $e) {
            Log::error("[P4 INDEX] " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // INSERT
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $request->validate([
                'id_kg_p2' => 'required',
                'tempat_tinggal_yg_ditempati' => 'required',
                'status_lahan_tempat_tinggal_yg_ditempati' => 'required',
    'daya_meteran_rumah' => 'nullable',
            ]);

            $datap2 = KgP2M::find($request->id_kg_p2);
            if (!$datap2) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data P2 tidak ditemukan.'
                ], 404);
            }

            $data = KgP4M::create([
                'id' => "KGP4-" . strtotime(date("Y-m-d H:i:s")),
                'id_buat' => Auth::user()->id,
                'id_survey' => $datap2->id_survey,
                'tgl_buat' => now(),
                'tgl_update' => now(),

                // form input
                'id_kg_p2' => $request->id_kg_p2,
                'tempat_tinggal_yg_ditempati' => $request->tempat_tinggal_yg_ditempati,
                'status_lahan_tempat_tinggal_yg_ditempati' => $request->status_lahan_tempat_tinggal_yg_ditempati,
                'luas_lantai_ttl_terluas' => $request->luas_lantai_ttl_terluas,
                'luas_lahan_ttl_terluas' => $request->luas_lahan_ttl_terluas,
                'jns_lantai_ttl_terluas' => $request->jns_lantai_ttl_terluas,
                'dinding_sebagian_besar_rumah' => $request->dinding_sebagian_besar_rumah,
                'jendela' => $request->jendela,
                'atap' => $request->atap,
                'penerangan_rumah' => $request->penerangan_rumah,
                'energi_untuk_memasak' => $request->energi_untuk_memasak,
                'sumber_kayu_bakar' => $request->sumber_kayu_bakar,
                'tempat_pembuangan_sampah' => $request->tempat_pembuangan_sampah,
                'fasilitas_mck' => $request->fasilitas_mck,
                'sumber_air_mandi' => $request->sumber_air_mandi,
                'fasilitas_bab' => $request->fasilitas_bab,
                'sumber_air_minum' => $request->sumber_air_minum,
                'tmpt_pembuangan_limbah_cair' => $request->tmpt_pembuangan_limbah_cair,
                'rumah_berada_dibawah' => $request->rumah_berada_dibawah,
                'rumah_di_bantaran_sungai' => $request->rumah_di_bantaran_sungai,
                'rumah_dilereng_bukit_gunung' => $request->rumah_dilereng_bukit_gunung,
                'secara_keseluruhan_kondisi_rumah' => $request->secara_keseluruhan_kondisi_rumah,
                'meteran_rumah' => $request->meteran_rumah,
                'no_meteran' => $request->no_meteran,
                'daya_meteran_rumah' => $request->daya_meteran_rumah,
                'atas_nama' => $request->atas_nama,
                'blt_dana_desa' => $request->blt_dana_desa,
                'pkh' => $request->pkh,
                'bst' => $request->bst,
                'banpres' => $request->banpres,
                'bantuan_umkm' => $request->bantuan_umkm,
                'bantuan_pekerja' => $request->bantuan_pekerja,
                'bantuan_anak' => $request->bantuan_anak,
                'lainnya' => $request->lainnya,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan.',
                'data' => $data
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("[P4 STORE] " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // GET DETAIL
    public function show($id)
    {
        try {
            $data = KgP4M::find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan.',
                'data' => $data
            ], 200);
        } catch (\Throwable $e) {
            Log::error("[P4 SHOW] " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $data = KgP4M::find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }

            $data->update(array_merge(
                $request->all(),
                ['id_update' => Auth::user()->id ?? 'SYSTEM', 'tgl_update' => Carbon::now()]
            ));

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui.',
                'data' => $data
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("[P4 UPDATE] " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $data = KgP4M::find($id);

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
            ]);
        } catch (\Throwable $e) {
            Log::error("[P4 DELETE] " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }
}
