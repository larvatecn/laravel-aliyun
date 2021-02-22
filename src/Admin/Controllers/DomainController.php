<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\Aliyun\Admin\Controllers;

use Larva\Aliyun\Admin\Repositories\Domain;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

/**
 * 域名管理
 * @author Tongle Xu <xutongle@gmail.com>
 */
class DomainController extends AdminController
{
    /**
     * @return string
     */
    protected function title()
    {
        return '域名管理';
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Domain(), function (Grid $grid) {
            $grid->column('DomainName', '域名');
            $grid->column('DomainType', '类型')->using(Domain::getTypeLabels());
            $grid->column('DomainStatus', '状态')->using(Domain::getStatusLabels());
            $grid->column('DomainAuditStatus', '实名状态')->using(Domain::getAuditStatusLabels());
            $grid->column('ExpirationCurrDateDiff', '剩余天数');
            $grid->column('RegistrationDate', '注册时间')->sortable();
            $grid->column('ExpirationDate', '过期时间')->sortable();

            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->paginate(10);
        });
    }
}
