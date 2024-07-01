<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = "city";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_city'
    ];

    public static $rules = [
        'nama_city' => 'unique:city',
    ];

    public static $messages = [
        'nama_city.unique' => 'Nama Kota sudah ada dalam database.',
    ];
}