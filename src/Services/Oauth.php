<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;
use HyperfAlliance\Vip\Exception\ResultErrorException;
use Psr\Http\Message\ResponseInterface;

/**
 * Oauth
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Services\Oauth
 */
class Oauth extends Caller
{
    /**
     *
     * @return string
     */
    public function getOauthLink($account)
    {
        return sprintf(
            "%s/oauth2/authorize?client_id=%s&response_type=code&state=%s&redirect_uri=%s",
            $this->app->config->get("oauth_url"),
            $this->app->config->get("app_key"),
            "vip@" . $account,
            urlencode($this->app->config->get("notify_url")),
        );
    }

    /**
     * @param $code
     * @param $client_ip
     *
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function buildAccessToken($code, $client_ip)
    {
        $request = [
            "code"              => $code,
            "request_client_ip" => $client_ip,
            "grant_type"        => "authorization_code",
            "client_id"         => $this->app->config->get("app_key"),
            "client_secret"     => $this->app->config->get("app_secret"),
            "redirect_uri"      => $this->app->config->get("notify_url"),
        ];

        $resp = $this->fetch($this->app->config->get("oauth_url") . "/oauth2/token", "POST", [
            "headers" => [
                "Accept"       => "application/json",
                "Content-Type" => "application/json",
            ],
            "query"   => $request,
        ]);
        if (!isset($resp['access_token'])) {
            throw new ResultErrorException($resp["msg"]);
        }
        return [
            "access_token"  => $resp["access_token"],
            "refresh_token" => $resp["refresh_token"],
            "expires_in"    => $resp["expires_in"] + time(),
        ];
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \AlexQiu\Sdkit\Support\Collection|array|false|mixed|object|ResponseInterface|string|null
     * @throws \AlexQiu\Sdkit\Exceptions\InvalidConfigException
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $res = $this->castResponseToType(
            $response,
            $this->app->getContainer()->get("config")->get('http.response_type')
        );
        if (!isset($res['access_token'])) {
            throw new ResultErrorException($res["msg"] ?? $res["code"], 77000);
        }
        return $res;
    }
}
