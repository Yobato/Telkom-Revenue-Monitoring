<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanCommerce extends Model
{
    use HasFactory;
    protected $table = "laporan_commerce";
    protected $primaryKey = "id_commerce";
    public $timestamps = false;
    protected $fillable = [
        "id_commerce",
        'id_program',
        'kode_program',
        'nilai',
        'jenis_laporan',
        'keterangan',
        'id_portofolio',
        'id_sub_grup_akun',
        'kota',
        'created_at',
        'updated_at',
        'tanggal'
    ];
    public $incrementing = false;
}