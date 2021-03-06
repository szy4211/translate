<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Tests;

use Mockery;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        Mockery::globalHelpers();
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}
