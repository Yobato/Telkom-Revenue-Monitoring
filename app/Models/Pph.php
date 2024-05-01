<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pph extends Model
{
    use HasFactory;
    protected $table = "pph";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_pph', 'nilai_pph'
    ];

}