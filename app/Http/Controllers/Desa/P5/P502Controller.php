<?php

namespace App\Http\Controllers\Desa\P5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Desa\P5\P502;
use App\Models\Desa\P5\P5;
use Illuminate\Support\Facades\Log;

class P502Controller extends Controller
{
    public function index($id_p5)
    {
        $p5 = P5::findOrFail($id_p5);
        $data = P502::where('id_desa_p5', $p5->id)->get();
        // dd($id_p5);
        return view('pages.desa.forms.p502', compact('p5', 'data'));
    }

    public function store(Request $request)
    {
        $idDesaP5 = $request->id_desa_p5; // hidden input dari form
        $idSurvey = session('id_survey'); // bisa juga ambil dari relasi kalau perlu

        try {
            DB::beginTransaction();
            $request->validate([
                'dokumen_peraturan_kepdes' => 'required|file|mimes:pdf',
            ]);
            $idOtomatis = "DSP502-" . strtotime(date("Y-m-d H:i:s"));
            if ($request->hasFile('dokumen_peraturan_kepdes')) {
                $file = $request->file('dokumen_peraturan_kepdes');
                $filename = $idOtomatis . '.pdf';
                // Simpan ke folder public/dokumen/musyawarah/
                $file->move(public_path('dokumen/p5/peraturan_kepdes'), $filename);
            }

            P502::create([
                'id'                        => $idOtomatis,
                'id_desa_p5'                => $idDesaP5,
                'id_survey'                 => $idSurvey,
                'no_dokumen'                => $request->no_dokumen,
                'bulan'                     => $request->bulan,
                'tentang'                   => $request->tentang,
                // 'dokumen_peraturan_kepdes'    => $filePath,
                'id_buat'                   => Auth::user()->id,
                'tgl_buat'                  => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data P502 berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error:', $e->getMessage());
            Log::error('Gagal menyimpan P502: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $dataUtama = P502::findOrFail($id);
        $request->validate([
            'dokumen_peraturan_kepdes' => 'nullable|file|mimes:pdf',
        ]);

        if ($request->hasFile('dokumen_peraturan_kepdes')) {

            if ($dataUtama->dokumen_peraturan_kepdes) {
                $oldPath = public_path('dokumen/p5/peraturan_kepdes/' . $dataUtama->dokumen_peraturan_kepdes);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // hapus file
                }
            }

            $file = $request->file('dokumen_peraturan_kepdes');
            $filename = $id . ".pdf";
            $file->move(public_path('dokumen/p5/peraturan_kepdes'), $filename);
        }
        $dataUtama->update($request->all());

        return redirect()->back()->with('success', 'Data utama P502 berhasil diperbarui.');
    }

    public function destroy($id)
    {
        P502::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data P502 berhasil dihapus.');
    }

    public function fromP2($id_survey)
    {
        $p5 = \App\Models\Desa\P5\P5::where('id_survey', $id_survey)->first();

        if (!$p5) {
            return redirect()->back()->with('error', 'Data P5 belum dibuat untuk desa ini.');
        }

        return redirect()->route('desa-p502.index', $p5->id);
    }
}
