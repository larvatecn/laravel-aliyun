<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\Aliyun\Admin\Controllers;

use Larva\Aliyun\Admin\Repositories\Dns;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

/**
 * DNS管理
 * @author Tongle Xu <xutongle@gmail.com>
 */
class DnsController extends AdminController
{
    /**
     * @return string
     */
    protected function title()
    {
        return 'DNS管理';
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Dns(), function (Grid $grid) {
            $grid->column('DomainId', 'ID');
            $grid->column('DomainName', '域名');
            $grid->column('RecordCount', '解析数');
            $grid->column('Remark', '备注');
            $grid->column('AliDomain', '阿里云域名')->bool();
            $grid->column('VersionName','套餐');
            $grid->column('InstanceExpired', '是否过期')->bool();
            $grid->column('InstanceEndTime', '过期时间')->sortable();

            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->paginate(10);
        });
    }
}
