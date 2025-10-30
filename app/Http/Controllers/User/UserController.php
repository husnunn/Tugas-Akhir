<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('jabatan')->get();
        return view('pages.user.user', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|string|max:100",
            "username" => "required|string|unique:user|max:50",
            "hp" => "required",
            "id_jabatan" => "required|string|max:100",
            "status" => "required|string",
            "password" => "required|confirmed",
            "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $fotoPath = $request->file('foto')->storeAs('foto_users', $filename, 'public');
        }

        try {
            $id = strtotime(date("Y-m-d H:i:s"));
            $hp = $request->hp;

            if (Str::startsWith($hp, '08')) {
                $hp = '62' . substr($hp, 1);
            }

            // dd($request->all()); 
            // Simpan
            $user = User::create([
                "id" => $id,
                "nama" => $request->nama,
                "username" => $request->username,
                "hp" => $hp,
                "id_jabatan" => $request->id_jabatan,
                "status" => $request->status,
                "password" => bcrypt($request->password),
                "foto" => $fotoPath,
                "id_buat" => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            "nama" => "required|string|max:100",
            "username" => "required|string|unique:user,username," . $id . ",id|max:50",
            "hp" => "required",
            "id_jabatan" => "required|string|max:100",
            "status" => "required|string",
            "password" => "nullable|confirmed",
            "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        // Konversi no HP 08 → 62
        $hp = $request->hp;
        if (Str::startsWith($hp, '08')) {
            $hp = '62' . substr($hp, 1);
        }

        // Upload file baru jika ada
        $fotoPath = $user->foto;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_users', 'public');
        }

        // Update field satu per satu agar aman
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'hp' => $hp,
            'id_jabatan' => $request->id_jabatan,
            'status' => $request->status,
            'foto' => $fotoPath,
            // hanya update password jika diisi
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'id_update' => Auth::user()->id,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        User::destroy($id);

        return back()->with('success', 'Data User berhasil dihapus.');
    }
}
