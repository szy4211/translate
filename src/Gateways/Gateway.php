<?php

namespace Szy4211\Translate\Gateways;

use Szy4211\Translate\Contracts\GatewayInterface;
use Szy4211\Translate\Support\Config;
use Szy4211\Translate\Traits\HttpRequest;

/**
 * Class Gateway
 *
 *
 * @package Szy4211\Translate\Gateways
 */
abstract class Gateway implements GatewayInterface
{
    use HttpRequest;

    const DEFAULT_HTTP_TIMEOUT = 5.0;

    /**
     * @var Config
     */
    protected $config;

    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * Get config
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set config
     *
     * @param array $config
     *
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = new Config($config);

        return $this;
    }

    /**
     * @return array
     */
    public function getHttpOptions()
    {
        return (array)$this->config->get('http_options', []);
    }

    /**
     * Get base uri
     *
     * @return string
     */
    public function getHttpBaseUri()
    {
        return (string)$this->config->get('http_base_uri', '');
    }

    /**
     * Get Timeout
     *
     * @return float
     */
    public function getHttpTimeout()
    {
        return (float)$this->config->get('http_timeout', self::DEFAULT_HTTP_TIMEOUT);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return strtolower(str_replace([__NAMESPACE__ . '\\', 'Gateway'], '', get_class($this)));
    }
}