<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;
use HyperfAlliance\Vip\Exception\ResultErrorException;
use HyperfAlliance\Vip\Utils\QueryUtils;

/**
 * Url
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Services\Url
 */
class Url extends Caller
{

    public string $service = "com.vip.adp.api.open.service.UnionUrlService";

    public string $version = "1.3.0";

    public static array $keys_mapping = [
        "vipZfbSchemeUrl" => "[DP] 支付宝小程序",
        //        "vipZfbUrl"       => "[UR] 支付宝小程序",
        //        "vipWxUrl"        => "[IS] 微信小程序",
        "vipWxSchemaUrl"  => "[DP] 微信小程序",
        "url"             => "[UR] 网页推广链接",
        "deeplinkUrl"     => "[DP] 应用深度链接",
    ];

    public static array $ignore_keys = [
        "vipWxCode",
        "longUrl",
        "noEvokeLongUrl",
        "source",
        "onlyCommand",
        "traFrom"
    ];

    public static array $ignore_url_query_keys = [
        "oxo_province_id",
        "fdc_area_id",
        "area_id",
        "user_gender",
        "request_id",
        "nmsns",
        "nst",
        "nsbc",
        "nct",
        "ncid",
        "nabtid",
        "nuid",
        "nchl_param"
    ];

    /**
     * @param $chan_tag
     * @param $link
     * @param $target_type
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function genByVIPUrlWithOauth($chan_tag, $link, $macro_symbol = "__REQUESTID__", $target_type = "URL"): array
    {
        $url_gen_request = [
            "targetType"      => $target_type,
            "targetValueList" => [$link],
            "evokeQuickApp"   => false,
            "genShortUrl"     => false,
            "openId"          => "default_open_id",
            "realCall"        => true,
            "platform"        => 1,
            "adCode"          => "unionapi",
        ];

        $result = $this->Send("genByVIPUrlWithOauth", [
            "urlList"       => [],
            "chanTag"       => $chan_tag,
            "statParam"     => $macro_symbol,
            "urlGenRequest" => $url_gen_request,
            "requestId"     => QueryUtils::buildRequestId()
        ]);
        if (!$result || !isset($result["urlInfoList"]) || empty($result["urlInfoList"])) {
            throw new ResultErrorException("获取链接失败");
        }
        $link_map = current($result["urlInfoList"]);
        if (isset($link_map["vipWxUrl"])) {
            $link_map["vipWxSchemaUrl"] = $this->buildWechatSchemaUrl($link_map["vipWxUrl"]);
        }

        arsort($link_map);
        $links = [];
        foreach ($link_map as $key => $link) {
            if (in_array($key, self::$ignore_keys)) {
                continue;
            }
            if (!isset(self::$keys_mapping[$key])) {
                continue;
            }
            $links[] = [
                "key"   => $key,
                "label" => self::$keys_mapping[$key],
                "link"  => $link
            ];
        }
        return $links;
    }

    /**
     * @param $chan_tag
     * @param $link
     * @param $target_type
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function genByVIPUrl($chan_tag, $link, $macro_symbol = "__REQUESTID__", $target_type = "URL"): array
    {
        $url_gen_request = [
            "targetType"      => $target_type,
            "targetValueList" => [$link],
            "evokeQuickApp"   => false,
            "genShortUrl"     => false,
            "openId"          => "default_open_id",
            "realCall"        => true,
            "platform"        => 1,
            "adCode"          => "unionapi",
        ];

        $result = $this->Send("genByVIPUrl", [
            "urlList"       => [],
            "chanTag"       => $chan_tag,
            "statParam"     => $macro_symbol,
            "urlGenRequest" => $url_gen_request,
            "requestId"     => QueryUtils::buildRequestId()
        ]);
        if (!$result || !isset($result["urlInfoList"]) || empty($result["urlInfoList"])) {
            throw new ResultErrorException("获取链接失败");
        }
        $link_map = current($result["urlInfoList"]);
        if (isset($link_map["vipWxUrl"])) {
            $link_map["vipWxSchemaUrl"] = $this->buildWechatSchemaUrl($link_map["vipWxUrl"]);
        }

        arsort($link_map);
        $links = [];
        foreach ($link_map as $key => $link) {
            if (in_array($key, self::$ignore_keys)) {
                continue;
            }
            if (!isset(self::$keys_mapping[$key])) {
                continue;
            }
            $links[] = [
                "key"   => $key,
                "label" => self::$keys_mapping[$key],
                "link"  => str_replace('%24', '$', $link)
            ];
        }
        return $links;
    }

    /**
     * @param $wxUrl
     *
     * @return string
     */
    public function buildWechatSchemaUrl($wxUrl): string
    {
        // 分割字符串为路径和查询部分
        [$path, $queryString] = explode('?', $wxUrl, 2);
        // 解析查询参数
        parse_str($queryString, $queryParams);
        // 获取原始url decode
        $urlString = urldecode($queryParams["url"]);
        // 获取urlQueryString
        [$urlStringPath, $urlQuerySring] = explode('?', $urlString, 2);
        // 解析url QueryString
        parse_str($urlQuerySring, $queryUrlParams);
        // 删除无用参数
        foreach (self::$ignore_url_query_keys as $ignore_key) {
            if (isset($queryUrlParams[$ignore_key])) {
                unset($queryUrlParams[$ignore_key]);
            }
        }
        $currentUrl = $urlStringPath . "?" . http_build_query($queryUrlParams);
        // 获取params
        $wechatParams = [
            'url'      => $currentUrl,
            'tra_from' => urldecode($queryParams['tra_from'] ?? ''),
            'chl_type' => $queryParams['chl_type'] ?? '',
        ];
        // 创建query参数
        $wechatQueryString = http_build_query($wechatParams);
        // 返回跳转微信schema
        return sprintf(
            "weixin://dl/business/?appid=wxe9714e742209d35f&path=%s&query=%s",
            $path,
            urlencode($wechatQueryString)
        );
    }
}



