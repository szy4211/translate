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

/**
 * Class Message.
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $queryMessage;

    /**
     * @var string
     */
    protected $fromLang = 'auto';

    /**
     * @var string
     */
    protected $toLang = 'zh';

    /**
     * @var string
     */
    protected $formatType = 'text';

    /**
     * Message constructor.
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $attribute) {
            if (property_exists($this, $key)) {
                $this->$key = $attribute;
            }
        }
    }

    /**
     * Set query message.
     *
     * @return $this
     */
    public function setQueryMessage(string $queryMessage): self
    {
        $this->queryMessage = $queryMessage;

        return $this;
    }

    /**
     * Set from language.
     *
     * @return $this
     */
    public function setFromLang(string $fromLang): self
    {
        $this->fromLang = $fromLang;

        return $this;
    }

    /**
     * Set to language.
     *
     * @return $this
     */
    public function setToLang(string $toLang): self
    {
        $this->toLang = $toLang;

        return $this;
    }

    /**
     * Set format type.
     *
     * @return $this
     */
    public function setFormatType(string $formatType): self
    {
        $this->formatType = $formatType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryMessage(): string
    {
        return $this->queryMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function getFromLang(): string
    {
        return $this->fromLang;
    }

    /**
     * {@inheritdoc}
     */
    public function getToLang(): string
    {
        return $this->toLang;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormatType(): string
    {
        return $this->formatType;
    }
}
