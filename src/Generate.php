<?php
// +----------------------------------------------------------------------
// | Success, real success,
// | is being willing to do the things that other people are not.
// +----------------------------------------------------------------------
// | Author:    Valencio Kang <ailin1219@foxmail.com>
// +----------------------------------------------------------------------
// | FileName:  Generate.php
// +----------------------------------------------------------------------
// | Year:      2025
// +----------------------------------------------------------------------
namespace Collinai\AuxiliaryOpen;

use InvalidArgumentException;
use Random\RandomException;


/**
 * Class Generate
 * @package Collinai\AuxiliaryOpen
 */
class Generate
{
    /**
     * 生成安全随机密钥
     *
     * @param int $length
     * @param string|null $prefix
     * @return string
     * @throws RandomException
     */
    public function generateSecureKey (int $length = 64, ?string $prefix = null): string
    {
        if ($length < 16) {
            throw new InvalidArgumentException('Key length too short. Minimum: 16 bytes');
        }

        $bytes = random_bytes(ceil($length / 2)); // 每个字节 = 2 hex字符

        $key = bin2hex($bytes);

        $key = substr($key, 0, $length);

        return $prefix ? $prefix . $key : $key;
    }


    /**
     * 生成唯一订单号（时间戳 + 毫秒 + 随机数）
     *
     * @return string
     * @throws RandomException
     */
    function generateOrderNumber (): string
    {
        $time = date('YmdHis');

        $milliseconds = (int)((microtime(true) - floor(microtime(true))) * 1000);
        $ms = str_pad($milliseconds, 3, '0', STR_PAD_LEFT);

        $rand = random_int(100, 999);

        return $time . $ms . $rand;
    }

    /**
     * 生成指定长度的唯一ID，格式类似于UUID
     *
     * @param int $length 期望的总长度（包含连字符），默认为36
     *                    有效范围：12-36，小于12时返回12字符，大于36时返回36字符
     * @return string 返回大写的唯一ID字符串，格式如: D15DC626-4BE5-4C9F-ABE6-2C79E7456031
     * @throws RandomException
     */
    public  function generateUniqueId (int $length = 36): string
    {
        // 强制转换为整数并限制长度范围
        $length = (int)max(12, min(36, $length));

        // 生成16字节随机数据
        $data = random_bytes(16);

        // 设置UUID v4版本和变体位
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // 版本 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // 变体

        // 转换为16进制字符串
        $hex = bin2hex($data);

        // 根据指定长度调整输出格式
        if ($length <= 12) {
            return strtoupper(substr($hex, 0, $length));
        }

        // 默认分段格式数组
        $segments = [8, 4, 4, 4, 12];
        $totalWithoutDashes = $length - 4; // 减去4个连字符的长度
        $remaining = $totalWithoutDashes;

        // 动态调整各段长度
        $adjustedSegments = [];
        foreach ($segments as $segment) {
            if ($remaining <= 0) {
                break;
            }
            $current = min($segment, $remaining);
            $adjustedSegments[] = $current;
            $remaining -= $current;
        }

        // 格式化输出
        $result = '';
        $offset = 0;
        foreach ($adjustedSegments as $index => $segLength) {
            $result .= substr($hex, $offset, $segLength);
            $offset += $segLength;
            if ($index < count($adjustedSegments) - 1) {
                $result .= '-';
            }
        }

        return strtoupper($result);
    }
}
