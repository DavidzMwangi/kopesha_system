<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Lender extends Facade
{


    protected static function getFacadeAccessor()
    {
        return 'lender';
    }
    public static function Lender(){
        return \App\Models\Lender::all();
    }
}



?>