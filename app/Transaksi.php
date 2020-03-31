<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_perusahaan',
    ];

    public function get_perusahaan()
    {
        return $this->hasMany('App\Perusahaan', 'transaksi', 'id');
    }

    public function get_user()
    {
        return $this->hasMany('App\User', 'transaksi', 'id');
    }
}
