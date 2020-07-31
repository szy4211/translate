<?php

namespace Szy4211\Translate;


use Szy4211\Translate\Contracts\MessageInterface;

/**
 * Class Message
 *
 *
 * @package Szy4211\Translate
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
     *
     * @param array $attributes
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
     * Set query message
     *
     * @param string $queryMessage
     *
     * @return $this
     */
    public function setQueryMessage(string $queryMessage): self
    {
        $this->queryMessage = $queryMessage;

        return $this;
    }

    /**
     * Set from language
     *
     * @param string $fromLang
     *
     * @return $this
     */
    public function setFromLang(string $fromLang): self
    {
        $this->fromLang = $fromLang;

        return $this;
    }

    /**
     * Set to language
     *
     * @param string $toLang
     *
     * @return $this
     */
    public function setToLang(string $toLang): self
    {
        $this->toLang = $toLang;

        return $this;
    }

    /**
     * Set format type
     *
     * @param string $formatType
     *
     * @return $this
     */
    public function setFormatType(string $formatType): self
    {
        $this->formatType = $formatType;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getQueryMessage(): string
    {
        return $this->queryMessage;
    }

    /**
     * @inheritDoc
     */
    public function getFromLang(): string
    {
        return $this->fromLang;
    }

    /**
     * @inheritDoc
     */
    public function getToLang(): string
    {
        return $this->toLang;
    }

    /**
     * @inheritDoc
     */
    public function getFormatType(): string
    {
        return $this->formatType;
    }
}