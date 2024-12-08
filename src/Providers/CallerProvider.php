<?php

namespace HyperfAlliance\Vip\Providers;

use AlexQiu\Sdkit\ServiceContainer;
use HyperfAlliance\Vip\Services\Invitation;
use HyperfAlliance\Vip\Services\Oauth;
use HyperfAlliance\Vip\Services\Order;
use HyperfAlliance\Vip\Services\Pid;
use HyperfAlliance\Vip\Services\Token;
use HyperfAlliance\Vip\Services\Url;

/**
 * Client
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Client
 */
class CallerProvider
{
    /**
     * @param ServiceContainer $service
     *
     * @return void
     */
    public function register(ServiceContainer $service): void
    {
        $service->getContainer()->set("oauth", function () use ($service) {
            return new Oauth($service);
        });
        $service->getContainer()->set("invitation", function () use ($service) {
            return new Invitation($service);
        });
        $service->getContainer()->set("order", function () use ($service) {
            return new Order($service);
        });
        $service->getContainer()->set("pid", function () use ($service) {
            return new Pid($service);
        });
        $service->getContainer()->set("token", function () use ($service) {
            return new Token($service);
        });
        $service->getContainer()->set("url", function () use ($service) {
            return new Url($service);
        });
    }
}