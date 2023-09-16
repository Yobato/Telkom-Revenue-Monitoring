<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetFinance extends Model
{
    use HasFactory;
    protected $table = "target_finance";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'jumlah', 'bulan', 'tahun', 'portofolio'
    ];
}