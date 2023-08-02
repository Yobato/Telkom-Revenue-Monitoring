<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGrupAkun extends Model
{
    use HasFactory;
    protected $table = "sub_grup_akun";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_sub'
    ];
}
