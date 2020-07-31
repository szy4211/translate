<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Contracts;

/**
 * Interface MessageInterface.
 */
interface MessageInterface
{
    /**
     * Get query message.
     */
    public function getQueryMessage(): string;

    /**
     * Get from language.
     */
    public function getFromLang(): string;

    /**
     * Get to language.
     */
    public function getToLang(): string;

    /**
     * Get format type.
     */
    public function getFormatType(): string;
}
