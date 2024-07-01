<?php

namespace App\Exports;

use App\Models\LaporanFinance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExportF implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return LaporanFinance::query()
            ->join('portofolio', 'laporan_finance.id_portofolio', '=', 'portofolio.id')
            ->join('program', 'laporan_finance.id_program', '=', 'program.id')
            ->join('cost_plan', 'laporan_finance.id_cost_plan', '=', 'cost_plan.id')
            ->join('city', 'laporan_finance.kota', '=', 'city.id')
            ->select(
                'laporan_finance.pid_finance',
                'portofolio.nama_portofolio',
                'program.nama_program',
                'cost_plan.nama_cost_plan',
                'city.nama_city',
                'laporan_finance.created_at',
                'laporan_finance.updated_at',
            );
    }

    public function headings(): array
    {
        return [
            'PID Finance',
            'Nama Portofolio',
            'Nama Program',
            'Nama Cost Plan',
            'Nama Kota',
            'Created At',
            'Updated At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->pid_finance,
            $row->nama_portofolio,
            $row->nama_program,
            $row->nama_cost_plan,
            $row->nama_city,
            $row->created_at,
            $row->updated_at,
        ];
    }
}