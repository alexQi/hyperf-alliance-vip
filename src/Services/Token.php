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










