<?php

declare(strict_types=1);
/**
 * hyperf 组件加载配置
 *
 * @link     http://www.swoole.red
 * @contact  1712715552@qq.com
 */

namespace HyperfAlliance\Vip;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                // 将 ServiceInterface 映射到 Service 工厂，确保框架注入正确实例
                Service::class => Factory::class,
            ],
            'annotations'  => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish'      => [
                [
                    'id'          => 'config',
                    'description' => 'The config for alliance vip component.',
                    'source'      => __DIR__ . '/../publish/vip.php',
                    'destination' => BASE_PATH . '/config/autoload/vip.php',
                ],
            ],
        ];
    }
}
