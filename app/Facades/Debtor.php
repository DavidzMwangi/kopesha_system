<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Debtor extends Facade{

    protected static function getFacadeAccessor()
    {
//        parent::getFacadeAccessor();
        return 'debtor';
    }
    public static function Debtor(){
        return \App\Models\Debtor::all();
    }
}