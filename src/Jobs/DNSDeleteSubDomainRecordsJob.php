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
 * Class DNSDeleteSubDomainRecordsJob
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class DNSDeleteSubDomainRecordsJob implements ShouldQueue
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
    protected $domain;

    /**
     * @var string
     */
    protected $hostName;

    /**
     * @var string
     */
    protected $type;

    /**
     * Create a new job instance.
     *
     * @param string $domain
     * @param string $hostname
     * @param string $type
     */
    public function __construct($domain, $hostname, $type)
    {
        $this->domain = $domain;
        $this->hostName = $hostname;
        $this->type = $type;
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
        $dns->DeleteSubDomainRecords([
            'DomainName' => $this->domain,
            'RR' => $this->hostName,
            'Type' => $this->type,
        ]);
    }
}