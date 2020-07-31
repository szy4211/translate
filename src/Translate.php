<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate;

use Szy4211\Translate\Contracts\GatewayInterface;
use Szy4211\Translate\Contracts\TransResultInterface;
use Szy4211\Translate\Exceptions\InvalidArgumentException;
use Szy4211\Translate\Support\Config;

/**
 * Class Translate.
 */
class Translate
{
    /**
     * @var string|null
     */
    protected $gatewayName;
    /**
     * @var Config
     */
    protected $config;

    /**
     * Translate constructor.
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
        $this->gatewayName = $this->config->get('default', '');
    }

    /**
     * Set gateway name.
     *
     * @return $this
     */
    public function setGatewayName(string $gatewayName)
    {
        $this->gatewayName = $gatewayName;

        return $this;
    }

    /**
     * Translate.
     *
     * @return TransResultInterface
     *
     * @throws InvalidArgumentException
     */
    public function translate(string $query, string $toLang = 'zh', string $fromLang = 'auto', string $formatType = 'text')
    {
        $gateway = $this->gateway();

        return $gateway->translate(new Message([
            'queryMessage' => $query,
            'toLang' => $toLang,
            'fromLang' => $fromLang,
            'formatType' => $formatType,
        ]));
    }

    /**
     * Make gateway.
     *
     * @return GatewayInterface
     *
     * @throws InvalidArgumentException
     */
    public function gateway()
    {
        $gateway = $this->formatGatewayName($this->gatewayName);
        if (!class_exists($gateway) || !in_array(GatewayInterface::class, class_implements($gateway))) {
            throw new InvalidArgumentException(sprintf('Class "%s" must be the gateway of translate.', $gateway));
        }

        $config = array_merge($this->config->get('options', []), $this->config->get('gateways.'.$this->gatewayName, []));

        return new $gateway($config);
    }

    /**
     * Format gateway name.
     *
     * @return string
     */
    protected function formatGatewayName(string $gateway)
    {
        if (class_exists($gateway) && in_array(GatewayInterface::class, class_implements($gateway))) {
            return $gateway;
        }

        $gateway = ucfirst(str_replace(['-', '_', ' '], '', $gateway));

        return __NAMESPACE__."\\Gateways\\{$gateway}Gateway";
    }
}
