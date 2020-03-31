<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;
use Auth;

class PerusahaanController extends Controller
{
    //

    public function index()
    {
        $perusahaan = Perusahaan::all()->sortByDesc('created_at')->values();

        $data = ['perusahaan' => $perusahaan];
        // $result = collect($data)->sortByDesc('created_at')('created_at')->all();

        return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    }

    public function show($aktif)
    {
            $perusahaan = new Perusahaan();

                $perusahaan = new Perusahaan();

                $perusahaan = Perusahaan::find($aktif);

                $data = $perusahaan->where('aktif', $aktif)->sortByDesc('created_at')->get();

                return response()->json($data)->header('Access-Control-Allow-Origin', '*');
    } 

    public function getId($id)
    {
                $perusahaan = Perusahaan::find($id);

                $data = $perusahaan->where('id', $id)->get();

                return response()->json($data);
    }

    public function create(Request $request)
    {
        $perusahaan = new Perusahaan();

        $perusahaan->nama_perusahaan = $request->nama_perusahaan;
        $perusahaan->deskripsi = $request->deskripsi;
        $perusahaan->job_requirement = $request->job_requirement;
        $perusahaan->job_desc = $request->job_desc;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->file = $request->file;
        $perusahaan->deadline = $request->deadline;
        $perusahaan->file_pengumuman = $request->file_pengumuman;
        $perusahaan->aktif = $request->aktif;

        $perusahaan->save();

        return response()->json("Data Tersimpan", 200)->header('Access-Control-Allow-Origin', '*');
    }

    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::find($id);

        $perusahaan->nama_perusahaan = $request->get('nama_perusahaan', $perusahaan->nama_perusahaan);
        $perusahaan->deskripsi = $request->get('deskripsi', $perusahaan->deskripsi);
        $perusahaan->job_requirement = $request->get('job_requirement', $perusahaan->job_requirement);
        $perusahaan->job_desc = $request->get('job_desc', $perusahaan->job_desc);
        $perusahaan->alamat = $request->get('alamat', $perusahaan->alamat);
        $perusahaan->file = $request->get('file', $perusahaan->file);
        $perusahaan->deadline = $request->get('deadline', $perusahaan->deadline);
        $perusahaan->file_pengumuman = $request->get('file_pengumuman', $perusahaan->file_pengumuman);
        $perusahaan->aktif = $request->get('aktif', $perusahaan->aktif);

        $perusahaan->save();

        return response()->json("Data Berhasil Diubah", 200)->header('Access-Control-Allow-Origin', '*');
    }

    public function delete($id)
    {
        $perusahaan = Perusahaan::find($id);

        $perusahaan->delete();

        return response()->json("Data Berhasil Dihapus", 200)->header('Access-Control-Allow-Origin', '*');
    }
}
