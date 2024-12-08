<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;

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
}
