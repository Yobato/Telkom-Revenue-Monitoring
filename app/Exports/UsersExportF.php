<?php

namespace App\Exports;

use App\Models\LaporanFinance;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExportF implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaporanFinance::all();
    }
}
