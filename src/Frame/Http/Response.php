<?php

namespace Gg\Frame\Http;
class Response
{
    private static $content = [
        '100' => 'Continue', // 继续。 客户端应该继续其请求
        '101' => 'Switching Protocols', // 切换协议，服务器根据客户端的请求切换协议
        '200' => 'OK',  //请求成功 GET | POST
        '201' => 'Created', // 已创建成功请求并创建了新的资源 post created
        '202' => 'Accepted',    // 已接受， 已接受请求但未处理成功
        '203' => 'Non-Authoritative Information', // 非授权先信息。请求成功
        '204' => 'No Content', // 无内容。服务器成功处理，但未返回内容
        '205' => 'Reset Content',   // 重置内容。处理成功客户端重置内容
        '206' => 'Partial Content', // 部分内容. 服务器成功处理了部分GET请求

        '300' => 'Multiple Choices', //多种选择。请求的字段可包括多个位置，相应可返回一个字段特征与地址的列表
        '301' => 'Moved Permanently', // 永久移动
        '302' => 'Found', //    临时移动
        '303' => 'See Other', // 查看其它地址
        '304' => 'Not Modified', // 未修改 缓存
        '305' => 'Use Proxy',   // 使用代理，请求的资源必须通过代理访问
        '307' => 'Temporary Redirect', // 临时重定向 一般使用302

        '400' => 'Bad Request',  // 客户端错误
        '401' => 'Unauthorized',    // 无认证权限
        '402' => 'Payment Required',    // 存档
        '403' => 'Forbidden', // 服务器拒绝访问， 不是语法错误
        '404' => 'Not Found', // 找不到资源
        '405' => 'Method Not Allowed', //方法使用错误 比如post 请求 用get访问
        '406' => 'Not Acceptable',  // 服务器无法根据客户端请求的内容特性完成请求
        '407' => 'Proxy Authentication Required', // 要求必须使用代理
        '408' => 'Request Time-out', //请求超时
        '409' => 'Conflict',
        '410' => 'Gone',
        '411' => 'Length Required',
        '412' => 'Precondition Failed',
        '413' => 'Request Entity Too Large',
        '414' => 'Request-URI Too Large',
        '415' => 'Unsupported Media Type',
        '416' => 'Requested range not satisfiable',
        '417' => 'Expectation Failed',

        '500' => 'Internal Server Error', // 服务器内部错误
        '501' => 'Not Implemented', // 服务器不支持请求功能，无法完成请求
        '502' => 'Bad Gateway', // 网关错误
        '503' => 'Service Unavailable', // 服务器超载或者在维护
        '504' => 'Gateway Time-out',
        '505' => 'Http Version not supported'
    ];

    private static function content($code)
    {
        $content = '' . $code . ' ' . self::$content[$code] ?? 'Unknown';
        header("Status: " . $content);
    }

    private static function info($code, $status = '', $message = '', $data = [])
    {
        self::content($code);
        echo json_encode(compact('status', 'message', 'data'));
        exit(0);
    }

    public static function ok($status = '', $message = '', $data = [])
    {
        self::info(200, $status, $message, $data);
    }

    public static function created($status = '', $message = '', $data =[])
    {
        self::info(201, $status, $message, $data);
    }

    public static function accepted($status = '', $message = '', $data =[])
    {
        self::info(202, $status, $message, $data);
    }

    public static function nonAuthoritativeInformation($status = '', $message = '', $data =[])
    {
        self::info(203, $status, $message, $data);
    }

    public static function noContent($status = '', $message = '', $data =[])
    {
        self::info(204, $status, $message, $data);
    }

    public static function resetContent($status = '', $message = '', $data =[])
    {
        self::info(205, $status, $message, $data);
    }

    public static function partialContent($status = '', $message = '', $data =[])
    {
        self::info(206, $status, $message, $data);
    }

    public static function Found($status = '', $message = '', $data =[])
    {
        self::info(302, $status, $message, $data);
    }

    public static function NotModified($status = '', $message = '', $data =[])
    {
        self::info(304, $status, $message, $data);
    }

    public static function badRequest($status = '', $message = '', $data =[])
    {
        self::info(400, $status, $message, $data);
    }

    public static function unauthorized($status = '', $message = '', $data =[])
    {
        self::info(401, $status, $message, $data);
    }

    public static function forbidden($status = '', $message = '', $data =[])
    {
        self::info(403, $status, $message, $data);
    }

    public static function notFound($status = '', $message = '', $data =[])
    {
        self::info(404, $status, $message, $data);
    }

    public static function methodNotAllowed($status = '', $message = '', $data =[])
    {
        self::info(405, $status, $message, $data);
    }

    public static function internalServerError($status = '', $message = '', $data =[])
    {
        self::info(500, $status, $message, $data);
    }

    public static function badGateway($status = '', $message = '', $data =[])
    {
        self::info(502, $status, $message, $data);
    }

    public static function serviceUnavailable($status = '', $message = '', $data =[])
    {
        self::info(503, $status, $message, $data);
    }
}
