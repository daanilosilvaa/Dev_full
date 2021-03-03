<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = [
        'type',
        'document',
        'name',
        'fantasy_name',
        'sex',
        'rg_ie',
        'brith',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
