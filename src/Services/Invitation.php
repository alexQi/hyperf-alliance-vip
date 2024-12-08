<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;
use HyperfAlliance\Vip\Exception\ResultErrorException;
use HyperfAlliance\Vip\Utils\QueryUtils;

/**
 * Invitation
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Services\Invitation
 */
class Invitation extends Caller
{

    public string $service = "com.vip.adp.api.open.service.UnionInvitationService";

    public string $version = "1.0.0";

    /**
     * @param $businessType
     * @param $inviterTag
     *
     * @return mixed
     * @throws ResultErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvitationUrl($businessType = 6, $inviterTag = "")
    {
        $result = $this->Send("getInvitationUrl", [
            "request" => [
                "requestId"    => QueryUtils::buildRequestId(),
                "businessType" => $businessType,
                "inviterTag"   => $inviterTag,
            ]
        ]);
        if (!$result || !isset($result["invitationUrl"])) {
            throw new ResultErrorException("生成邀请链接失败");
        }
        return $result["invitationUrl"];
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvitedUserList($params)
    {
        return $this->Send("getInvitedUserList", [
            "request" => array_merge($params, [
                "requestId" => QueryUtils::buildRequestId(),
                "page"      => $params['page'] ?? 1,
                "pageSize"  => $params['pageSize'] ?? 20
            ])
        ]);
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvitedUserOrderList($params)
    {
        return $this->Send("getInvitedUserOrderList", [
            "request" => array_merge($params, [
                "requestId" => QueryUtils::buildRequestId(),
                "page"      => $params['page'] ?? 1,
                "pageSize"  => $params['pageSize'] ?? 20
            ])
        ]);
    }

    /**
     * @param $businessType
     * @param $inviterTag
     *
     * @return mixed
     * @throws ResultErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvitationUrlWithOauth($businessType = 6, $inviterTag = "")
    {
        $result = $this->Send("getInvitationUrlWithOauth", [
            "request" => [
                "requestId"    => QueryUtils::buildRequestId(),
                "businessType" => $businessType,
                "inviterTag"   => $inviterTag,
            ]
        ]);
        if (!$result || !isset($result["invitationUrl"])) {
            throw new ResultErrorException("生成邀请链接失败");
        }
        return $result["invitationUrl"];
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvitedUserListWithOauth($params)
    {
        return $this->Send("getInvitedUserListWithOauth", [
            "request" => array_merge($params, [
                "requestId" => QueryUtils::buildRequestId(),
                "page"      => $params['page'] ?? 1,
                "pageSize"  => $params['pageSize'] ?? 20
            ])
        ]);
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvitedUserOrderListWithOauth($params)
    {
        return $this->Send("getInvitedUserOrderList", [
            "request" => array_merge($params, [
                "requestId" => QueryUtils::buildRequestId(),
                "page"      => $params['page'] ?? 1,
                "pageSize"  => $params['pageSize'] ?? 20
            ])
        ]);
    }

}










