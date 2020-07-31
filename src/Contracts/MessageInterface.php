<?php

namespace Szy4211\Translate\Contracts;

/**
 * Interface MessageInterface
 *
 * @package Szy4211\Translate\Contracts
 */
interface MessageInterface
{
    /**
     * Get query message
     *
     * @return string
     */
    public function getQueryMessage(): string;

    /**
     * Get from language
     *
     * @return string
     */
    public function getFromLang(): string;

    /**
     * Get to language
     *
     * @return string
     */
    public function getToLang(): string;

    /**
     * Get format type
     *
     * @return string
     */
    public function getFormatType(): string;
}