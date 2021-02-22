<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */


namespace Larva\Aliyun;

use Illuminate\Support\ServiceProvider;

/**
 * Class AliyunServiceProvider
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class AliyunServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupConfig();

        $this->app->singleton('aliyun', function () {
            return new AliyunManage($this->app);
        });
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath($raw = __DIR__ . '/../config/aliyun.php') ?: $raw;

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $source => config_path('aliyun.php'),
            ], 'aliyun-config');
        }

        $this->mergeConfigFrom($source, 'aliyun');
    }
}