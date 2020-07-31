<?php

namespace Szy4211\Translate\Gateways;

use Szy4211\Translate\Contracts\MessageInterface;
use Szy4211\Translate\Contracts\TransResultInterface;
use Szy4211\Translate\Exceptions\GatewayErrorException;
use Szy4211\Translate\Support\Str;
use Szy4211\Translate\TransResult;

/**
 * Class YoudaoGateway
 *
 * @package Szy4211\Translate\Gateways
 * @see     https://ai.youdao.com/DOCSIRMA/html/%E8%87%AA%E7%84%B6%E8%AF%AD%E8%A8%80%E7%BF%BB%E8%AF%91/API%E6%96%87%E6%A1%A3/%E6%96%87%E6%9C%AC%E7%BF%BB%E8%AF%91%E6%9C%8D%E5%8A%A1/%E6%96%87%E6%9C%AC%E7%BF%BB%E8%AF%91%E6%9C%8D%E5%8A%A1-API%E6%96%87%E6%A1%A3.html
 */
class YoudaoGateway extends Gateway
{
    const API_URI = 'https://openapi.youdao.com/api';

    const SIGN_TYPE = 'v3';

    /**
     * @inheritDoc
     */
    public function translate(MessageInterface $message): TransResultInterface
    {
        $data = $this->sendPostRequest(self::API_URI, $this->buildParams($message));

        if ('0' !== $data['errorCode']) {
            throw new GatewayErrorException('Gateway error.', $data['error_code']);
        }

        return new TransResult($message, $data['translation'][0]);
    }

    /**
     * Build request params
     *
     * @param MessageInterface $message
     *
     * @return array
     * @throws \Exception
     */
    private function buildParams(MessageInterface $message)
    {
        $params = [
            'q'        => $message->getQueryMessage(),
            'from'     => $message->getFromLang(),
            'to'       => $message->getToLang(),
            'appKey'   => $this->config->get('app_id'),
            'salt'     => Str::random(),
            'signType' => self::SIGN_TYPE,
            'curtime'  => time()
        ];

        $params['sign'] = $this->makeSign(
            $params['appKey'],
            $params['q'],
            $params['curtime'],
            $params['salt']
        );

        return $params;
    }

    /**
     * Make sign
     *
     * @param string $appId
     * @param string $query
     * @param string $time
     * @param string $salt
     *
     * @return string
     */
    private function makeSign(string $appId, string $query, string $time, string $salt)
    {
        $appSecret = $this->config->get('app_secret');

        $input = $this->buildSignInput($query);
        $str   = "{$appId}{$input}{$salt}{$time}{$appSecret}";

        return hash("sha256", $str);
    }

    /**
     * Build sign input param
     *
     * @param string $query
     *
     * @return string
     */
    private function buildSignInput(string $query): string
    {
        $len = strlen($query);

        return $len > 20
            ? substr($query, 0, 10) . $len . substr($query, $len - 10, $len)
            : $query;
    }
}