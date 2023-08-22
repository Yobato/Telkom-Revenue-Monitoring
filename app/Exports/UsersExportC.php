<?php

namespace App\Exports;

use App\Models\LaporanCommerce;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExportC implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID Commerce',
            'ID Program',
            'Nama Portofolio',
            'Kode Program',
            'Nilai',
            'Jenis Laporan',
            'Keterangan',
            'ID Sub Grup Akun',
            'Kota',
            'Created At',
            'Updated At',
        ];
    }

    public function query()
    {
        return LaporanCommerce::query()
            ->join('portofolio', 'laporan_commerce.id_portofolio', '=', 'portofolio.id')
            ->join('program', 'laporan_commerce.id_program', '=', 'program.id')
            ->join('sub_grup_akun', 'laporan_commerce.id_sub_grup_akun', '=', 'sub_grup_akun.id')
            ->join('city', 'laporan_commerce.kota', '=', 'city.id')
            ->select(
                'laporan_commerce.id_commerce',
                'program.nama_program',
                'portofolio.nama_portofolio',
                'program.kode_program',
                'laporan_commerce.nilai',
                'laporan_commerce.jenis_laporan',
                'laporan_commerce.keterangan',
                'sub_grup_akun.nama_sub',
                'city.nama_city',
                'laporan_commerce.created_at',
                'laporan_commerce.updated_at',
            );
    }

    public function map($row): array
    {
        return [
            $row->id_commerce,
            $row->nama_program,
            $row->nama_portofolio,
            $row->kode_program,
            $row->nilai,
            $row->jenis_laporan,
            $row->keterangan,
            $row->nama_sub,
            $row->nama_city,
            $row->created_at,
            $row->updated_at,
        ];
    }
}
