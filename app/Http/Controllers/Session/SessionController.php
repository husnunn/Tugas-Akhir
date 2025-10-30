<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Desa\DesaP2;

class SessionController extends Controller
{
    public function set($id, $form)
    {
        $p2 = DesaP2::findOrFail($id);

        // Simpan ke session
        session([
            'id_survey' => $p2->id_survey,
            'id_desa'   => $p2->id,
        ]);

        // Tentukan route tujuan berdasarkan form
        $redirectRoute = match ($form) {
            'p3'  => 'desa-p3.index',
            'p4'  => 'desa-p4.index',
            'p5'  => 'desa-p5.index',
            'p601'  => 'desa-p601.index',
            'p602'  => 'desa-p602.index',
            'p603'  => 'desa-p603.index',
            'p7'  => 'desa-p7.index',
            'p8'  => 'desa-p8.index',
            'p9'  => 'desa-p9.index',
            'p10' => 'desa-p10.index',
            default => 'dashboard',
        };

        return redirect()->route($redirectRoute);
    }
}
