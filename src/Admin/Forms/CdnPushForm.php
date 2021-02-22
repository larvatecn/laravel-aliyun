<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\Aliyun\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Larva\Aliyun\Jobs\CdnPushObjectCacheJob;

/**
 * CDN资源预热
 * @author Tongle Xu <xutongle@gmail.com>
 */
class CdnPushForm extends Form
{
    /**
     * 处理表单请求.
     *
     * @param array $input
     *
     * @return \Dcat\Admin\Http\JsonResponse
     */
    public function handle(array $input)
    {
        $urls = explode(PHP_EOL, trim($input['urls']));
        $area = trim($input['area']);
        CdnPushObjectCacheJob::dispatch($urls, $area);
        return $this->response()->success('任务委派成功!')->refresh();
    }

    /**
     * 构建表单.
     */
    public function form()
    {
        $this->select('area', '区域')->required()->options(['domestic' => '仅中国内地','overseas' => '全球（不包含中国内地）']);
        $this->textarea('urls')->required()->help('页面地址');
    }

    /**
     * 返回表单数据.
     *
     * @return array
     */
    public function default()
    {
        return [
            'urls' => '',
            'area' => 'domestic'
        ];
    }
}
