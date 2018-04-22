<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function Transaction()
    {
        return $this->hasMany(Transaction::class,'id','transaction_id');
    }
}