<?php

namespace App\Facades;

use App\Http\PaymentMethods\PayMob;
use Illuminate\Support\Facades\Facade;

class PaymobFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return new PayMob ;
    }
}
