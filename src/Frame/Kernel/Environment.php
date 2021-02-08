<?php

namespace Gg\Frame\Kernel;

use Yaf\Config_Abstract;
use Yaf\Registry;

class Environment implements IEnvironment
{
    /**
     * 当前环境
     * @var
     */
    private static $env;

    /**
     * 环境设置
     * @var string[]
     */
    private static $allowedEnvironment = ['dev', 'test', 'product'];

    /**
     * 默认环境
     * @var string
     */
    private static $defaultEnvironment = 'dev';

    /**
     * 环境初始化
     * @return mixed|void
     */
    public static function load()
    {
        if (empty(self::$env)) {
            $env = getenv('APP_ENV'); //todo 是否需要使用dotenv 也就是.env
            self::$env = in_array($env, self::$allowedEnvironment) ? $env : self::$defaultEnvironment;
        }
    }

    /**
     * 设置环境
     * @param string $env
     */
    public static function set(string $env)
    {
        self::$env = $env;
    }

    /**
     * 获取环境
     * @return string
     */
    public static function get(): string
    {
        return self::$env;
    }

    /**
     * 包装文件
     * @param string $filename
     * @return string
     */
    public static function wrap(string $filename): string
    {
        list($filename, $suffix) = explode('.', $filename);
        return $filename . '.' . self::$env . '.' . $suffix;
    }

    /**
     * 初始化信息
     * @param \Yaf\Application $application
     */
    public static function init(\Yaf\Application $application): void
    {
        $config = $application->getConfig();
        if($config->application->debug) {
            self::displayErrors();
        }

        Registry::set('application' , $config->application);
        Registry::set('database', $config->database);
        Registry::set('cache' , $config->cache);
        Registry::set('bootstrap' , require _ROOT . '/config/bootstrap.php');
    }

    /**
     * 显示错误
     */
    public static function displayErrors() {
        ini_set("display_errors", "On");
        error_reporting(E_ALL | E_STRICT);
    }
}
