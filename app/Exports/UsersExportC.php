<?php

namespace App\Exports;

use App\Models\LaporanCommerce;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExportC implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaporanCommerce::all();
    }
}
