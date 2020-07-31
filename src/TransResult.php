<?php

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
     *
     * @param MessageInterface $queryInstance
     * @param string           $dstMessage
     */
    public function __construct(MessageInterface $queryInstance, string $dstMessage)
    {
        $this->queryInstance = $queryInstance;
        $this->dstMessage    = $dstMessage;
    }

    /**
     * @inheritDoc
     */
    public function getQueryMessage(): string
    {
        return $this->getQueryInstance()->getQueryMessage();
    }

    /**
     * @inheritDoc
     */
    public function getFromLang(): string
    {
        return $this->getQueryInstance()->getFromLang();
    }

    /**
     * @inheritDoc
     */
    public function getToLang(): string
    {
        return $this->getQueryInstance()->getToLang();
    }

    /**
     * @inheritDoc
     */
    public function getFormatType(): string
    {
        return $this->getQueryInstance()->getFormatType();
    }

    /**
     * @inheritDoc
     */
    public function getDstMessage(): string
    {
        return $this->dstMessage;
    }

    /**
     * @inheritDoc
     */
    public function getQueryInstance(): MessageInterface
    {
        return $this->queryInstance;
    }
}