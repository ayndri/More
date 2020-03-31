<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use App\Exports\TransaksiExport;
use App\User;
use App\Perusahaan;

class JoinTableController extends Controller
{
    //

    public function index($id)
    {
        $data = DB::table('transaksis')
                ->join('perusahaans', 'perusahaans.id', '=', 'transaksis.id_perusahaan')
                ->join('users', 'users.id', '=', 'transaksis.id_user')
                ->select('perusahaans.nama_perusahaan', 'users.id','users.nama', 'users.email', 'users.no_telepon',
                        'users.tanggal_lahir', 'users.alamat', 'users.jenis_kelamin')
                ->where('perusahaans.id', '=', $id)
                ->orderByDesc('transaksis.created_at')
                ->get();

        return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    }

    public function get_all()
    {
        $data = DB::table('transaksis')
                ->join('perusahaans', 'perusahaans.id', '=', 'transaksis.id_perusahaan')
                ->join('users', 'users.id', '=', 'transaksis.id_user')
                ->select('perusahaans.id', 'perusahaans.nama_perusahaan', 'perusahaans.job_desc', 'users.nama', 'users.email', 'users.no_telepon',
                        'users.tanggal_lahir', 'users.alamat', 'users.jenis_kelamin', 'transaksis.created_at')
                ->orderByDesc('transaksis.created_at')
                ->get();

        return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    }

    public function get_perusahaan($id)
    {
        $data = DB::table('transaksis')
                ->join('perusahaans', 'perusahaans.id', '=', 'transaksis.id_perusahaan')
                ->join('users', 'users.id', '=', 'transaksis.id_user')
                ->select('perusahaans.nama_perusahaan', 'perusahaans.created_at', 'perusahaans.deadline',
                'perusahaans.job_desc', 'perusahaans.file_pengumuman', 'perusahaans.updated_at')
                ->where('users.id', '=', $id)
                ->orderByDesc('transaksis.created_at')
                ->get();

        return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    }

    // public function get_pengumuman($id)
    // {
    //     $data = DB::table('transaksis')
    //             ->join('perusahaans', 'perusahaans.id', '=', 'transaksis.id_perusahaan')
    //             ->join('users', 'users.id', '=', 'transaksis.id_user')
    //             ->select('perusahaans.nama_perusahaan', 'perusahaans.job_desc', 'perusahaans.file_pengumuman',
    //             'perusahaans.updated_at')
    //             ->where('users.id', '=', $id)
    //             ->orderByDesc('transaksis.created_at')
    //             ->get();

    //     return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    // }

    public function put_status(Request $request, $id_perusahaan)
    {
        $data = DB::table('transaksis')
                ->join('perusahaans', 'perusahaans.id', '=', 'transaksis.id_perusahaan')
                ->join('users', 'users.id', '=', 'transaksis.id_user')
                ->where('perusahaans.id', '=', $id_perusahaan)
                ->update([
                    'users.status' => $request->get('status', 'users.status')
                ]);

        return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    }

    public function export_excel()
    {
        $done = Excel::download(new TransaksiExport, 'DaftarSiswa.xlsx');
        return $done;
    }
}
