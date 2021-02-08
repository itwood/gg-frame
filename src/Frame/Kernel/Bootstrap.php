<?php

namespace Gg\Frame\Kernel;

use Components\Jwt;
use Gg\Database\Database;
use Gg\Database\Redis;
use Gg\Http\Request;
use Gg\Middleware\Middleware;
use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Loader;
use Yaf\Registry;
use Yaf\Request_Abstract;

class Bootstrap extends Bootstrap_Abstract
{
    public function _initApplication(Dispatcher $dispatcher)
    {
        $config = Registry::get('application');
        if ($config->disableView) {
            $dispatcher->disableView();
        }

        // 注册命名空间
        $bootstrap = \Yaf\Registry::get('bootstrap');
        Loader::getInstance()->registerNamespace($bootstrap['registerNamespace']);

        // 注册log
        \SeasLog::setBasePath($config->log->path);
        \SeasLog::setLogger($config->log->logger);

        // 初始化 Jwt组件
        Jwt::init(require _ROOT . '/config/jwt.php');
    }

    public function _initRequest(Dispatcher $dispatcher)
    {
        Request::init();
    }

    public function _initDatabase(Dispatcher $dispatcher)
    {
        //数据库初始化
        $databaseConfig = Registry::get('database');
        Database::init($databaseConfig->toArray());

        $cacheConfig = Registry::get('cache');
        Redis::init($cacheConfig->toArray());
    }

    public function _initMiddleware(Dispatcher $dispatcher)
    {
        $bootstrap = \Yaf\Registry::get('bootstrap');
        $middleware = new Middleware();
        $middleware->init($bootstrap);
        $dispatcher->registerPlugin($middleware);
    }
}
