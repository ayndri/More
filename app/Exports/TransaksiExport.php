<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Controllers\JoinTableController\index;

class TransaksiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //

        return index::all();
    }
}
