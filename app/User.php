<?php

namespace App;

use App\Models\Debtor;
use App\Models\Lender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password','first_name','last_name','gender','address','DOB','phone_number',
        'alternative_number','level','deleted','user_pic','id_no',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //relation with the debtor table
    public function Debtor()
    {
       return $this->hasOne(Debtor::class,'user_id','id');
    }

    public function Lender()
    {
        return $this->hasOne(Lender::class,'user_id','id');
    }
}
