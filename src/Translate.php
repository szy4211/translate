<?php

namespace Szy4211\Translate;


use Szy4211\Translate\Contracts\GatewayInterface;
use Szy4211\Translate\Contracts\TransResultInterface;
use Szy4211\Translate\Exceptions\InvalidArgumentException;
use Szy4211\Translate\Support\Config;

/**
 * Class Translate
 *
 * @package Szy4211\Translate
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
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config      = new Config($config);
        $this->gatewayName = $this->config->get('default', '');
    }

    /**
     * Set gateway name
     *
     * @param string $gatewayName
     *
     * @return $this
     */
    public function setGatewayName(string $gatewayName)
    {
        $this->gatewayName = $gatewayName;

        return $this;
    }

    /**
     * Translate
     *
     * @param string $query
     * @param string $toLang
     * @param string $fromLang
     * @param string $formatType
     *
     * @return TransResultInterface
     * @throws InvalidArgumentException
     */
    public function translate(string $query, string $toLang = 'zh', string $fromLang = 'auto', string $formatType = 'text')
    {
        $gateway = $this->gateway();

        return $gateway->translate(new Message([
            'queryMessage' => $query,
            'toLang'       => $toLang,
            'fromLang'     => $fromLang,
            'formatType'   => $formatType,
        ]));
    }

    /**
     * Make gateway
     *
     * @return GatewayInterface
     * @throws InvalidArgumentException
     */
    public function gateway()
    {
        $gateway = $this->formatGatewayName($this->gatewayName);
        if (!class_exists($gateway) || !in_array(GatewayInterface::class, class_implements($gateway))) {
            throw new InvalidArgumentException(sprintf('Class "%s" must be the gateway of translate.', $gateway));
        }

        $config = array_merge($this->config->get('options', [])
            , $this->config->get('gateways.' . $this->gatewayName, []));

        return new $gateway($config);
    }

    /**
     * Format gateway name
     *
     * @param string $gateway
     *
     * @return string
     */
    protected function formatGatewayName(string $gateway)
    {
        if (class_exists($gateway) && in_array(GatewayInterface::class, class_implements($gateway))) {
            return $gateway;
        }

        $gateway = ucfirst(str_replace(['-', '_', ' '], '', $gateway));

        return __NAMESPACE__ . "\\Gateways\\{$gateway}Gateway";
    }
}