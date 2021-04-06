<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use Larva\Aliyun\BaseService;
use Larva\Aliyun\RpcStack;

/**
 * Class HttpDns
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class HttpDns extends BaseService
{
    /**
     * @return string
     */
    public function getBaseUri()
    {
        return 'https://httpdns-api.aliyuncs.com';
    }

    /**
     * @return HandlerStack
     */
    public function getHttpStack()
    {
        $stack = HandlerStack::create();
        $middleware = new RpcStack([
            'accessKeyId' => $this->accessId,
            'accessSecret' => $this->accessKey,
            'version' => '2016-02-01',
        ]);
        $stack->push($middleware);
        return $stack;
    }
}