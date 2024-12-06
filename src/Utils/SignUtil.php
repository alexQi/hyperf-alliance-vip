<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace HyperfAlliance\Vip\Utils;

/**
 * SignUtil 类用于生成API请求的签名头。
 * 它提供了根据请求配置计算签名的方法，包括HTTP方法、内容MD5以及排序后的头信息。
 */
class SignUtil
{
    /**
     * @param $method
     * @param $app_params
     *
     * @return string
     */
    public static function genSign($app_secret, $system_params, $app_params)
    {
        // 第1步：对系统级参数按首字母顺序排列
        ksort($system_params);
        // 第2步：拼接参数名和参数值
        $signatureString = '';
        foreach ($system_params as $key => $value) {
            $signatureString .= $key . $value;
        }
        // 拼接应用级参数
        $signatureString .= json_encode($app_params, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        // 第3步：以appSecret作为秘钥，对拼接后的字符串进行HMAC-MD5加密
        return HmacUtil::hmac($signatureString, $app_secret);
    }
}
