<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
     public function showLogin()
    {
        return view('pages.login'); // menampilkan Blade login kamu
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // "id" => "required|string",
            "nama" => "required|string",
            "username" => "required|string",
            "hp" => "required|string",
            "id_jabatan" => "required|string",
            "status" => "required|string",
            "password" => "required|confirmed",
            "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
            "status" => false,
            "message" => $errorMessage,    
            ];
            return response()->json($response, 401);
        }

        $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('foto_users', 'public'); 
                // akan tersimpan di storage/app/public/foto_users
            }

        $id = strtotime(date("Y-m-d H:i:s"));
        User::create([
            "id" => $id,
            "nama" => $request->nama,
            "username" => $request->username,
            "hp" => $request->hp,
            "id_jabatan" => $request->id_jabatan,
            "status" => $request->status,
            "password" => bcrypt($request->password),
            "foto" => $fotoPath,
        ]);

        return response()->json([
            "status" => true,
            "message" => "Berhasil Daftar"
        ]);
        
    }

   public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            return response()->json([
                "status" => false,
                "message" => $errorMessage,
            ], 401);
        }

        $user = User::where("username", $request->username)->first();

        if (empty($user)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Login",
            ]);
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Login! Password Salah",
            ]);
        }

        // 🔥 Cek status
        if ($user->status === 'N') {
            return response()->json([
                "status" => false,
                "message" => "Akun Anda tidak aktif. Hubungi admin.",
            ], 403);
        }

        $token = $user->createToken("adminbaru2")->plainTextToken;
        return response()->json([
            "status" => true,
            "message" => "Login Berhasil",
            "token" => $token,
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

    public function logout()
    {
        request()->user()->tokens()->delete();

        return response()->json([
            "status"=> true,
            "message"=> "Berhasil Logout"
        ]);
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