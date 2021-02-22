<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */
namespace Larva\Aliyun\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Larva\Aliyun\Aliyun;
use Larva\Aliyun\Services\Dns;

/**
 * Class DDNSDeleteJob
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class DNSDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * Create a new job instance.
     *
     * @param string $recordId
     */
    public function __construct($recordId)
    {
        $this->recordId = $recordId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var Dns $dns */
        $dns = Aliyun::get('dns');
        $dns->DeleteDomainRecord([
            'RecordId' => $this->recordId,
        ]);
    }
}