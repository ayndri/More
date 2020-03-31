<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Transaksi;

class ImageController extends Controller
{
    //
    public function upload(Request $request, $id)
    {
        // if($request->hasFile('file')){

            $resorce       = $request->file('file');
            $name   = $resorce->getClientOriginalName();
            $resorce->move(\base_path() ."/public/transaksi", $name);
            $save = DB::table('transaksis')->where('id', '=', $id)->update(['file' => $name]);
            
            return response()->json($save)->header('Access-Control-Allow-Origin', '*');

        // }else{
        //     return response()->json("Gagal upload gambar")->header('Access-Control-Allow-Origin', '*');
        // }
    }
}
