<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Support;

class Config implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * Config constructor.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get config.
     *
     * @param      $key
     * @param null $default
     *
     * @return array|mixed|null
     */
    public function get($key, $default = null)
    {
        $config = $this->config;
        if (isset($config[$key])) {
            return $config[$key];
        }

        if (false === strpos($key, '.')) {
            return $default;
        }

        foreach (explode('.', $key) as $subKey) {
            if (!is_array($config) || !isset($config[$subKey])) {
                return $default;
            }
            $config = $config[$subKey];
        }

        return $config;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->config[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (isset($this->config[$offset])) {
            $this->config[$offset] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->config[$offset]);
    }
}
