<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = "program";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_program', 'kode_program', 'role', 'id_portofolio',
    ];

    public static $rules = [
        'nama_program' => 'unique_with_role:program',
    ];

    public static $messages = [
        'nama_program.unique_with_role' => 'Kombinasi Nama Program dan Role sudah ada dalam database.',
    ];
}