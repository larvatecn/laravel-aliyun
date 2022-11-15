<?php
/**
 * This is NOT a freeware, use is subject to license terms
 */

declare(strict_types=1);

namespace Larva\Aliyun;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Live\Live;
use Illuminate\Support\Facades\Log;

/**
 * 直播助手
 * @author Tongle Xu <xutongle@msn.com>
 */
class LiveHelper
{
    /**
     * 设置直播推流回调配置
     * @param string $pushDomain
     * @param string $notifyUrl
     * @return bool
     */
    public static function setLiveStreamsNotifyUrlConfig(string $pushDomain, string $notifyUrl): bool
    {
        try {
            Live::v20161101()->setLiveStreamsNotifyUrlConfig()
                ->withDomainName($pushDomain)
                ->withNotifyUrl($notifyUrl)
                ->format('JSON')
                ->request();
            return true;
        } catch (ServerException|ClientException $exception) {
            Log::error('Aliyun:Live:' . $exception->getMessage());
            return false;
        }
    }

    /**
     * 删除流回调配置
     * @param string $pushDomain
     * @return bool
     */
    public static function deleteLiveStreamsNotifyUrlConfig(string $pushDomain): bool
    {
        try {
            Live::v20161101()->deleteLiveStreamsNotifyUrlConfig()
                ->withDomainName($pushDomain)
                ->format('JSON')
                ->request();
            return true;
        } catch (ServerException|ClientException $exception) {
            Log::error('Aliyun:Live:' . $exception->getMessage());
            return false;
        }
    }

    /**
     * 禁止推流
     * @param string $appName
     * @param string $pushDomain
     * @param string $stream
     * @return bool
     */
    public static function forbidLiveStream(string $appName, string $pushDomain, string $stream): bool
    {
        try {
            Live::v20161101()->forbidLiveStream()
                ->withAppName($appName)
                ->withDomainName($pushDomain)
                ->withStreamName($stream)
                ->format('JSON')
                ->request();
            return true;
        } catch (ServerException|ClientException $exception) {
            Log::error('Aliyun:Live:' . $exception->getMessage());
            return false;
        }
    }

    /**
     * 恢复推流
     * @param string $appName
     * @param string $pushDomain
     * @param string $stream
     * @return bool
     */
    public static function resumeLiveStream(string $appName, string $pushDomain, string $stream): bool
    {
        try {
            Live::v20161101()
                ->resumeLiveStream()
                ->withAppName($appName)
                ->withDomainName($pushDomain)
                ->withStreamName($stream)
                ->format('JSON')
                ->request();
            return true;
        } catch (ServerException|ClientException $exception) {
            Log::error('Aliyun:Live:' . $exception->getMessage());
            return false;
        }
    }
}