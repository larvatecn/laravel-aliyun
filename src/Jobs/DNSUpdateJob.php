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
 * Class DNSUpdateJob
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class DNSUpdateJob implements ShouldQueue
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
     * @var string
     */
    protected $hostName;

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
    public function __construct($recordId, $hostname, $type, $value, $ttl = 600, $line = 'default')
    {
        $this->recordId = $recordId;
        $this->hostName = $hostname;
        $this->type = $type;
        $this->value = $value;
        $this->ttl = $ttl;
        $this->line = $line;
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
        $dns->updateDomainRecord([
            'RecordId' => $this->recordId,//解析记录ID
            'RR' => $this->hostName,
            'Type' => $this->type,
            'Value' => $this->value,
            'TTL' => $this->ttl,
            'Line' => $this->line,
        ]);
    }
}