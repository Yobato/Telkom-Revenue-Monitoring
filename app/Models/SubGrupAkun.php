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
    
    public static $rules = [
        'nama_sub' => 'unique:sub_grup_akun',
    ];

    public static $messages = [
        'nama_sub.unique' => 'Nama Sub Grup Akun sudah ada dalam database.',
    ];
}