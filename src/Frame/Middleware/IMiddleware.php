<?php

namespace Gg\Frame\Middleware;
interface IMiddleware
{
    public function isFilter(\Yaf\Request_Abstract $request): bool;

    public function handle(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response);
}
