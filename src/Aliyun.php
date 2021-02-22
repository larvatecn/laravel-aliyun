<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */


namespace Larva\Aliyun;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sms
 * @mixin AliyunManage
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
}