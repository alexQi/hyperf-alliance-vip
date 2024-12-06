<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace HyperfAlliance\Vip\Contract;

interface RequestInterface
{
    public function getResult(array $response);

    public function getApiMethodName();

    public function getApiParams();
}
