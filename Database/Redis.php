<?php

namespace Gg\Database;

class Redis
{
    /**
     * 多库实例
     * @var null
     */
    private static $instances = null;

    /**
     * 缓存配置
     * @var array
     */
    private static $config = [];

    private function __clone()
    {
    }

    /**
     * @param string $name
     * @return mixed|\Redis
     * @throws \Exception
     */
    public static function instance($name = 'default')
    {
        if (isset(self::$instances[$name])) {
            return self::$instances[$name];
        }

        if (!isset(self::$config[$name])) {
            throw new \Exception("Cache config not found");
        }

        self::$instances[$name] = self::connection(self::$config[$name]);
        return self::$instances[$name];
    }

    /**
     * 初始化
     * @param array $config
     */
    public static function init($config = [])
    {
        self::$config = $config;
    }

    /**
     * 连接
     * @param string $name
     */
    public static function connection($config)
    {
        $redis = new \Redis();
        $redis->connect($config['host'], $config['port'], $config['timeout'] ?? 0);
        $redis->auth($config['auth']);
        return $redis;
    }
}