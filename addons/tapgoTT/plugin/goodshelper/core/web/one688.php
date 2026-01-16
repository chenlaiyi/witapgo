<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class One688_TapgoTtPage extends PluginWebPage
{

    public function main()
    {
        global $_W;

        $type = 'alibaba';
        $sql = 'SELECT * FROM ' . tablename('tapgo_tt_category') . ' WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC';

        $category = m('shop')->getFullCategory(true, true);

        include $this->template('goodshelper/index');

    }

}
