<?php

namespace Szy4211\Translate\Contracts;

/**
 * Interface TransResult
 *
 * @package Szy4211\translate\src\Contracts
 */
interface TransResultInterface extends MessageInterface
{
    /**
     * Get dst message
     *
     * @return string
     */
    public function getDstMessage(): string;

    /**
     * Get query message
     *
     * @return MessageInterface
     */
    public function getQueryInstance(): MessageInterface;
}