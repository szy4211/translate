<?php

namespace Szy4211\Translate\Contracts;

/**
 * Interface GatewayInterface
 *
 * @package Szy4211\Translate\Contracts
 */
interface GatewayInterface
{
    /**
     * Get gateway name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Translate
     *
     * @param MessageInterface $message
     *
     * @return TransResultInterface
     */
    public function translate(MessageInterface $message): TransResultInterface;
}