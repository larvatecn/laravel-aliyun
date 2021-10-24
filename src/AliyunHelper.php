<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace Larva\Aliyun;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Snsuapi\Snsuapi;

/**
 * 快速操作助手
 * @author Tongle Xu <xutongle@gmail.com>
 */
class AliyunHelper
{

    /**
     * 宽带提速预检查
     * @param string $ipAddress IP地址
     * @param int $port 端口
     * @return \AlibabaCloud\Client\Result\Result
     * @throws ClientException
     * @throws ServerException
     */
    public static function SnsuBandPreCheck(string $ipAddress, int $port)
    {
        return Snsuapi::v20180709()->bandPrecheck()->withIpAddress($ipAddress)->withPort($port)
            ->request();
    }
}