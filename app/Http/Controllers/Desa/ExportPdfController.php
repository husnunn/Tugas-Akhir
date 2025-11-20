<?php

namespace App\Http\Controllers\Desa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


// Semua model
use App\Models\Desa\DesaP2 as p2;
use App\Models\Desa\P3\P3;
use App\Models\Desa\P3\PegawaiLainnya;
use App\Models\Desa\P3\AnggotaBpd;
use App\Models\Desa\P4\P4;
use App\Models\Desa\P5\P5;
use App\Models\Desa\P5\P501;
use App\Models\Desa\P5\P502;
use App\Models\Desa\P5\P503;
use App\Models\Desa\P6\P601;
use App\Models\Desa\P6\P602;
use App\Models\Desa\P6\P603;
use App\Models\Desa\P7\P7;
use App\Models\Desa\P7\P705;
use App\Models\Desa\P8\P8;
use App\Models\Desa\P9\P9;
use App\Models\Desa\P9\P914;
use App\Models\Desa\P9\P923;
use App\Models\Desa\P9\P932;
use App\Models\Desa\P9\P941;
use App\Models\Desa\P10\P10;

class ExportPdfController extends Controller
{
    public function export($id_survey)
    {
        // Ambil ID P3 dulu
        $p3 = P3::where('id_survey', $id_survey)->first();
        $id_desa_p3 = $p3?->id; // null-safe operator

        // Ambil pegawai lainnya dan anggota BPD berdasarkan id_desa_p3
        $pegawai = $id_desa_p3
            ? PegawaiLainnya::where('id_desa_p3', $id_desa_p3)->get()
            : collect();

        $bpd = $id_desa_p3
            ? AnggotaBpd::where('id_desa_p3', $id_desa_p3)->get()
            : collect();
        // Ambil ID P3 dulu
        $p9 = P9::where('id_survey', $id_survey)->first();
        $id_desa_p9 = $p9?->id; // null-safe operator

        // Ambil pegawai lainnya dan anggota BPD berdasarkan id_desa_p3
        $p914 = $id_desa_p9
            ? P914::where('id_desa_p9', $id_desa_p9)->get()
            : collect();

        $p923 = $id_desa_p9
            ? P923::where('id_desa_p9', $id_desa_p9)->get()
            : collect();
        $p932 = $id_desa_p9
            ? P932::where('id_desa_p9', $id_desa_p9)->get()
            : collect();
        $p941 = $id_desa_p9
            ? P941::where('id_desa_p9', $id_desa_p9)->get()
            : collect();

        // Ambil semua data berdasarkan ID survey
        $data = [
            'p2'   => P2::where('id_survey', $id_survey)->first(),
            'p3'   => $p3, // sudah ambil di atas
            'pegawai' => $pegawai,
            'bpd' => $bpd,
            'p4'   => P4::where('id_survey', $id_survey)->get(),
            'p5'   => P5::where('id_survey', $id_survey)->first(),
            'p501' => P501::where('id_survey', $id_survey)->get(),
            'p502' => P502::where('id_survey', $id_survey)->get(),
            'p503' => P503::where('id_survey', $id_survey)->get(),
            'p601' => P601::where('id_survey', $id_survey)->first(),
            'p602' => P602::where('id_survey', $id_survey)->first(),
            'p603' => P603::where('id_survey', $id_survey)->get(), // collection
            'p7'   => P7::where('id_survey', $id_survey)->first(),
            'p705' => P705::where('id_survey', $id_survey)->get(),
            'p8'   => P8::where('id_survey', $id_survey)->get(),
            'p9'   => P9::where('id_survey', $id_survey)->first(),
            'p914' => $p914,
            'p923' => $p923,
            'p932' => $p932,
            'p941' => $p941,
            'p10'  => P10::where('id_survey', $id_survey)->get(),
        ];

        // load view PDF
        $pdf = PDF::loadView('pages.desa.export.pdf', $data);

        return $pdf->download("sdgs-desa-$id_survey.pdf");
    }
}
