<?php
/**
 * This is NOT a freeware, use is subject to license terms
 */
declare(strict_types=1);

namespace Larva\Aliyun\Jobs\Live;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Live\Live;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Larva\Aliyun\AliyunException;

class StreamsNotifySetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var string
     */
    protected string $pushDomain;

    /**
     * @var string
     */
    protected string $notifyUrl;

    /**
     * Create a new job instance.
     */
    public function __construct(string $pushDomain, string $notifyUrl)
    {
        $this->pushDomain = $pushDomain;
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Live::v20161101()->setLiveStreamsNotifyUrlConfig()
                ->withDomainName($this->pushDomain)
                ->withNotifyUrl($this->notifyUrl)
                ->format('JSON')
                ->request();
        } catch (ClientException|ServerException $e) {
            throw new AliyunException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}