<?php

namespace Larva\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use Larva\Aliyun\BaseService;
use Larva\Aliyun\RpcStack;

/**
 * 云通信网络加速
 *
 * @see https://help.aliyun.com/product/86106.html
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class SnSu extends BaseService
{
    /**
     * @return string
     */
    public function getBaseUri()
    {
        return 'https://snsuapi.aliyuncs.com';
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
            'version' => '2018-07-09',
        ]);
        $stack->push($middleware);
        return $stack;
    }

    /**
     * 宽带加速预校验
     * @param string $ip 宽带出口IP
     * @param int $port 宽带端口
     * @return array
     */
    public function bandPreCheck($ip, $port)
    {
        $params = [
            'Action' => 'BandPreCheck',
            'IpAddress' => $ip,
            'Port' => $port
        ];
        return $this->post('', $params);
    }

    /**
     * 订购宽带加速
     * @param string $bandId 加速宽带ID
     * @param string $offerId 在预备检查接口中返回的可订购产品ID
     * @return array
     */
    public function bandOfferOrder($bandId, $offerId)
    {
        $params = [
            'Action' => 'BandOfferOrder',
            'BandId' => $bandId,
            'OfferId' => $offerId
        ];
        return $this->post('', $params);
    }

    /**
     * 开启宽带加速
     * @param string $ip 宽带出口IP
     * @param int $port 宽带端口
     * @param string $bandId 加速宽带ID
     * @param string $direction 加速方向 上行/下行 UP/DOWN
     * @param int $targetBandwidth 加速目标带宽，单位Mbps
     * @param int $bandScene 加速场景
     * @return array
     */
    public function bandSpeedUp($ip, $port, $bandId, $direction, $targetBandwidth, $bandScene = 1)
    {
        $params = [
            'Action' => 'BandSpeedUp',
            'IpAddress' => $ip,
            'Port' => $port,
            'BandId' => $bandId,
            'Direction' => $direction,
            'TargetBandwidth' => $targetBandwidth,
            'BandScene' => $bandScene
        ];
        return $this->post('', $params);
    }

    /**
     * 停止宽带加速
     * @param string $ip 宽带出口IP
     * @param int $port 宽带端口
     * @param string $bandId 加速宽带ID
     * @param string $direction 加速方向 上行/下行 UP/DOWN
     * @return array
     */
    public function bandStopSpeedUp($ip, $port, $bandId, $direction)
    {
        $params = [
            'Action' => 'BandStopSpeedUp',
            'IpAddress' => $ip,
            'Port' => $port,
            'BandId' => $bandId,
            'Direction' => $direction,
        ];
        return $this->post('', $params);
    }

    /**
     * 加速状态查询
     * @param string $bandId 加速宽带ID
     * @return array
     */
    public function bandStatusQuery($bandId)
    {
        $params = [
            'Action' => 'BandStatusQuery',
            'BandId' => $bandId
        ];
        return $this->post('', $params);
    }
}