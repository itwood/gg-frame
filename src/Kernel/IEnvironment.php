<?php

namespace Gg\Kernel;

interface IEnvironment
{
    /**
     * 环境初始化
     * @param \Yaf\Application $application
     * @return mixed
     */
    public static function init(\Yaf\Application $application): void;

    /**
     * 设置环境
     * @param string $env
     */
    public static function set(string $env);

    /**
     * 获得环境
     * @return string
     */
    public static function get(): string;

    /**
     * 包装文件 #todo
     * @param string $filename
     * @return mixed
     */
    public static function wrap(string $filename): string;
}
