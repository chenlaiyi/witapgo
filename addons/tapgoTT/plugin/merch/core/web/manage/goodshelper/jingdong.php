<?php



if (!defined('IN_IA')) {
    exit('Access Denied');
}
require TAPGO_TT_PLUGIN . 'merch/core/inc/page_merch.php';

class Jingdong_TapgoTtPage extends MerchWebPage
{

    /**
     * @author 徐子轩
     */
    public function main()
    {
        global $_W;

        $type = 'jd';
        $sql = 'SELECT * FROM ' . tablename('tapgo_tt_category') . ' WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC';

        $category = m('shop')->getFullCategory(true, true);

        include $this->template('goodshelper/index');

    }

}
