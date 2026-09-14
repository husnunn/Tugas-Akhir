<?php

namespace App\Http\Controllers\Api\RT\P3;

use Carbon\Carbon;
use App\Models\Wilayah;
use App\Models\RT\P3\RtP3M;
use Illuminate\Http\Request;
use App\Models\Survey\Survey;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Support\PublicUploadPath;
use Illuminate\Auth\Events\Validated;

class P3RtController extends Controller
{

    public function index()
    {
        $now = Carbon::now();
        $data = DB::table('rt_p3')
            ->join('survey', 'rt_p3.id_survey', '=', 'survey.id')
            ->select('rt_p3.*', 'rt_p3.id as id_p3', 'survey.tgl_mulai', 'survey.tgl_akhir')
            ->where('tgl_mulai', '<=', $now)
            ->where('tgl_akhir', '>=', $now)
            ->orderBy('rt_p3.tgl_buat', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Belum ada data yang tersimpan pada periode survey aktif',
            ]);
        }

        $kodes = [];
        foreach ($data as $item) {
            $kodes[] = $item->kode_provinsi;
            $kodes[] = $item->kode_kabupaten;
            $kodes[] = $item->kode_kecamatan;
            $kodes[] = $item->kode_desa;
        }
        $kodes = array_unique($kodes);


        $wilayah = DB::table('wilayah')
            ->whereIn('kode', $kodes)
            ->get();

        $data->transform(function ($item) use ($wilayah) {
            $item->nama_provinsi = $wilayah->firstWhere('kode', $item->kode_provinsi)?->nama;
            $item->nama_kabupaten = $wilayah->firstWhere('kode', $item->kode_kabupaten)?->nama;
            $item->nama_kecamatan = $wilayah->firstWhere('kode', $item->kode_kecamatan)?->nama;
            $item->nama_desa = $wilayah->firstWhere('kode', $item->kode_desa)?->nama;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            //custom
            'nama_rw' => 'required|integer|min:1',
            'foto_ket_rw' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // p201
            'kode_provinsi' => 'required|string|max:5',
            // p202
            'kode_kabupaten' => 'required|string|max:10',
            // p203
            'kode_kecamatan' => 'required|string|max:10',
            // p204
            'kode_desa' => 'required|string|max:15',
            'nama_desa' => 'required|string|max:100',
            'nama_dusun' => 'required|string|max:100',

            // p301
            'nama_ket_rw' => 'required|string|max:100',
            // p302
            'nik_ket_rw' => 'required|string|size:16',
            // p303
            'hp_ket_rw' => 'required|string|max:15',
            // p304
            'tahun_jabat_ket_rw' => 'required|date',

            // p305
            'nama_sek_rw' => 'nullable|string|max:100',
            // p306
            'nik_sek_rw' => 'nullable|string|size:16',
            // p307
            'hp_sek_rw' => 'nullable|string|max:15',
            // p308
            'tahun_jabat_sek_rw' => 'nullable|date',

            // p309
            'nama_bend_rw' => 'nullable|string|max:100',
            // p310
            'nik_bend_rw' => 'nullable|string|size:16',
            // p311
            'hp_bend_rw' => 'nullable|string|max:15',
            // p312
            'tahun_jabat_bend_rw' => 'nullable|date',

            // audit
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
        $existing = RtP3M::where('nama_rw', $validated['nama_rw'])
            ->where('nama_dusun', $validated['nama_dusun'])
            ->where('kode_provinsi', $validated["kode_provinsi"])
            ->where('kode_kabupaten', $validated["kode_kabupaten"])
            ->where('kode_kecamatan', $validated["kode_kecamatan"])
            ->where('kode_desa', $validated["kode_desa"])
            ->where('id_survey', $survey->id)
            ->first();

        // $existing = RtP3M::where('nama_rw', $validated['nama_rw'])
        //     ->where('nama_dusun', $validated['nama_dusun'])
        //     ->where('id_survey', $survey->id)
        //     ->first();

        if ($existing) {
            return response()->json([
                'status' => false,
                'message' => 'Data RW ini sudah ada untuk periode survei berjalan',
            ], 409);
        }

        $id = 'RTP3-' . strtotime(now());

        $data = RtP3M::create(array_merge($validated, [
            'id' => $id,
            'id_update' => null,
            'tgl_buat' => now(),
            'tgl_update' => null,
            'id_survey' => $survey->id,
        ]));

        if ($request->hasFile('foto_ket_rw')) {
            $folderPath = PublicUploadPath::ensure('uploads/rt_p3');

            $foto = $request->file('foto_ket_rw');
            $fileName = 'foto_ket_rw_' . $id . '.' . $foto->getClientOriginalExtension();
            $foto->move($folderPath, $fileName);
        }

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

    public function show(string $id)
    {
        $data = RtP3M::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $data->provinsiOptions = Wilayah::whereRaw('LENGTH(kode) = 2')->get();
        $data->kabupatenOptions = Wilayah::where('kode', 'like', $data->kode_provinsi . '.%')
            ->whereRaw('LENGTH(kode) = 5')
            ->get();
        $data->kecamatanOptions = Wilayah::where('kode', 'like', $data->kode_kabupaten . '.%')
            ->whereRaw('LENGTH(kode) = 8')
            ->get();
        $data->desaOptions = Wilayah::where('kode', 'like', $data->kode_kecamatan . '.%')
            ->whereRaw('LENGTH(kode) = 13')
            ->get();
        $folderPath = PublicUploadPath::ensure('uploads/rt_p3');
        $fotoUrl = null;
        if (File::exists($folderPath)) {

            $pattern = $folderPath . '/foto_ket_rw_' . $data->id . '.*';
            $files = File::glob($pattern);

            if (!empty($files)) {

                $fileName = basename($files[0]);
                $fotoUrl = secure_asset('uploads/rt_p3/' . $fileName);
            }
        }
        $data->foto_ket_rw = $fotoUrl;

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => [$data],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = RtP3M::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data yang akan di update tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([

            //custom
            'nama_rw' => 'required|integer|min:1',
            'foto_ket_rw' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_sebelum_update' => 'required|integer|min:1',
            // p201
            'kode_provinsi' => 'required|string|max:5',
            // p202
            'kode_kabupaten' => 'required|string|max:10',
            // p203
            'kode_kecamatan' => 'required|string|max:10',
            // p204
            'kode_desa' => 'required|string|max:15',
            'nama_desa' => 'required|string|max:100',
            'nama_dusun' => 'required|string|max:100',

            // p301
            'nama_ket_rw' => 'required|string|max:100',
            // p302
            'nik_ket_rw' => 'required|string|size:16',
            // p303
            'hp_ket_rw' => 'required|string|max:15',
            // p304
            'tahun_jabat_ket_rw' => 'required|date',

            // p305
            'nama_sek_rw' => 'nullable|string|max:100',
            // p306
            'nik_sek_rw' => 'nullable|string|size:16',
            // p307
            'hp_sek_rw' => 'nullable|string|max:15',
            // p308
            'tahun_jabat_sek_rw' => 'nullable|date',

            // p309
            'nama_bend_rw' => 'nullable|string|max:100',
            // p310
            'nik_bend_rw' => 'nullable|string|size:16',
            // p311
            'hp_bend_rw' => 'nullable|string|max:15',
            // p312
            'tahun_jabat_bend_rw' => 'nullable|date',

            // audit
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

        $existing = RtP3M::where('nama_rw', $validated['nama_rw'])
            ->where('nama_dusun', $validated['nama_dusun'])
            ->where('kode_provinsi', $validated["kode_provinsi"])
            ->where('kode_kabupaten', $validated["kode_kabupaten"])
            ->where('kode_kecamatan', $validated["kode_kecamatan"])
            ->where('kode_desa', $validated["kode_desa"])
            ->where('id_survey', $survey->id)
            ->where('id', '!=', $data->id)
            ->first();

        if ($existing) {
            return response()->json([
                'status' => false,
                'message' => 'Data RW ini sudah ada untuk periode survei berjalan',
            ], 409);
        }

        unset($validated["nama_sebelum_update"]);

        $data->update(array_merge($validated, [
            'tgl_update' => now(),
        ]));

        $folderPath = PublicUploadPath::ensure('uploads/rt_p3');
        $filePattern = $folderPath . '/foto_ket_rw_' . $data->id . '.*';

        if ($request->hasFile('foto_ket_rw')) {

            $oldFiles = File::glob($filePattern);
            foreach ($oldFiles as $oldFile) {
                File::delete($oldFile);
            }

            $foto = $request->file('foto_ket_rw');
            $fileName = 'foto_ket_rw_' . $data->id . '.' . $foto->getClientOriginalExtension();
            $foto->move($folderPath, $fileName);
        } else {
            // $validated['foto_ket_rw'] = $data->foto_ket_rw;

            $oldFiles = File::glob($filePattern);
            foreach ($oldFiles as $oldFile) {
                File::delete($oldFile);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $data,
        ]);
    }

    public function destroy(string $id)
    {
        $data = RtP3M::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data yang akan di hapus tidak ditemukan',
            ], 404);
        }

        $data->delete();

        $folderPath = PublicUploadPath::ensure('uploads/rt_p5');
        $filePattern = $folderPath . '/foto_ket_rw_' . $data->id . '.*';
        $oldFiles = File::glob($filePattern);
        foreach ($oldFiles as $oldFile) {
            File::delete($oldFile);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
