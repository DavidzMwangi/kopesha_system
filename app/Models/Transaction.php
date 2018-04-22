<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function Payment()
    {
        return $this->hasMany(Payment::class,'transaction_id','id');
    }
}
