<?php

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