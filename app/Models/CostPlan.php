<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostPlan extends Model
{
    use HasFactory;
    protected $table = "cost_plan";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_cost_plan'
    ];

    public static $rules = [
        'nama_cost_plan' => 'unique:cost_plan',
    ];

    public static $messages = [
        'nama_cost_plan.unique' => 'Nama Cost Plan sudah ada dalam database.',
    ];
}