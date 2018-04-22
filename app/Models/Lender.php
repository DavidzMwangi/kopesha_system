<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    public function User()
    {
       return $this->hasOne('App\User','id','user_id') ;
    }
}
