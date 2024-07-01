<?php

namespace App\Exports;

use App\Models\LaporanNota;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExportN implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return LaporanNota::query()
            ->join('peruntukan', 'laporan_nota.id_peruntukan', '=', 'peruntukan.id')
            ->join('user_reco', 'laporan_nota.id_user', '=', 'user_reco.id')
            ->join('city', 'laporan_nota.kota', '=', 'city.id')
            ->select(
                'laporan_nota.pid_nota',
                'peruntukan.nama_peruntukan',
                'user_reco.nama_user_reco',
                'laporan_nota.nilai_awal',
                'laporan_nota.pph',
                'laporan_nota.persentase',
                'laporan_nota.nilai_akhir',
                'laporan_nota.keterangan',
                'city.nama_city',
                'laporan_nota.tanggal',
                'laporan_nota.created_at',
                'laporan_nota.updated_at',
            );
    }

    public function headings(): array
    {
        return [
            'PID Nota', 
            'Peruntukan', 
            'User', 
            'Nilai Awal', 
            'PPH', 
            'Persentase', 
            'Nilai Akhir', 
            'Keterangan', 
            'Kota', 
            'Tanggal',
            'Created At',
            'Updated At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->pid_nota,
            $row->nama_peruntukan,
            $row->nama_user_reco,
            $row->nilai_awal,
            $row->pph,
            $row->persentase,
            $row->nilai_akhir,
            $row->keterangan,
            $row->kota,
            $row->tanggal,
            $row->created_at,
            $row->updated,
        ];
    }
}