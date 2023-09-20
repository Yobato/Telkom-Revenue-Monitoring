<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetCommerce extends Model
{
    use HasFactory;
    protected $table = "target_commerce";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'jumlah', 'bulan', 'tahun', 'jenis_laporan', 'id_portofolio'
    ];

    public function portofolio()
    {
        return $this->belongsTo(Portofolio::class, 'id_portofolio');
    }

}