<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class TransaksiController extends Controller
{
    //
    public function showAll()
    {
        $perusahaan = Perusahaan::all();

        return response()->json($perusahaan)->header('Access-Control-Allow-Origin', '*');
    }

    public function show($aktif)
    {
        $transaksi = Perusahaan::find($aktif);

        $data = $transaksi->where('aktif', $aktif)->get();

        return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    }

    public function create(Request $request)
    {
        $transaksi = new Transaksi();

        $transaksi->id_user = $request->id_user;
        $transaksi->id_perusahaan = $request->id_perusahaan;
        $transaksi->file = $request->file;

        $transaksi->save();

        return response()->json($transaksi->id)->header('Access-Control-Allow-Origin', '*');
    }
}
