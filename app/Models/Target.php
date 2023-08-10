<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;
    protected $table = "target";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'jumlah', 'bulan', 'tahun', 'role'
    ];
}
