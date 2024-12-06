<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;
use HyperfAlliance\Vip\Exception\ResultErrorException;

/**
 * Token
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Services\Token
 */
class Token extends Caller
{
    public string $service = "vipapis.oauth.OauthService";

    public string $version = "1.0.0";

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

        $resp = $this->fetch($this->app->config->get("oauth_url"), "POST", [
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
     * @param $refresh_token
     * @param $client_ip
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refreshAccessToken($refresh_token, $client_ip): array
    {
        $result = $this->Send("refreshToken", [
            "request" => [
                "client_id"         => $this->app->config->get("app_key"),
                "client_secret"     => $this->app->config->get("app_secret"),
                "refresh_token"     => $refresh_token,
                "request_client_ip" => $client_ip
            ]
        ]);
        if (!$result || !isset($result["access_token"]) || empty($result["access_token"])) {
            throw new ResultErrorException("刷新授权token失败");
        }
        return [
            "access_token"  => $result["access_token"],
            "refresh_token" => $result["refresh_token"],
            "expires_in"    => $result["expires_in"] + time(),
        ];
    }
}










