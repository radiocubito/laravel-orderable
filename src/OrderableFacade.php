<?php

namespace Radiocubito\Orderable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Radiocubito\Orderable\Orderable
 */
class OrderableFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'orderable';
    }
}
