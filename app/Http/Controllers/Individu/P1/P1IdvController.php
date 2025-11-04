<?php

namespace App\Http\Controllers\Individu\P1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Individu\P1\IdvP1M;
use Illuminate\Support\Facades\Auth;
use App\Models\Survey\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class P1IdvController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $survey = Survey::whereDate('tgl_mulai', '<=', $today)
            ->whereDate('tgl_akhir', '>=', $today)
            ->get();

        $data = IdvP1M::with('survey')->get();
        // dd($data);
        return view('pages.individu.individu', compact('data', 'survey'));
    }


    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        // Ambil tanggal hari ini
        $today = Carbon::today()->toDateString();

        $survey = Survey::whereDate('tgl_mulai', '<=', $today)
            ->whereDate('tgl_akhir', '>=', $today)
            ->first();

        if (!$survey) {
            return back()->with('error', 'Tidak ada survey aktif untuk hari ini.');
        }
        $request->validate([
            'no_kk' => 'required|string',
            'nik' => 'required|string',
        ]);

        try {
            $individu = IdvP1M::create([
                'id' => "IDV-" . strtotime(date("Y-m-d H:i:s")),
                'id_buat' => $userId,
                'id_survey' => $survey->id,
                'tgl_buat' => now(),
                'tgl_update' => now(),

                // Data dari form
                'no_kk' => $request->no_kk,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'status_pernikahan' => $request->status_pernikahan,
                'agama' => $request->agama,
                'suku_bangsa' => $request->suku_bangsa,
                'warganegara' => $request->warganegara,
                'no_hp' => $request->no_hp,
                'no_wa' => $request->no_wa,
                'url_email_pribadi' => $request->email,
                'url_facebook_pribadi' => $request->facebook,
                'url_twitter_pribadi' => $request->twitter,
                'url_instagram_pribadi' => $request->instagram,
            ]);

            return redirect()->back()->with('success', 'Data individu berhasil ditambahkan!');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd('Error:', $e->getMessage());
            Log::error('Gagal menyimpan p5: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }

    public function show(string $id)
    {
        $data = IdvP1M::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        // dd($id);
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

        return redirect()->back()->with('success', 'Data individu berhasil diperbarui');
    }

    public function destroy($id)
    {
        IdvP1M::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data individu P1 berhasil dihapus.');
    }
}
