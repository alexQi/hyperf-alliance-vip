<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace HyperfAlliance\Vip\Contract;

interface ServiceInterface
{
    public function send(RequestInterface $request);
}
