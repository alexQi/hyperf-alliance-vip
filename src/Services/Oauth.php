<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;

class Oauth extends Caller
{
    /**
     * @param $client_id
     *
     * @return string
     */
    public function getOauthLink($account, $client_id)
    {
        return sprintf(
            "%s/oauth2/authorize?client_id=%s&response_type=code&state=%s&redirect_uri=%s",
            $this->app->config->get("oauth_url"),
            $client_id,
            "vip@" . $account,
            urlencode($this->app->config->get("notify_url")),
        );
    }
}










