<?php
declare(strict_types=1);

namespace HyperfAlliance\Vip\Utils;

class QueryUtils
{

    public static function buildRequestId()
    {
        return uniqid() . '-' . bin2hex(random_bytes(8));
    }

    public static function getQueryString($request)
    {
        $params = '';
        $params = $params . "appKey=" . $request["appKey"];
        $params = $params . "&format=" . $request["format"];
        $params = $params . "&method=" . $request["method"];
        $params = $params . "&service=" . $request["service"];
        $params = $params . "&sign=" . $request["sign"];
        $params = $params . "&timestamp=" . $request["timestamp"];
        $params = $params . "&version=" . $request["version"];
        if (!empty($request["accessToken"])) {
            $params = $params . "&accessToken=" . $request["accessToken"];
        }
        if (!empty($request["language"])) {
            $params = $params . "&language=" . $request["language"];
        }

        return $params;
    }
}