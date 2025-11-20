<?php

namespace App\Http\Controllers\Desa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Desa\DesaP2;
use Illuminate\Support\Facades\Auth;
use App\Models\Survey\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\Desa\P3\PegawaiLainnya;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DesaController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Ambil survey yang sedang aktif hari ini
        $survey = Survey::whereDate('tgl_mulai', '<=', $today)
            ->whereDate('tgl_akhir', '>=', $today)
            ->get();
        // $desa = DesaP2::all();
        $desa = DesaP2::with('survey')->get();
        $pegawai = PegawaiLainnya::where('id_desa_p3', session('id_desa_p3'))->get();
        return view('pages.desa.desa', compact('desa', 'survey', 'pegawai'));
    }

    public function show_survey()
    {
        $today = Carbon::today();

        $survey = Survey::whereDate('tgl_mulai', '<=', $today)
            ->whereDate('tgl_akhir', '>=', $today)
            ->get();
        $desa = DesaP2::all();

        return view('pages.desa.forms.p2', compact('desa', 'survey'));
    }

    public function show_user()
    {
        // $data = DesaP2::all();
        // return response()->json($data);
        return view('pages.user.user');
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
        $userId = Auth::user()->id;
        $request->validate([
            'kode_provinsi' => 'required|string',
            'kode_kabupaten' => 'required|string',
            'kode_kecamatan' => 'required|string',
            'kode_desa' => 'required|string',
            // 'nama_desa' => 'required|string',
        ]);

        // Validasi lanjutan sesuai aturan kondisional
        if ($request->filled('no_sk_pendirian_desa') && !$request->filled('tgl_sk_pendirian_desa')) {
            return back()->withErrors(['tgl_sk_pendirian_desa' => 'Tanggal SK Pendirian Desa wajib diisi jika No SK diisi.'])->withInput();
        }

        if ($request->filled('no_sk_peta_desa') && !$request->filled('tgl_sk_peta_desa')) {
            return back()->withErrors(['tgl_sk_peta_desa' => 'Tanggal SK Peta Desa wajib diisi jika No SK diisi.'])->withInput();
        }

        if ($request->topografi == '1' && !$request->filled('jml_warga')) {
            return back()->withErrors(['jml_warga' => 'Jumlah warga wajib diisi jika topografi adalah Lereng/Puncak.'])->withInput();
        }

        if ($request->jam_kerja == '2' && (!$request->filled('mulai_pukul') || !$request->filled('akhir_pukul'))) {
            return back()->withErrors(['mulai_pukul' => 'Jam mulai dan akhir wajib diisi jika jam kerja memiliki jadwal.'])->withInput();
        }

        try {
            $namaDesa = DB::table('wilayah')
                ->where('kode', $request->kode_desa)
                ->value('nama');

            $desa = DesaP2::create([
                'id' => "DSP2-" . strtotime(date("Y-m-d H:i:s")),
                'id_survey' => $survey->id,
                'id_buat' => $userId,
                'tgl_buat' => now(),
                'tgl_update' => now(),

                // Data dari form
                'kode_provinsi' => $request->kode_provinsi,
                'kode_kabupaten' => $request->kode_kabupaten,
                'kode_kecamatan' => $request->kode_kecamatan,
                'kode_desa' => $request->kode_desa,

                // Otomatis isi nama desa
                'nama_desa' => $namaDesa,

            ]);

            // return response()->json([
            //     'status' => true,
            //     'data' => $desa,
            // ], 201);
            return redirect()->back()->with('success', 'Data Desa berhasil ditambahkan!');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd('Error:', $e->getMessage());
            Log::error('Gagal menyimpan p5: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }

    public function show(string $id)
    {
        $desa = DesaP2::findOrFail($id);
        return response()->json($desa);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::user()->id;

        $request->validate([
            // 'id_survey' => 'required|string|max:25',
            'kode_provinsi' => 'required|string',
            'kode_kabupaten' => 'required|string',
            'kode_kecamatan' => 'required|string',
            'kode_desa' => 'required|string',
            // 'nama_desa' => 'required|string',
        ]);
        try {
            DB::beginTransaction();

            $namaDesa = DB::table('wilayah')
                ->where('kode', $request->kode_desa)
                ->value('nama');

            $desa = DesaP2::findOrFail($id);

            $desa->update([
                'kode_provinsi' => $request->kode_provinsi,
                'kode_kabupaten' => $request->kode_kabupaten,
                'kode_kecamatan' => $request->kode_kecamatan,
                'kode_desa' => $request->kode_desa,
                'nama_desa' => $namaDesa,
                'email' => $request->email,
                'url_web' => $request->url_web,
                'url_facebook' => $request->url_facebook,
                'url_twitter' => $request->url_twitter,
                'url_instagram' => $request->url_instagram,
                'url_youtube' => $request->url_youtube,
                'status_pemerintahan' => $request->status_pemerintahan,
                'jml_rw' => $request->jml_rw,
                'jml_rt' => $request->jml_rt,
                'no_sk_pendirian_desa' => $request->no_sk_pendirian_desa,
                'tgl_sk_pendirian_desa' => $request->tgl_sk_pendirian_desa,
                'no_sk_peta_desa' => $request->no_sk_peta_desa,
                'tgl_sk_peta_desa' => $request->tgl_sk_peta_desa,
                'luas_wilayah' => $request->luas_wilayah,
                'lokasi_desa' => $request->lokasi_desa,
                'topografi' => $request->topografi,
                'jml_warga' => $request->jml_warga,
                'balai_desa' => $request->balai_desa,
                'kepemilikan' => $request->kepemilikan,
                'lokasi_balai_desa' => $request->lokasi_balai_desa,
                'tempat_pemerintah_desa' => $request->tempat_pemerintah_desa,
                'jam_kerja' => $request->jam_kerja,
                'mulai_pukul' => $request->mulai_pukul,
                'akhir_pukul' => $request->akhir_pukul,
                'lintang' => $request->lintang,
                'bujur' => $request->bujur,
                'ketinggian_lok' => $request->ketinggian_lok,
                'pjg_garis_pantai' => $request->pjg_garis_pantai,
                'id_update' => $userId,
                'tgl_update' => now(),
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data Desa berhasil diperbarui!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Gagal update desa-p2: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }
    }

    public function destroy(string $id)
    {
        $p2 = DesaP2::findOrFail($id);

        // Ambil semua kolom kecuali primary key dan id_survey
        $dataP2 = $p2->toArray();
        unset($dataP2['id'], $dataP2['id_survey']);

        // Cek apakah semua nilainya NULL atau kosong
        $isEmpty = true;
        foreach ($dataP2 as $value) {
            if (!is_null($value) && $value !== '') {
                $isEmpty = false;
                break;
            }
        }

        // Kalau ada isi → blok hapus
        if (!$isEmpty) {
            return back()->with('error', 'Data Desa P2 tidak dapat dihapus karena masih memiliki data isian.');
        }

        // Kalau kosong → hapus aman
        $p2->delete();

        return back()->with('success', 'Data Desa P2 berhasil dihapus karena tidak memiliki isian.');
    }

    public function setSession(Request $request)
    {
        try {
            session([
                'id_desa' => $request->id_desa,
                'id_survey' => $request->id_survey
            ]);

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
