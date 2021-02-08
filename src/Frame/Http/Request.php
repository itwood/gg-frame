<?php

namespace Gg\Frame\Http;

/**
 * Class Request
 * @package Gg\Http
 */
class Request
{
    /**
     * @var bool
     */
    protected static $initialized = false;

    /**
     * 请求参数
     * @var array
     */
    protected static $params = [];

    /**
     * 头部信息
     * @var array
     */
    protected static $header = [];

    /**
     * 文件信息
     * @var array
     */
    protected static $file = [];

    public static function init()
    {
        if (self::$initialized) {
            return;
        }

        self::$params = $_REQUEST;
        self::$file = $_FILES;

        self::initHeader();
        self::$initialized = true;
    }

    /**
     * 初始化头部信息
     */
    public static function initHeader()
    {
        array_walk($_SERVER, function ($value, $key) {
            $key = strtolower($key);
            self::$header[$key] = $value;
        });
    }

    /**
     * 设置参数
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value)
    {
        self::$params[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed|false $default
     * //     * @return mixed
     */
    public static function get(string $key, $default = false)
    {
        if(empty($key)) {
            return self::$params;
        }

        return self::$params[$key] ?? $default;
    }

    /**
     * 获取头部信息
     * @param false $key
     * @return array|false|mixed
     */
    public static function header($key = false)
    {
        if(empty($key)) {
            return self::$header;
        }

        return self::$header[$key] ?? false;
    }

    /**
     * 设置头部信息
     * @param $key
     * @param $value
     */
    public static function setHeader($key, $value)
    {
        self::$header[$key] = $value;
    }
}