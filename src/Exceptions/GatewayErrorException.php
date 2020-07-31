<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Exceptions;

class GatewayErrorException extends Exception
{
    protected $raw = [];

    public function __construct($message = '', $code = 0, array $raw = [])
    {
        parent::__construct($message, (int) $code);

        $this->raw = $raw;
    }

    /**
     * Get raw data.
     *
     * @return array
     * @date 2020/7/30
     */
    public function getRaw()
    {
        return $this->raw;
    }
}
