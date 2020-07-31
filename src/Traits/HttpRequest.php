<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Szy4211\Translate\Exceptions\HttpException;
use Szy4211\Translate\Exceptions\UnexpectedValueException;

trait HttpRequest
{
    /**
     * Send get request.
     *
     * @return array
     */
    protected function sendGetRequest(string $uri, array $params = [], array $headers = [])
    {
        return $this->request('get', $uri, [
            'headers' => $headers,
            'query' => $params,
        ]);
    }

    /**
     * Send post request.
     *
     * @return array
     */
    protected function sendPostRequest(string $uri, array $params = [], array $headers = [])
    {
        return $this->request('post', $uri, [
            'headers' => $headers,
            'form_params' => $params,
        ]);
    }

    /**
     * Send Request.
     *
     * @param array $options http://docs.guzzlephp.org/en/latest/request-options.html
     *
     * @return array
     *
     * @throws HttpException
     * @throws UnexpectedValueException
     */
    protected function request(string $method, string $uri, array $options = [])
    {
        $client = new Client($this->buildBaseGuzzleHttpOptions());

        try {
            $response = $client->{$method}($uri, $options);
        } catch (RequestException $e) {
            throw new HttpException($e->getMessage());
        }

        $contents = $this->unwrapResponse($response);
        if (null === $contents) {
            throw new UnexpectedValueException('Data cannot be decoded or it is deeper than the recursion limit');
        }

        return $contents;
    }

    /**
     * Unwrap response.
     *
     * @return array|string
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        $contents = $response->getBody()->getContents();
        if (false !== strpos($contentType, 'json')) {
            $contents = json_decode($contents, true);
        } elseif (false !== stripos($contentType, 'xml')) {
            $contents = json_decode(json_encode(simplexml_load_string($contents)), true);
        } else {
            // forced conversion
            $contents = json_decode($contents, true);
        }

        return $contents;
    }

    /**
     * Build base Guzzle http options.
     *
     * @return array
     */
    protected function buildBaseGuzzleHttpOptions()
    {
        $httpOptions = method_exists($this, 'getHttpOptions')
            ? $this->getHttpOptions()
            : [];

        return array_merge($httpOptions, [
            'base_uri' => method_exists($this, 'getHttpBaseUri')
                ? $this->getHttpBaseUri()
                : '',
            'timeout' => method_exists($this, 'getHttpTimeout')
                ? $this->getHttpTimeout()
                : 5.0,
        ]);
    }
}
