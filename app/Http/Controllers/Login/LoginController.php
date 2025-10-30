<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     public function showLogin()
    {
        return view('pages.login'); // menampilkan Blade login kamu
    }

   public function login(Request $request)
    {
        $isWebRequest = !$request->expectsJson(); // Deteksi apakah request dari form biasa

        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            if ($isWebRequest) {
                return back()->withErrors($validator)->withInput();
            }

            return response()->json([
                "status" => false,
                "message" => $validator->errors()->first()
            ], 401);
        }

        // Ambil user berdasarkan username
        $user = User::where("username", $request->username)->first();

        // Cek username dan password
        if (!$user || !Hash::check($request->password, $user->password)) {
            $errorMsg = 'Username atau password salah.';
            return $isWebRequest
                ? back()->withErrors(['username' => $errorMsg])->withInput()
                : response()->json(['status' => false, 'message' => $errorMsg], 401);
        }

        // 🔥 Tambahkan cek status di sini
        if ($user->status === 'N') {
            $errorMsg = 'Akun Anda tidak aktif. Hubungi admin.';
            return $isWebRequest
                ? back()->withErrors(['username' => $errorMsg])->withInput()
                : response()->json(['status' => false, 'message' => $errorMsg], 403);
        }

        // Jika web request
        if ($isWebRequest) {
            Auth::login($user);
            return redirect()->intended('/dashboard'); // arahkan sesuai kebutuhan
        }

        // Jika API request, buat token
        $token = $user->createToken("adminbaru2")->plainTextToken;
        return response()->json([
            "status" => true,
            "message" => "Login Berhasil",
            "token" => $token
        ]);
    }

    public function getdatauser()
    {
        $userData = Auth::user();
        return response()->json([
            "status" => true,
            "message" => "Data User",
            "data" => $userData
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->expectsJson()) {
            // Logout dari API token
            $request->user()->tokens()->delete();

            return response()->json([
                "status" => true,
                "message" => "Berhasil Logout"
            ]);
        }

        // Logout dari session (web)
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function refreshToken()
    {
        $tokenInfo = request()->user()->createToken("tokenbaru-admin");
        $newToken = $tokenInfo->plainTextToken;
         return response()->json([
            "status"=> true,
            "message"=> "Token Diperbarui",
            "access_token"=> $newToken
        ]);
    }
}
