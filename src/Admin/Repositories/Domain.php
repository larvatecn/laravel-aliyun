<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\Aliyun\Admin\Repositories;

use AlibabaCloud\Domain\Domain as AliDomain;
use Dcat\Admin\Grid;
use Dcat\Admin\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class Domain
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Domain extends Repository
{
    //域名类型
    const TYPE_NEWGTLD = 'New gTLD';
    const TYPE_GTLD = 'gTLD';
    const TYPE_CCTLD = 'ccTLD';

    //实名状态
    const AUDIT_STATUS_FAILED = 'FAILED';
    const AUDIT_STATUS_SUCCEED = 'SUCCEED';
    const AUDIT_STATUS_NONAUDIT = 'NONAUDIT';
    const AUDIT_STATUS_AUDITING = 'AUDITING';

    const STATUS_RENEW = 1;
    const STATUS_REDEMPTION = 2;
    const STATUS_NORMAL = 3;

    /**
     * 域名状态
     * @return string[]
     */
    public static function getAuditStatusLabels()
    {
        return [
            static::AUDIT_STATUS_FAILED => '实名认证失败',
            static::AUDIT_STATUS_SUCCEED => '实名认证成功',
            static::AUDIT_STATUS_NONAUDIT => '未实名认证',
            static::AUDIT_STATUS_AUDITING => '审核中',
        ];
    }

    /**
     * 域名状态
     * @return string[]
     */
    public static function getStatusLabels()
    {
        return [
            static::STATUS_RENEW => '急需续费',
            static::STATUS_REDEMPTION => '急需赎回',
            static::STATUS_NORMAL => '正常',
        ];
    }

    /**
     * 获取域名类型
     * @return string[]
     */
    public static function getTypeLabels()
    {
        return [
            static::TYPE_NEWGTLD => '新顶级域',
            static::TYPE_GTLD => '通用顶级域',
            static::TYPE_CCTLD => '国别域',
        ];
    }

    /**
     * 查询表格数据
     *
     * @param Grid\Model $model
     * @return LengthAwarePaginator
     */
    public function get(Grid\Model $model)
    {
        $domain = AliDomain::v20180208();

        $currentPage = $model->getCurrentPage();
        $perPage = $model->getPerPage();

        $params = [
            'PageNum' => $currentPage,
            'PageSize' => $perPage
        ];
        //排序
        $sort = $model->getSort();
        if (!is_null($sort[0]) && !is_null($sort[1])) {
            $params['OrderKeyType'] = $sort[0];
            $params['OrderByType'] = strtoupper($sort[1]);
        }

        // 域名搜索
        $data = $domain->queryDomainList($params);
        return $model->makePaginator(
            $data['TotalItemNum'] ?? 0,
            $data['Data']['Domain'] ?? []
        );
    }
}
