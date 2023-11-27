<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReco extends Model
{
    use HasFactory;
    protected $table = "user_reco";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_user_reco'
    ];

    public static $rules = [
        'nama_user_reco' => 'unique:user_reco',
    ];

    public static $messages = [
        'nama_user_reco.unique' => 'Nama User Reco sudah ada dalam database.',
    ];
}