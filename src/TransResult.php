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

use Szy4211\Translate\Contracts\MessageInterface;
use Szy4211\Translate\Contracts\TransResultInterface;

class TransResult implements TransResultInterface
{
    /**
     * @var MessageInterface
     */
    protected $queryInstance;

    /**
     * @var string
     */
    protected $dstMessage = '';

    /**
     * TransResult constructor.
     */
    public function __construct(MessageInterface $queryInstance, string $dstMessage)
    {
        $this->queryInstance = $queryInstance;
        $this->dstMessage = $dstMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryMessage(): string
    {
        return $this->getQueryInstance()->getQueryMessage();
    }

    /**
     * {@inheritdoc}
     */
    public function getFromLang(): string
    {
        return $this->getQueryInstance()->getFromLang();
    }

    /**
     * {@inheritdoc}
     */
    public function getToLang(): string
    {
        return $this->getQueryInstance()->getToLang();
    }

    /**
     * {@inheritdoc}
     */
    public function getFormatType(): string
    {
        return $this->getQueryInstance()->getFormatType();
    }

    /**
     * {@inheritdoc}
     */
    public function getDstMessage(): string
    {
        return $this->dstMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryInstance(): MessageInterface
    {
        return $this->queryInstance;
    }
}
