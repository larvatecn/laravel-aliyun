<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Aliyun;

use Illuminate\Support\Facades\Facade;

/**
 * 阿里云助手
 * @mixin AliyunManager
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Aliyun extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'aliyun';
    }

    /**
     * CDN
     * @return Services\Cdn
     */
    public static function cdn()
    {
        return static::getFacadeRoot()->driver('cdn');
    }

    /**
     * 云推送
     * @return Services\CloudPush
     */
    public static function cloudPush()
    {
        return static::getFacadeRoot()->driver('cloudpush');
    }

    /**
     * DM
     * @return Services\Dm
     */
    public static function dm()
    {
        return static::getFacadeRoot()->driver('dm');
    }

    /**
     * Dns
     * @return Services\Dns
     */
    public static function dns()
    {
        return static::getFacadeRoot()->driver('dns');
    }

    /**
     * Domain
     * @return Services\Domain
     */
    public static function domain()
    {
        return static::getFacadeRoot()->driver('domain');
    }

    /**
     * HttpDns
     * @return Services\HttpDns
     */
    public static function httpDns()
    {
        return static::getFacadeRoot()->driver('httpdns');
    }

    /**
     * 获取 智能游戏网络加速
     * @return Services\SnSu
     */
    public static function snsu()
    {
        return static::getFacadeRoot()->driver('snsu');
    }
}