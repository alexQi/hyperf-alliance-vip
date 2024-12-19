<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;
use HyperfAlliance\Vip\Exception\ResultErrorException;
use HyperfAlliance\Vip\Utils\QueryUtils;

/**
 * Order
 *
 * @author  alex
 * @package HyperfAlliance\Vip\Services\Order
 */
class Order extends Caller
{

    public string $service = "com.vip.adp.api.open.service.UnionOrderService";

    public string $version = "1.3.0";

    /**
     * @param $params
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function orderList($params = []): array
    {
        $queryModel = [
            "requestId" => QueryUtils::buildRequestId(),
            "page"      => $params['page'] ?? 1,
            "pageSize"  => $params['pageSize'] ?? 20
        ];
        if (isset($params["chanTag"])) {
            $queryModel["chanTag"] = $params["chanTag"];
        }
        if (isset($params["status"])) {
            $queryModel["status"] = $params["status"];
        }
        if (isset($params["orderSnList"])) {
            $queryModel["orderSnList"] = $params["orderSnList"];
        }
        if (isset($params["orderTimeStart"]) && isset($params["orderTimeEnd"])) {
            $queryModel["orderTimeStart"] = $params["orderTimeStart"];
            $queryModel["orderTimeEnd"]   = $params["orderTimeEnd"];
        }
        if (isset($params["updateTimeStart"]) && isset($params["updateTimeEnd"])) {
            $queryModel["updateTimeStart"] = $params["updateTimeStart"];
            $queryModel["updateTimeEnd"]   = $params["updateTimeEnd"];
        }

        $result = $this->Send("orderList", [
            "queryModel" => $queryModel
        ]);
        if (!$result || !isset($result["orderInfoList"])) {
            throw new ResultErrorException("获取订单数据失败");
        }
        return $result["orderInfoList"];
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws ResultErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refundOrderList($params)
    {
        $request = [
            "requestId" => QueryUtils::buildRequestId(),
            "page"      => $params['page'] ?? 1,
            "pageSize"  => $params['pageSize'] ?? 20
        ];
        if (isset($params["status"])) {
            $request["status"] = $params["status"];
        }
        if (isset($params["searchTimeStart"]) && isset($params["searchTimeEnd"])) {
            $request["searchTimeStart"] = $params["searchTimeStart"];
            $request["searchTimeEnd"]   = $params["searchTimeEnd"];
        }

        $result = $this->Send("refundOrderList", [
            "request" => $request
        ]);
        if (!$result || !isset($result["refundOrderInfoList"])) {
            throw new ResultErrorException("获取订单数据失败");
        }
        return $result["refundOrderInfoList"];
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws ResultErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function virtualOrderList($params)
    {
        $queryModel = [
            "requestId" => QueryUtils::buildRequestId(),
            "page"      => $params['page'] ?? 1,
            "pageSize"  => $params['pageSize'] ?? 20
        ];
        if (isset($params["chanTag"])) {
            $queryModel["chanTag"] = $params["chanTag"];
        }
        if (isset($params["status"])) {
            $queryModel["status"] = $params["status"];
        }
        if (isset($params["orderTimeStart"]) && isset($params["orderTimeEnd"])) {
            $queryModel["orderTimeStart"] = $params["orderTimeStart"];
            $queryModel["orderTimeEnd"]   = $params["orderTimeEnd"];
        }
        if (isset($params["updateTimeStart"]) && isset($params["updateTimeEnd"])) {
            $queryModel["updateTimeStart"] = $params["updateTimeStart"];
            $queryModel["updateTimeEnd"]   = $params["updateTimeEnd"];
        }

        $result = $this->Send("virtualOrderList", [
            "queryModel" => $queryModel
        ]);
        if (!$result || !isset($result["orderInfoList"])) {
            throw new ResultErrorException("获取订单数据失败");
        }
        return $result["orderInfoList"];
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws ResultErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function orderListWithOauth($params)
    {
        $queryModel = [
            "requestId" => QueryUtils::buildRequestId(),
            "page"      => $params['page'] ?? 1,
            "pageSize"  => $params['pageSize'] ?? 20
        ];
        if (isset($params["chanTag"])) {
            $queryModel["chanTag"] = $params["chanTag"];
        }
        if (isset($params["status"])) {
            $queryModel["status"] = $params["status"];
        }
        if (isset($params["orderSnList"])) {
            $queryModel["orderSnList"] = $params["orderSnList"];
        }
        if (isset($params["orderTimeStart"]) && isset($params["orderTimeEnd"])) {
            $queryModel["orderTimeStart"] = $params["orderTimeStart"];
            $queryModel["orderTimeEnd"]   = $params["orderTimeEnd"];
        }
        if (isset($params["updateTimeStart"]) && isset($params["updateTimeEnd"])) {
            $queryModel["updateTimeStart"] = $params["updateTimeStart"];
            $queryModel["updateTimeEnd"]   = $params["updateTimeEnd"];
        }

        $result = $this->Send("orderListWithOauth", [
            "queryModel" => $queryModel
        ]);
        if (!$result || !isset($result["orderInfoList"])) {
            throw new ResultErrorException("获取订单数据失败");
        }
        return $result["orderInfoList"];
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws ResultErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refundOrderListWithOauth($params)
    {
        $request = [
            "requestId" => QueryUtils::buildRequestId(),
            "page"      => $params['page'] ?? 1,
            "pageSize"  => $params['pageSize'] ?? 20
        ];
        if (isset($params["status"])) {
            $request["status"] = $params["status"];
        }
        if (isset($params["searchTimeStart"]) && isset($params["searchTimeEnd"])) {
            $request["searchTimeStart"] = $params["searchTimeStart"];
            $request["searchTimeEnd"]   = $params["searchTimeEnd"];
        }

        $result = $this->Send("refundOrderList", [
            "request" => $request
        ]);
        if (!$result || !isset($result["refundOrderInfoList"])) {
            throw new ResultErrorException("获取订单数据失败");
        }
        return $result["refundOrderInfoList"];
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws ResultErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function virtualOrderListWithOauth($params)
    {
        $queryModel = [
            "requestId" => QueryUtils::buildRequestId(),
            "page"      => $params['page'] ?? 1,
            "pageSize"  => $params['pageSize'] ?? 20
        ];
        if (isset($params["chanTag"])) {
            $queryModel["chanTag"] = $params["chanTag"];
        }
        if (isset($params["status"])) {
            $queryModel["status"] = $params["status"];
        }
        if (isset($params["orderTimeStart"]) && isset($params["orderTimeEnd"])) {
            $queryModel["orderTimeStart"] = $params["orderTimeStart"];
            $queryModel["orderTimeEnd"]   = $params["orderTimeEnd"];
        }
        if (isset($params["updateTimeStart"]) && isset($params["updateTimeEnd"])) {
            $queryModel["updateTimeStart"] = $params["updateTimeStart"];
            $queryModel["updateTimeEnd"]   = $params["updateTimeEnd"];
        }

        $result = $this->Send("virtualOrderList", [
            "queryModel" => $queryModel
        ]);
        if (!$result || !isset($result["orderInfoList"])) {
            throw new ResultErrorException("获取订单数据失败");
        }
        return $result["orderInfoList"];
    }

}










