<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Gateways;

use Szy4211\Translate\Contracts\MessageInterface;
use Szy4211\Translate\Contracts\TransResultInterface;
use Szy4211\Translate\Exceptions\InvalidArgumentException;
use Szy4211\Translate\Exceptions\GatewayErrorException;
use Szy4211\Translate\Support\Str;
use Szy4211\Translate\TransResult;

/**
 * Class BaiduGateway.
 *
 * @see     https://api.fanyi.baidu.com/doc/21
 */
class BaiduGateway extends Gateway
{
    const API_URI = 'http://api.fanyi.baidu.com/api/trans/vip/translate';

    const MAX_QUERY_LENGTH = 6000;

    /**
     * {@inheritdoc}
     */
    public function translate(MessageInterface $message): TransResultInterface
    {
        $maxQueryLength = self::MAX_QUERY_LENGTH;
        if (strlen($message->getQueryMessage()) > $maxQueryLength) {
            throw new InvalidArgumentException("The number of query characters exceeds the limit of $maxQueryLength characters");
        }

        $data = $this->sendPostRequest(self::API_URI, $this->buildParams($message));

        if (isset($data['error_code'])) {
            throw new GatewayErrorException('Gateway error.', $data['error_code']);
        }

        return new TransResult($message, $data['trans_result'][0]['dst']);
    }

    /**
     * Build params.
     *
     * @return array
     *
     * @throws \Exception
     */
    protected function buildParams(MessageInterface $message)
    {
        $appId = $this->config->get('app_id');
        $appSecret = $this->config->get('app_secret');
        $salt = Str::random();

        return [
            'q' => $message->getQueryMessage(),
            'from' => $message->getFromLang(),
            'to' => $message->getToLang(),
            'appid' => $appId,
            'salt' => $salt,
            'sign' => $this->makeSign($appId, $appSecret, $message->getQueryMessage(), $salt),
        ];
    }

    /**
     * Make sign.
     *
     * @return string
     */
    private function makeSign(string $appId, string $appSecret, string $query, string $salt)
    {
        return md5("{$appId}{$query}{$salt}{$appSecret}");
    }
}
