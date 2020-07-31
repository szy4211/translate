<?php

namespace Szy4211\Translate\Facades;

use Illuminate\Support\Facades\Facade;

class Translate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'translate';
    }
}