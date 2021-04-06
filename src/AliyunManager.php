<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Aliyun;

use Illuminate\Support\Manager;
use InvalidArgumentException;

/**
 * Class Aliyun
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class AliyunManager extends Manager
{
    /**
     * Get the bce service configuration.
     *
     * @param string $name
     * @return array
     */
    protected function getConfig(string $name): array
    {
        $config = $this->config["aliyun.services.{$name}"] ?: [];
        if (!isset($config['access_id']) || empty ($config['access_id'])) {
            $config['access_id'] = $this->config["aliyun.access_id"];
        }
        if (!isset($config['access_key']) || empty ($config['access_key'])) {
            $config['access_key'] = $this->config["aliyun.access_key"];
        }
        return $config;
    }

    /**
     * Get a driver instance.
     *
     * @param string $driver
     * @return mixed
     */
    public function with(string $driver)
    {
        return $this->driver($driver);
    }

    /**
     * Get a driver instance.
     *
     * @param string $driver
     * @return mixed
     */
    public function get(string $driver)
    {
        return $this->driver($driver);
    }

    /**
     * Get the default driver name.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No driver was specified.');
    }

    /**
     * 创建CDN服务
     * @return AliyunInterface
     */
    public function createCdnDriver()
    {
        $config = $this->getConfig('cdn');
        return new Services\Cdn(['accessId' => $config['access_id'], 'accessKey' => $config['access_key']]);
    }

    /**
     * 创建 CloudPush 服务
     * @return Services\CloudPush
     */
    public function createCloudPushDriver()
    {
        $config = $this->getConfig('cloudpush');
        return new Services\CloudPush([
            'accessId' => $config['access_id'],
            'accessKey' => $config['access_key'],
            'regionId' => $config['region_id'] ?? 'cn-hangzhou',
        ]);
    }

    /**
     * 创建 DNS 服务
     * @return Services\Dns
     */
    public function createDnsDriver()
    {
        $config = $this->getConfig('dns');
        return new Services\Dns([
            'accessId' => $config['access_id'],
            'accessKey' => $config['access_key'],
        ]);
    }

    /**
     * 创建 Domain 服务
     * @return Services\Domain
     */
    public function createDomainDriver()
    {
        $config = $this->getConfig('domain');
        return new Services\Domain([
            'accessId' => $config['access_id'],
            'accessKey' => $config['access_key'],
        ]);
    }

    /**
     * 创建 HttpDns 服务
     * @return Services\HttpDns
     */
    public function createHttpDnsDriver()
    {
        $config = $this->getConfig('httpDns');
        return new Services\HttpDns([
            'accessId' => $config['access_id'],
            'accessKey' => $config['access_key'],
        ]);
    }

    /**
     * 创建 Dm 服务
     * @return Services\Dm
     */
    public function createDmDriver()
    {
        $config = $this->getConfig('dm');
        return new Services\Dm([
            'accessId' => $config['access_id'],
            'accessKey' => $config['access_key'],
        ]);
    }

    /**
     * 创建 Snsu 服务
     * @return Services\SnSu
     */
    public function createSnSuDriver()
    {
        $config = $this->getConfig('snSu');
        return new Services\SnSu([
            'accessId' => $config['access_id'],
            'accessKey' => $config['access_key'],
            'regionId' => $config['region_id'] ?? 'cn-hangzhou',
        ]);
    }
}