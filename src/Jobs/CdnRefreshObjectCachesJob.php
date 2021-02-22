<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Aliyun\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Larva\Aliyun\Aliyun;

/**
 * CDN 资源刷新
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class CdnRefreshObjectCachesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    public $tries = 3;

    /**
     * @var array
     */
    public $urls;

    /**
     * @var string 内容类型
     */
    public $objectType;

    /**
     * Create a new job instance.
     *
     * @param string|array $urls
     * @param $objectType
     */
    public function __construct($urls, $objectType = 'File')
    {
        if (is_string($urls)) {
            $this->urls = [$urls];
        } else {
            $this->urls = $urls;
        }
        foreach ($this->urls as $key => $url) {
            $url = $this->parseUrl($url);
            $this->urls[$key] = $url;
        }

        $this->objectType = $objectType;
    }

    public function parseUrl($url)
    {
        $u = parse_url($url);
        if ($u) {
            $url = $u['host'];
            if (!isset($u['path'])) {
                $u['path'] = '/';
            }
            $url = $url . $u['path'];
            if (isset($u['query'])) {
                $url = $url . $u['query'];
            }
            return $url;
        }
        return $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        try {
            /** @var \Larva\Aliyun\Services\Cdn $cdn */
            $cdn = Aliyun::get('cdn');
            $cdn->RefreshObjectCaches([
                'ObjectPath' => implode("\n", $this->urls),
                'ObjectType' => $this->objectType,
            ]);
        } catch (\Exception $exception) {

        }
    }
}
