<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace Larva\Aliyun\Jobs\Cdn;

use AlibabaCloud\Cdn\Cdn;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

/**
 * 刷新节点上的文件内容。
 * @author Tongle Xu <xutongle@gmail.com>
 */
class RefreshObjectCachesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    public $tries = 3;

    /**
     * @var string|array
     */
    protected $urls;

    /**
     * @var string 内容类型
     */
    public string $objectType;

    /**
     * Create a new job instance.
     *
     * @param array|string $urls
     * @param string $objectType
     */
    public function __construct($urls, string $objectType = 'File')
    {
        if (is_string($urls)) {
            $this->urls = [$urls];
        } else {
            $this->urls = $urls;
        }
        $this->objectType = $objectType;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws ClientException
     * @throws ServerException
     */
    public function handle()
    {
        $response = Cdn::v20180510()->refreshObjectCaches()
            ->withObjectPath($this->urls)
            ->withObjectType(ucwords($this->objectType))
            ->request();
        if (!$response->isSuccess()) {
            $this->fail();
        }
    }
}