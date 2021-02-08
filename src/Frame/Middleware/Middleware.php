<?php

namespace Gg\Frame\Middleware;

use Middleware\Auth;

class Middleware extends \Yaf\Plugin_Abstract
{
    private $config = [];

    public function init($config)
    {
        $this->config = $config;
    }

    /**
     * 调用
     * @param $middlewareName
     * @return object
     * @throws \ReflectionException
     */
    protected function getMiddleware($middlewareName): IMiddleware
    {
        if (!class_exists($middlewareName)) {
            throw new \Exception("Middleware: {$middlewareName} not exists");
        }

        $reflect = new \ReflectionClass($middlewareName);
        if (!$reflect->implementsInterface(IMiddleware::class)) {
            throw new \Exception("Middleware: {$middlewareName} must be implement IMiddleware");
        }

        return $reflect->newInstance();
    }

    protected function call($eventName, \Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        if (!empty($this->config[$eventName])) {
            array_walk($this->config[$eventName], function ($middleware) use ($request, $response) {
                $this->getMiddleware($middleware)->handle($request, $response);
            });
        }
    }

    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        $this->call('routerStartup', $request, $response);
    }

    public function routerShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        $this->call('routerShutdown', $request, $response);
    }

    public function dispatchLoopStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        $this->call('dispatchLoopStartup', $request, $response);
    }

    public function preDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        $this->call('preDispatch', $request, $response);
    }

    public function postDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        $this->call('postDispatch', $request, $response);
    }

    public function dispatchLoopShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        $this->call('dispatchLoopShutdown', $request, $response);
    }
}
