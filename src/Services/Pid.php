<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;
use HyperfAlliance\Vip\Exception\ResultErrorException;
use HyperfAlliance\Vip\Utils\QueryUtils;

/**
 * Pid
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Services\Pid
 */
class Pid extends Caller
{

    public string $service = "com.vip.adp.api.open.service.UnionPidService";

    public string $version = "1.0.0";

    /**
     * @param $chan_tag
     * @param $link
     * @param $target_type
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function queryPid($page = 1, $pageSize = 10): array
    {
        $result = $this->Send("queryPid", [
            "pidQueryRequest" => [
                "requestId" => QueryUtils::buildRequestId(),
                "page"      => $page,
                "pageSize"  => $pageSize,
            ]
        ]);
        if (!$result || !isset($result["pidInfoList"])) {
            throw new ResultErrorException("查询推广位失败");
        }
        return $result["pidInfoList"];
    }

    /**
     * @param $mediaId
     * @param $pidNameList
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function genPid($mediaId, $pidNameList = []): array
    {
        $result = $this->Send("genPid", [
            "pidGenRequest" => [
                "requestId"   => QueryUtils::buildRequestId(),
                "mediaId"     => $mediaId,
                "pidNameList" => $pidNameList,
            ]
        ]);
        if (!$result || !isset($result["pidInfoList"])) {
            throw new ResultErrorException("生成推广位失败");
        }
        return current($result["pidInfoList"]);
    }

    /**
     * @param $chan_tag
     * @param $link
     * @param $target_type
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function queryPidWithOauth($page = 1, $pageSize = 10): array
    {
        $result = $this->Send("queryPidWithOauth", [
            "pidQueryRequest" => [
                "requestId" => QueryUtils::buildRequestId(),
                "page"      => $page,
                "pageSize"  => $pageSize,
            ]
        ]);
        if (!$result || !isset($result["pidInfoList"])) {
            throw new ResultErrorException("查询推广位失败");
        }
        return $result["pidInfoList"];
    }

    /**
     * @param $mediaId
     * @param $pidNameList
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function genPidWithOauth($mediaId, $pidNameList = []): array
    {
        $result = $this->Send("genPidWithOauth", [
            "pidGenRequest" => [
                "requestId"   => QueryUtils::buildRequestId(),
                "mediaId"     => $mediaId,
                "pidNameList" => $pidNameList,
            ]
        ]);
        if (!$result || !isset($result["pidInfoList"])) {
            throw new ResultErrorException("生成推广位失败");
        }
        return current($result["pidInfoList"]);
    }
}










