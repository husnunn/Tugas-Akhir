<?php

namespace App\Http\Controllers\Api\RT\P2;

use Carbon\Carbon;
use App\Models\RT\P2\RtP2M;
use Illuminate\Http\Request;
use App\Models\Survey\Survey;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class P2RtController extends Controller
{
    public function index(Request $request)
    {
        // $data = RtP2M::orderBy('tgl_buat', 'desc')->get();

        $now = Carbon::now();
        $data = DB::table("rt_p2")
            ->join("rt_p3", "rt_p2.id_p3_rw", "=", "rt_p3.id")
            ->join('survey', 'rt_p3.id_survey', '=', 'survey.id')
            ->select("rt_p2.*", "rt_p3.nama_desa", "rt_p3.nama_dusun", 'survey.tgl_mulai as survey_tgl_mulai', 'survey.tgl_akhir as survey_tgl_akhir')
            ->where('rt_p2.id_p3_rw', "=", $request->id_p3_rw)
            ->where('tgl_mulai', '<=', $now)
            ->where('tgl_akhir', '>=', $now)
            ->orderBy('rt_p2.tgl_buat', 'desc')
            ->get();


        // $data = RtP2M::orderBy('tgl_buat', 'desc')->where('id_p3_rw',"=",$request->id_p3_rw)->get();


        if ($data->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Belum ada data yang tersimpan',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            // p205
            'id_p4' => 'required|string|max:100',

            // p206
            // di p4
            // p207
            // di p4
            // p208
            // di p4

            // p209
            'lokasi_rt' => 'nullable|string',
            // p210
            'topografi' => 'required|in:1,2,3',

            // p211
            'jlm_warga_puncak' => 'nullable|integer|min:0',
            'tanam_pohon_lahan_kritis' => 'required|in:1,2,3',

            // p212
            'panjang_garis_pantai' => 'nullable|numeric|min:0',
            // p213
            'perikanan_tangkap' => 'required|in:1,2',
            // p214
            'perikanan_budidaya' => 'required|in:1,2',
            // p215
            'tambak_garam' => 'required|in:1,2',
            // p216
            'wisata_bahari' => 'required|in:1,2',
            // p217
            'transportasi_umum' => 'required|in:1,2',

            // p218
            'kondisi_mangrove' => 'required|in:1,2,3,4,5',
            // p219
            'penanaman_mangrove' => 'required|in:1,2,3',
            // p220
            'jlm_warga_pesisir' => 'nullable|integer|min:0',
            // p221
            'jlm_warga_diatas_air' => 'nullable|integer|min:0',

            // p222
            'wilayah_desa_dlm_hutan' => 'nullable|numeric|min:0',
            // p223
            'wilayah_desa_tepi_hutan' => 'nullable|numeric|min:0',

            // p224
            'fungsi_hutan_konservasi' => 'nullable|numeric|min:0',
            'fungsi_hutan_lindung' => 'nullable|numeric|min:0',
            'fungsi_hutan_produksi' => 'nullable|numeric|min:0',
            'fungsi_hutan_desa' => 'nullable|numeric|min:0',

            // p225
            'jlm_warga_dlm_hutan' => 'nullable|integer|min:0',
            // p226
            'jlm_warga_sekitar_hutan' => 'nullable|integer|min:0',
            // p227
            'ketergantungan_hutan' => 'required|in:1,2,3,4',
            // p228
            'reboisasi_hutan' => 'required|in:1,2,3',

            // Audit
            'id_buat' => 'required|string|max:25',
        ]);

        $now = Carbon::now();
        $survey = Survey::where('tgl_mulai', '<=', $now)
            ->where('tgl_akhir', '>=', $now)
            ->first();

        if (!$survey) {
            return response()->json([
                'status' => false,
                'message' => 'Saat ini tidak memasuki periode survei manapun',
            ], 400);
        }

        // $existing = RtP2M::where('rt', $validated['rt'])
        //     ->where('id_survey', $survey->id)
        //     ->first();

        // $existing = DB::table('rt_p2')->join('rt_p3', 'rt_p2.id_p3_rw', "=", "rt_p3.id")
        //     ->select('rt_p3.nama_rw', 'rt_p3.id')
        //     ->where('rt_p3.id', $validated['id_p3_rw'])
        //     ->where('rt_p2.rt', $validated['rt'])
        //     ->first();


        // if ($existing) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Data RT ' . $validated['rt'] . ' RW ' . $existing->nama_rw . ' sudah ada untuk periode survei berjalan',
        //     ], 409);
        // }

        $id = 'RTP2-' . strtotime(now());

        $data = RtP2M::create(array_merge($validated, [
            'id' => $id,
            'id_update' => null,
            'tgl_buat' => now(),
            'tgl_update' => null,
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
            'data' => [
                'id' => $data->id,
                'id_survey' => $survey->id,
                'tgl_buat' => $data->tgl_buat,
            ],
        ], 201);
    }

    public function show(string $idP4)
    {
        $data = RtP2M::where('id_p4', $idP4)->first();
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $data,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = RtP2M::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => $data,
            ], 404);
        }

        // validasi input
        $validated = $request->validate([

            // p205
            'id_p4' => 'required|string|max:100',

            // p206
            // di p4
            // p207
            // di p4
            // p208
            // di p4

            // p209
           'lokasi_rt' => 'nullable|string',
            // p210
            'topografi' => 'required|in:1,2,3',

            // p211
            'jlm_warga_puncak' => 'nullable|integer|min:0',
            'tanam_pohon_lahan_kritis' => 'required|in:1,2,3',

            // p212
            'panjang_garis_pantai' => 'nullable|numeric|min:0',
            // p213
            'perikanan_tangkap' => 'required|in:1,2',
            // p214
            'perikanan_budidaya' => 'required|in:1,2',
            // p215
            'tambak_garam' => 'required|in:1,2',
            // p216
            'wisata_bahari' => 'required|in:1,2',
            // p217
            'transportasi_umum' => 'required|in:1,2',

            // p218
            'kondisi_mangrove' => 'required|in:1,2,3,4,5',
            // p219
            'penanaman_mangrove' => 'required|in:1,2,3',
            // p220
            'jlm_warga_pesisir' => 'nullable|integer|min:0',
            // p221
            'jlm_warga_diatas_air' => 'nullable|integer|min:0',

            // p222
            'wilayah_desa_dlm_hutan' => 'nullable|numeric|min:0',
            // p223
            'wilayah_desa_tepi_hutan' => 'nullable|numeric|min:0',

            // p224
            'fungsi_hutan_konservasi' => 'nullable|numeric|min:0',
            'fungsi_hutan_lindung' => 'nullable|numeric|min:0',
            'fungsi_hutan_produksi' => 'nullable|numeric|min:0',
            'fungsi_hutan_desa' => 'nullable|numeric|min:0',

            // p225
            'jlm_warga_dlm_hutan' => 'nullable|integer|min:0',
            // p226
            'jlm_warga_sekitar_hutan' => 'nullable|integer|min:0',
            // p227
            'ketergantungan_hutan' => 'required|in:1,2,3,4',
            // p228
            'reboisasi_hutan' => 'required|in:1,2,3',

            'id_update' => 'required|string|max:25',
        ]);

        $now = Carbon::now();
        $survey = Survey::where('tgl_mulai', '<=', $now)
            ->where('tgl_akhir', '>=', $now)
            ->first();

        if (!$survey) {
            return response()->json([
                'status' => false,
                'message' => 'Saat ini tidak memasuki periode survei manapun',
            ], 400);
        }

        // $existing = DB::table('rt_p2')->join('rt_p3', 'rt_p2.id_p3_rw', "=", "rt_p3.id")
        //     ->select('rt_p3.nama_rw', 'rt_p3.id')
        //     ->where('rt_p3.id', $validated['id_p3_rw'])
        //     ->where('rt_p2.rt', $validated['rt'])
        //     ->where('rt_p2.id', '!=', $data->id)
        //     ->first();

        // if ($existing) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Data RT ' . $validated['rt'] . ' RW ' . $existing->nama_rw . ' sudah ada untuk periode survei berjalan',
        //     ], 409);
        // }
        // merge data
        $data->update(array_merge($validated, [
            'tgl_update' => now(),
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $data,
        ]);
    }


    public function destroy(string $idP4)
    {
       $data = RtP2M::where('id_p4', $idP4)->first();

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data yang akan di hapus tidak ditemukan',
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
