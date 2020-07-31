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

use Szy4211\Translate\Contracts\GatewayInterface;
use Szy4211\Translate\Contracts\MessageInterface;
use Szy4211\Translate\Contracts\TransResultInterface;
use Szy4211\Translate\Exceptions\InvalidArgumentException;
use Szy4211\Translate\Translate;
use Szy4211\Translate\TransResult;

class TranslateTest extends TestCase
{
    public function testGateway()
    {
        $translate = new Translate([]);
        $translate->setGatewayName('test');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Class "Szy4211\Translate\Gateways\TestGateway" must be the gateway of translate.');

        $translate->gateway();
    }

    public function testDefaultGateway()
    {
        $translate = new Translate([
            'default' => 'test_default',
        ]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Class "Szy4211\Translate\Gateways\TestdefaultGateway" must be the gateway of translate.');

        $translate->gateway();
    }

    public function testFormatGatewayName()
    {
        $translate = \Mockery::mock(Translate::class.'[formatGatewayName]', [[]])
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $gatewayName = $translate->formatGatewayName('testName');
        $this->assertSame('Szy4211\Translate\Gateways\TestNameGateway', $gatewayName);
    }

    public function testTranslate()
    {
        $gateway = new TestGateway();
        $translate = \Mockery::mock(Translate::class.'[gateway]', [[]]);
        $translate->shouldReceive('gateway')->andReturn($gateway);

        $transResult = $translate->translate('test');
        $this->assertSame($transResult->getDstMessage(), 'test');
    }
}

class TestGateway implements GatewayInterface
{
    public function getName(): string
    {
        return 'test';
    }

    public function translate(MessageInterface $message): TransResultInterface
    {
        return new TransResult($message, $message->getQueryMessage());
    }
}
