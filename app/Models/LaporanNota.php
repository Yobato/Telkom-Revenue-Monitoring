<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanNota extends Model
{
    use HasFactory;
    protected $table = "laporan_nota";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'pid_nota', 'nilai_awal', 'nilai_akhir', 'pph', 'persentase', 'keterangan', 'id_peruntukan', 'id_user', 'kota', 'tanggal'
    ];
    // public $incrementing = false;
}