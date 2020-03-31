<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaksi;

class Perusahaan extends Model
{
    //


    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_perusahaan',
        'deskripsi',
        'job_requirement',
        'job_desc',
        'alamat',
        'deadline',
    ];

    public function perusahaan()
    {
        return $this->belongsToMany(Transaksi::class);
    }
}
