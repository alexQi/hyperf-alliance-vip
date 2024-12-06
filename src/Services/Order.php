<?php

namespace HyperfAlliance\Vip\Services;

use HyperfAlliance\Vip\Caller;
use HyperfAlliance\Vip\Exception\ResultErrorException;
use HyperfAlliance\Vip\Utils\QueryUtils;

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

}










