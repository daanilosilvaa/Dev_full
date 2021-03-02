<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillabel = [
        'name',
        'fantasy_name',
        'rg_ie',
        'sex',
        'type',
        'brith',
    ];
}
