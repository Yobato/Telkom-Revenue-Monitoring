<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peruntukan extends Model
{
    use HasFactory;
    protected $table = "peruntukan";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_peruntukan'
    ];
 
    public static $rules = [
        'nama_peruntukan' => 'unique:peruntukan',
    ];

    public static $messages = [
        'nama_peruntukan.unique' => 'Nama Peruntukan sudah ada dalam database.',
    ];
}