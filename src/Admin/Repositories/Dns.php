<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\Aliyun\Admin\Repositories;

use Dcat\Admin\Grid;
use Dcat\Admin\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Larva\Aliyun\Aliyun;

/**
 * 域名DNS
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Dns extends Repository
{
    /**
     * 查询表格数据
     *
     * @param Grid\Model $model
     * @return LengthAwarePaginator
     */
    public function get(Grid\Model $model)
    {
        /** @var \Larva\Aliyun\Services\Dns $dns */
        $dns = Aliyun::get('dns');

        $currentPage = $model->getCurrentPage();
        $perPage = $model->getPerPage();

        $params = [
            'PageNumber' => $currentPage,
            'PageSize' => $perPage
        ];

        // 域名搜索
        $data = $dns->describeDomains($params);
        return $model->makePaginator(
            $data['TotalCount'] ?? 0,
            $data['Domains']['Domain'] ?? []
        );
    }
}
