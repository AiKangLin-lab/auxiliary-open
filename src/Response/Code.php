<?php
// +----------------------------------------------------------------------
// | Success, real success,
// | is being willing to do the things that other people are not.
// +----------------------------------------------------------------------
// | Author:    Collin Ai <ailin1219@foxmail.com>
// +----------------------------------------------------------------------
// | FileName:  Code.php
// +----------------------------------------------------------------------
// | Year:      2024
// +----------------------------------------------------------------------
namespace Collinai\AuxiliaryOpen\Response;

/**
 * Class Code
 *
 * @package Collinai\AuxiliaryOpen\Response
 */
class Code
{
    //----------------------------------------------客户端错误状态码----------------------------------------------------

    /**
     * 400 Bad Request
     * 应用场景： 客户端发送的请求存在语法错误或无法被服务器理解。
     *
     * @var array
     */
    public static array $error = [
        'code'       => 400,
        'message'    => 'Invalid request parameters.',
        'zh_message' => '无效的请求参数。'
    ];

    /**
     * 401 Unauthorized
     * 应用场景： 需要身份验证，客户端未提供或提供的凭证无效。
     *
     * @var array
     */
    public static array $unauthorized = [
        'code'       => 401,
        'message'    => 'Unauthorized access.',
        'zh_message' => '未授权'
    ];

    /**
     * 403 Forbidden
     * 应用场景： 客户端已认证，但无权访问特定资源。
     *
     * @var array
     */
    public static array $forbidden = [
        'code'       => 403,
        'message'    => 'Access to this resource is forbidden.',
        'zh_message' => '禁止访问'
    ];

    /**
     * 404 Not Found
     * 应用场景： 请求的资源在服务器上不存在。
     *
     * @var array
     */
    public static array $notFound = [
        'code'       => 404,
        'message'    => 'The requested resource could not be found.',
        'zh_message' => '请求路径不存在'
    ];

    /**
     * 405 Method Not Allowed
     * 应用场景： 请求行中指定的请求方法不能被用于请求相应的资源。
     *
     * @var array
     */
    public static array $methodNotAllowed = [
        'code'       => 405,
        'message'    => 'The requested method is not allowed.',
        'zh_message' => '请求方法不允许'
    ];


    //------------------------------------------------------成功状态码---------------------------------------------------
    /**
     * 200 OK
     * 应用场景： 请求成功，资源被找到并返回。适用于GET、PUT、PATCH等操作。
     *
     * @var array
     */
    public static array $success = [
        'code'       => 200,
        'message'    => 'Resource retrieved successfully.',
        'zh_message' => '请求成功'
    ];

    /**
     * 201 Created
     * 应用场景： 请求成功并且服务器创建了新的资源。
     *
     * @var array
     */
    public static array $created = [
        'code'       => 201,
        'message'    => 'Resource created successfully.',
        'zh_message' => '创建成功'
    ];

    /**
     * 204 No Content
     * 应用场景： 服务器成功处理了请求，但不需要返回任何实体内容。适用于不返回所有资源列表的更新操作。
     *
     * @var array
     */
    public static array $noContent = [
        'code'       => 204,
        'message'    => 'ok',
        'zh_message' => '请求成功'
    ];

    //------------------------------------------------服务器错误状态码---------------------------------------------------


    /**
     * 500 Internal Server Error
     * 应用场景： 服务器遇到意外情况，无法完成请求。
     *
     * @var array
     */
    public static array $internalServerError = [
        'code'       => 500,
        'message'    => 'An unexpected error occurred on the server.',
        'zh_message' => '服务器错误'
    ];

    /**
     * 503 Service Unavailable
     * 应用场景： 服务暂时不可用，如维护、过载或服务器临时故障。
     *
     * @var array
     */
    public static array $serviceUnavailable = [
        'code'       => 503,
        'message'    => 'Service temporarily unavailable.',
        'zh_message' => '服务不可用'
    ];
}
