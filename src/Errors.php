<?php

namespace HyperfAlliance\Vip;

class Errors
{
    public static $errs = [
        // 系统级错误
        'vipapis.sys_other_error'             => [
            'code'    => 7001000,
            'message' => '系统内部错误',
        ],
        'vipapis.response-timeOut'            => [
            'code'    => 7001001,
            'message' => '响应超时',
        ],
        'vipapis.path.Error'                  => [
            'code'    => 7001002,
            'message' => '请求路径异常',
        ],
        // 权限和认证错误
        'vipapis.appkey-not-exist'            => [
            'code'    => 7002000,
            'message' => '发起请求的APPKEY 不存在',
        ],
        'vipapis.white-ip-not-exist'          => [
            'code'    => 7002001,
            'message' => 'APPKEY对应IP白名单无此IP信息',
        ],
        'vipapis.ip-in-blackList'             => [
            'code'    => 7002002,
            'message' => 'APPKEY对应IP黑名单中存在此IP',
        ],
        'vipapis.ip-in-whiteList'             => [
            'code'    => 7002003,
            'message' => 'APPKEY对应IP白名单中存在此IP',
        ],
        'vipapis.appKey-in-blackList'         => [
            'code'    => 7002004,
            'message' => 'APPKEY黑名单中存在此APPKEY',
        ],
        'vipapis.api-invalidate-permission'   => [
            'code'    => 7002005,
            'message' => '发起请求的APPKEY 无此方法访问权限',
        ],
        // 签名和验证错误
        'vipapis.sign-not-match'              => [
            'code'    => 7003000,
            'message' => '签名不匹配错误',
        ],
        'vipapis.miss-parameter'              => [
            'code'    => 7003001,
            'message' => '缺少参数',
        ],
        'vipapis.parameter-notmatch'          => [
            'code'    => 7003002,
            'message' => '参数不匹配',
        ],
        'vipapis.ext-attr-invalidate-failure' => [
            'code'    => 7003003,
            'message' => '扩展属性验证失败',
        ],
        'vipapis.oauth-invalidate-failure'    => [
            'code'    => 7003004,
            'message' => 'oauth验证失败',
        ],
        // 请求相关错误
        'vipapis.app-flow-overrun'            => [
            'code'    => 7004000,
            'message' => '应用日流量超限',
        ],
        'vipapis.request-data-max'            => [
            'code'    => 7004001,
            'message' => '请求数据过大，请核实',
        ],
        'vipapis.base-api.error'              => [
            'code'    => 7004002,
            'message' => 'oauth服务异常',
        ],
    ];
}