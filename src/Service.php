<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace HyperfAlliance\Vip;

use AlexQiu\Sdkit\ServiceContainer;
use HyperfAlliance\Vip\Providers\CallerProvider;
use HyperfAlliance\Vip\Providers\HttpServiceClientProvider;
use HyperfAlliance\Vip\Services\Oauth;
use HyperfAlliance\Vip\Services\Invitation;
use HyperfAlliance\Vip\Services\Order;
use HyperfAlliance\Vip\Services\Pid;
use HyperfAlliance\Vip\Services\Token;
use HyperfAlliance\Vip\Services\Url;

/**
 * 唯品会客户端类，用于发送请求到唯品会接口。
 * Service
 *
 * @property Oauth      $oauth
 * @property Invitation $invitation
 * @property Pid        $pid
 * @property Token      $token
 * @property Url        $url
 * @property Order      $order
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Service
 */
class Service extends ServiceContainer
{
    protected $providers = [
        HttpServiceClientProvider::class,
        CallerProvider::class
    ];

    protected $defaultConfig = [
        "oauth_url" => "https://auth.vip.com", // 默认授权地址
        "http"      => [
            "base_uri" => "https://vop.vipapis.com"
        ]
    ];

    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
    }
}
