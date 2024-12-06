<?php

namespace HyperfAlliance\Vip;

use AlexQiu\Sdkit\BaseClient as KitBaseClient;
use Hyperf\Codec\Json;
use HyperfAlliance\Vip\Exception\ResultErrorException;
use HyperfAlliance\Vip\Utils\SignUtil;
use Psr\Http\Message\ResponseInterface;

/**
 * Client
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Client
 */
class Caller extends KitBaseClient
{
    public string $service;
    public string $version;
    public string $format   = "json";
    public string $language = "zh";

    /**
     * @param $method
     * @param $request
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function Send($method, $request)
    {
        // 生成query系统参数
        $query_params = $this->getQueryParams($method, $request);
        // 发起请求
        return $this->fetch('/', "POST", [
            "headers" => [
                "Accept"       => "application/json",
                "Content-Type" => "application/json",
            ],
            "query"   => $query_params,
            "body"    => Json::encode($request, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ]);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \AlexQiu\Sdkit\Support\Collection|array|false|mixed|object|ResponseInterface|string|null
     * @throws \AlexQiu\Sdkit\Exceptions\InvalidConfigException
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $res = parent::unwrapResponse($response);
        if ($res['returnCode']) {
            throw new ResultErrorException($res["returnMessage"] ?? $res["returnCode"], 77000);
        }
        return $res["result"];
    }

    /**
     * @param $method
     * @param $request
     *
     * @return array|string[]
     */
    public function getQueryParams($method, $request)
    {
        $params = $this->genSystemParams($method);
        return array_merge(
            $params,
            [
                "sign" => SignUtil::genSign($this->app->config->get("app_secret"), $params, $request)
            ]
        );
    }

    /**
     * @param $method
     *
     * @return array
     */
    public function genSystemParams($method)
    {
        return [
            "service"     => $this->service,
            "version"     => $this->version,
            "format"      => $this->format,
            "method"      => $method,
            "timestamp"   => time(),
            "appKey"      => $this->app->config->get("app_key"),
            "accessToken" => $this->app->config->get("access_token"),
        ];
    }
}