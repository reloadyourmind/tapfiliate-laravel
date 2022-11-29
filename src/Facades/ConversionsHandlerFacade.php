<?php
namespace Tapfiliate\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class ConversionsHandlerFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ConversionsHandler';
    }
}
