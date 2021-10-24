<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace Larva\Aliyun\Jobs\Dns;

use AlibabaCloud\Alidns\Alidns;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

/**
 * 修改解析记录
 * @author Tongle Xu <xutongle@gmail.com>
 */
class UpdateDomainRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    public $tries = 2;

    /**
     * @var string
     */
    protected $recordId;

    /**
     * @var string
     */
    protected $rr;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var string
     */
    protected $line;

    /**
     * Create a new job instance.
     *
     * @param string $recordId
     * @param string $hostname
     * @param string $type
     * @param string $value
     * @param int $ttl
     * @param string $line
     */
    public function __construct(string $recordId, string $rr, string $type, string $value, int $ttl = 600, string $line = 'default')
    {
        $this->recordId = $recordId;
        $this->rr = $rr;
        $this->type = $type;
        $this->value = $value;
        $this->ttl = $ttl;
        $this->line = $line;
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
        $response = Alidns::v20150109()->updateDomainRecord()
            ->withRecordId($this->recordId)
            ->withRR($this->rr)
            ->withType($this->type)
            ->withValue($this->value)
            ->withTTL($this->ttl)
            ->withLine($this->line)
            ->request();
        if (!$response->isSuccess()) {
            $this->fail();
        }
    }
}