<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth as TymonJWTAuth;
use Tymon\JWTAuth\JWTAuth as TymonJWTAuthJWTAuth;
use Auth;
use App\Http\Middleware\Cors;

class UserController extends Controller
{
    //
    public function update(Request $request, $id)
    {
        $siswa = User::find($id);

        $siswa->nama = $request->get('nama', $siswa->nama);
        $siswa->email = $request->get('email', $siswa->email);
        $siswa->no_telepon = $request->get('no_telepon', $siswa->no_telepon);
        $siswa->foto_profil = $request->get('foto_profil', $siswa->foto_profil);
        $siswa->jenis_kelamin = $request->get('jenis_kelamin', $siswa->jenis_kelamin);
        $siswa->tempat_lahir = $request->get('tempat_lahir', $siswa->tempat_lahir);
        $siswa->tanggal_lahir = $request->get('tanggal_lahir', $siswa->tanggal_lahir);
        $siswa->alamat = $request->get('alamat', $siswa->alamat);
        $siswa->domisili = $request->get('domisili', $siswa->domisili);
        $siswa->status = $request->get('status', $siswa->status);

        $siswa->save();

        return response()->json($siswa)->header('Access-Control-Allow-Origin', '*');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if(! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'invalid_credentials',
                    'data' => $credentials
                ], 400);
            }
        }

        catch (JWTException $e) {
            return response()->json([
                'error' => 'could not create token',
                'data' => $credentials
            ], 500);
        }

        return response()->json(compact('api_token'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function signin(Request $request)
    {
        $valid = Auth::attempt($request->only('email', 'password'));
    
    if ($valid) {
        $user = Auth::user();
        $user->api_token = str_random(100);
        $user->save();
        $user->makeVisible('api_token');
        
        return response()->json([
            'data' => $user
        ])->header('Access-Control-Allow-Origin', '*');
    }
    
    return response()->json([
        'message' => 'Email and password doesnt match'
    ], 404)->header('Access-Control-Allow-Origin', '*');
    }
}
