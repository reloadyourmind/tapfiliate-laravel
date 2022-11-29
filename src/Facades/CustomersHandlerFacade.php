<?php
namespace Tapfiliate\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class CustomersHandlerFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'CustomersHandler';
    }
}
