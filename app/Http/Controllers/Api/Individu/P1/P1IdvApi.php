<?php

namespace App\Http\Controllers\Api\Individu\P1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Individu\P1\IdvP1M;
use App\Models\Survey\Survey;
use Illuminate\Support\Facades\Auth;


class P1IdvApi extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $survey = Survey::whereDate('tgl_mulai', '<=', $today)
            ->whereDate('tgl_akhir', '>=', $today)
            ->first();

        $data = IdvP1M::where('id_buat',  Auth::user()->id)
            ->orderBy('tgl_buat', 'DESC')
            ->get();

        return response()->json([
            'status' => true,
            'survey_aktif' => $survey,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        // Ambil tanggal hari ini
        $today = Carbon::today()->toDateString();

        // Cari survey yang aktif di hari ini
        $survey = Survey::whereDate('tgl_mulai', '<=', $today)
            ->whereDate('tgl_akhir', '>=', $today)
            ->first();

        if (!$survey) {
            return back()->with('error', 'Tidak ada survey aktif untuk hari ini.');
        }

        // CEK NIK SUDAH ADA ATAU BELUM
        $nikExists = IdvP1M::where('nik', $request->nik)->exists();

        if ($nikExists) {
            return back()->with('error', 'NIK sudah ada, tidak boleh sama.');
        }

        $today = Carbon::now();

        // Simpan data
        $data = IdvP1M::create([
            'id' => "IDVP1-" . strtotime(date("Y-m-d H:i:s")),
            'id_survey' => $survey->id,
            'id_buat' => Auth::user()->id,
            'id_update' => Auth::user()->id,
            'tgl_buat' => $today,
            'tgl_update' => $today,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin ?? null,
            'tempat_lahir' => $request->tempat_lahir ?? '',
            'tgl_lahir' => $request->tgl_lahir ?? null,
            'status_pernikahan' => $request->status_pernikahan ?? null,
            'agama' => $request->agama ?? null,
            'suku_bangsa' => $request->suku_bangsa ?? '',
            'warganegara' => $request->warganegara ?? null,
            'no_hp' => $request->no_hp ?? '',
            'no_wa' => $request->no_wa ?? '',
            'url_email_pribadi' => $request->url_email_pribadi ?? '',
            'url_facebook_pribadi' => $request->url_facebook_pribadi ?? '',
            'url_twitter_pribadi' => $request->url_twitter_pribadi ?? '',
            'url_instagram_pribadi' => $request->url_instagram_pribadi ?? '',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Individu berhasil disimpan',
            'data' => $data
        ]);
    }


    public function show($id)
    {
        $data = IdvP1M::with('survey')->find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = IdvP1M::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->update(array_merge(
            $request->all(),
            ['id_update' => Auth::user()->id, 'tgl_update' => Carbon::now()]
        ));

        return response()->json([
            'status' => true,
            'message' => 'Data Individu berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = IdvP1M::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data keluarga berhasil dihapus'
        ]);
    }
}
