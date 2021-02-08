<?php

/**
 * 调试输出
 */
if (!function_exists('dd')) {
    function dd(...$args)
    {
        foreach ($args as $x) {
            var_dump($x);
        }
        exit(0);
    }
}
