<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;
    use HasFactory, Notifiable;
    protected $table = "account";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama', 'nik', 'password', 'keterangan', 'role', 'kota'
    ];
    protected $hidden = [
        'password',
    ];
}
