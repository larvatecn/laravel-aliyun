<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */


namespace Larva\Aliyun;

use Illuminate\Support\Facades\Facade;
use Larva\Aliyun\Services\SnSu;

/**
 * Class Sms
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
    protected static function getFacadeAccessor()
    {
        return 'aliyun';
    }

    /**
     * 获取 snSu
     * @return SnSu
     */
    public static function snsu()
    {
        return static::getFacadeRoot()->with('snSu');
    }
}