<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;
    protected $table = "portofolio";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_portofolio', 'role'
    ];

    public static $rules = [
        'nama_portofolio' => 'unique_with_role:portofolio',
    ];

    public static $messages = [
        'nama_portofolio.unique_with_role' => 'Kombinasi Nama Portofolio dan Role sudah ada dalam database.',
    ];
}