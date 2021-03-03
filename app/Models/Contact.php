<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'people_id',
        'street',
        'number',
        'district',
        'phone',
    ];

   public function people()
   {
       return $this->belongsTo(People::class);
   }
}
