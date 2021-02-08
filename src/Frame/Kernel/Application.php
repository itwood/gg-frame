<?php

namespace Gg\Frame\Kernel;

use Illuminate\Support\Env;
use Yaf\Registry;

class Application implements IApplication
{
    /**
     * 默认地址
     */
    const DEFAULT_CONFIG_PATH = _ROOT . '/config';

    const CONFIG_FILE = 'application.ini';

    private $path;

    /**
     * Application constructor.
     * @param string $path
     * @throws \Exception
     */
    public function __construct(string $path = self::DEFAULT_CONFIG_PATH)
    {
        if (!is_dir($path)) {
            throw new \Exception("application.ini directory not found");
        }
        $this->path = $path;

        // 加载环境环境
        Environment::load();
    }

    /**
     * 配置文件
     * @return string
     */
    public  function configPath(): string
    {
        return $this->path . '/' . self::CONFIG_FILE;
    }


    public function boot()
    {
        $app = new \Yaf\Application($this->configPath());
        # 环境初始化
        Environment::init($app);
        $app->bootstrap()->run();
        return $app;
    }
}