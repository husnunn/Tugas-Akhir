<?php

namespace App\Http\Controllers\Desa\P5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Desa\P5\P501;
use App\Models\Desa\P5\P5;
use Illuminate\Support\Facades\Log;

class P501Controller extends Controller
{
    public function index($id_p5)
    {
        $p5 = P5::findOrFail($id_p5);
        $data = P501::where('id_desa_p5', $p5->id)->get();

        return view('pages.desa.forms.p501', compact('p5', 'data'));
    }

    public function store(Request $request)
    {
        $idDesaP5 = $request->id_desa_p5; // hidden input dari form
        $idSurvey = session('id_survey'); // bisa juga ambil dari relasi kalau perlu

        try {
            DB::beginTransaction();
            $request->validate([
                'dokumen_peraturan_desa' => 'required|file|mimes:pdf',
            ]);
            $idOtomatis = "DSP501-" . strtotime(date("Y-m-d H:i:s"));
            if ($request->hasFile('dokumen_peraturan_desa')) {
                $file = $request->file('dokumen_peraturan_desa');
                $filename = $idOtomatis . '.pdf';
                // Simpan ke folder public/dokumen/musyawarah/
                $file->move(public_path('dokumen/p5/peraturan_desa'), $filename);
            }

            P501::create([
                'id' => $idOtomatis,
                'id_desa_p5' => $idDesaP5,
                'id_survey' => $idSurvey,
                'no_dokumen' => $request->no_dokumen,
                'bulan' => $request->bulan,
                'tentang' => $request->tentang,
                // 'dokumen_peraturan_desa' => $filePath,
                'id_buat' => Auth::user()->id,
                'tgl_buat' => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data P501 berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error:', $e->getMessage());
            Log::error('Gagal menyimpan p501: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $dataUtama = P501::findOrFail($id);

        $request->validate([
            'dokumen_peraturan_desa' => 'nullable|file|mimes:pdf',
        ]);

        if ($request->hasFile('dokumen_peraturan_desa')) {

            if ($dataUtama->dokumen_peraturan_desa) {
                $oldPath = public_path('dokumen/p5/peraturan_desa/' . $dataUtama->dokumen_peraturan_desa);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // hapus file
                }
            }

            $file = $request->file('dokumen_peraturan_desa');
            $filename = $id . ".pdf";
            $file->move(public_path('dokumen/p5/peraturan_desa'), $filename);

        }

        $dataUtama->update($request->all());

        return redirect()->back()->with('success', 'Data utama P501 berhasil diperbarui.');
    }

    public function destroy($id)
    {
        P501::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data P501 berhasil dihapus.');
    }

    public function fromP2($id_survey)
    {
        $p5 = \App\Models\Desa\P5\P5::where('id_survey', $id_survey)->first();

        if (!$p5) {
            return redirect()->back()->with('error', 'Data P5 belum dibuat untuk desa ini.');
        }

        return redirect()->route('desa-p501.index', $p5->id);
    }
}
