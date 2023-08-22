<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanFinance extends Model
{
    use HasFactory;
    protected $table = "laporan_finance";
    protected $primaryKey = "pid_finance";
    public $timestamps = false;
    protected $fillable = [
        'nilai', 'keterangan', 'id_portofolio', 'id_program', 'id_cost_plan', 'id_peruntukan', 'id_user', 'kota', 'tanggal'
    ];
    public $incrementing = false;
}
