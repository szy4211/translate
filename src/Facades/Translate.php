<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Facades;

use Illuminate\Support\Facades\Facade;

class Translate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'translate';
    }
}
