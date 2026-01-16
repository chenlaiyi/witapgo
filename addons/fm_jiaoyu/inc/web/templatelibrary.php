<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */

global $_GPC, $_W;
$weid = $_W['uniacid'];
$action = 'templatelibrary';
load()->func('tpl');
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$cateList = pdo_fetchAll("SELECT * FROM ".GetTableName('template_library_category')." WHERE weid = '{$weid}' ORDER BY ssort DESC ");
if ($operation == 'display') {
    //是否启用过了一键恢复
    $hasrecovery = pdo_fetch("SELECT id FROM ".GetTableName('template_library_category')." WHERE weid = '{$weid}' AND id = 1");
    $showrecovery = true; //默认显示一键恢复
    if($hasrecovery){
        $showrecovery = false; //不显示一键恢复按钮
    }else{
        $showrecovery = true; //显示一键恢复按钮
    }
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 15;
    $list = pdo_fetchAll("SELECT c.*,(SELECT count(w.id) FROM ".GetTableName('template_library')." as w WHERE w.weid = '{$weid}' AND w.cate_id = c.id AND w.status = 1) as webnum,(SELECT count(m.id) FROM ".GetTableName('template_library')." as m WHERE m.weid = '{$weid}' AND m.cate_id = c.id AND m.status = 2) as mobilenum FROM ".GetTableName('template_library_category')." as c WHERE c.weid = '{$weid}' ORDER BY c.ssort DESC ");
    $total = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . GetTableName('template_library_category') . " WHERE weid = '{$weid}'");
    $pager = pagination($total, $pindex, $psize);
} elseif ($operation == 'addcategory') {
    $id = intval($_GPC['id']);
    if($_GPC['id']){
        $item = pdo_fetch("SELECT * FROM ".GetTableName('template_library_category')." WHERE id = '{$_GPC['id']}' ");
    }
    if (checksubmit('submit')) {
        $data = array(
            'weid' => intval($weid),
            'ssort' => $_GPC['ssort'],
            'name' => $_GPC['name'],
            'type' => $_GPC['type'],
            'status' => $_GPC['status'],
            'createtime' => time()
        );
        
        if (!empty($_GPC['id'])) {
            pdo_update(GetTableName('template_library_category',false), $data, array('id' => $_GPC['id']));
        } else {
            pdo_insert(GetTableName('template_library_category',false), $data);
        }
        message('操作成功！', $this->createWebUrl('templatelibrary', array('op' => 'display')), 'success');
    }
} elseif ($operation == 'delcategory') {
    $id = intval($_GPC['id']);
    $category = pdo_fetch("SELECT id FROM " . GetTableName('template_library_category') . " WHERE id = '{$id}' AND weid='{$weid}'");
    if (empty($category)) {
        message('抱歉，模板分类不存在或是已经被删除！', $this->createWebUrl('templatelibrary', array('op' => 'display')), 'error');
    }
    pdo_delete(GetTableName('template_library_category',false), array('id' => $id));
    message('模板分类删除成功！', $this->createWebUrl('templatelibrary', array('op' => 'display')), 'success');
} elseif ($operation == 'library') {
    $condition = '';
    if($_GPC['cate_id']){
        $condition = " AND t.cate_id = '{$_GPC['cate_id']}'";
    }
    $list = pdo_fetchAll("SELECT t.*,c.name as catename FROM ".GetTableName('template_library')." as t LEFT JOIN ".GetTableName('template_library_category')." as c ON c.id = t.cate_id WHERE t.weid = '{$weid}' $condition ORDER BY t.ssort DESC,t.id ASC ");
} elseif ($operation == 'deltemp') {
    $id = intval($_GPC['id']);
    $temp = pdo_fetch("SELECT id FROM " . GetTableName('template_library') . " WHERE id = '{$id}' AND weid='{$weid}'");
    if (empty($temp)) {
        message('抱歉，模板分类不存在或是已经被删除！', $this->createWebUrl('templatelibrary', array('op' => 'library')), 'error');
    }
    pdo_delete(GetTableName('template_library',false), array('id' => $id));
    message('模板分类删除成功！', $this->createWebUrl('templatelibrary', array('op' => 'library')), 'success');
} elseif ($operation == 'addtemp') {
    $id = intval($_GPC['id']);
    
    if($_GPC['id']){
        $item = pdo_fetch("SELECT * FROM ".GetTableName('template_library')." WHERE id = '{$_GPC['id']}' ");
    }
    if (checksubmit('submit')) {
        $data = array(
            'weid' => intval($weid),
            'ssort' => $_GPC['ssort'],
            'name' => $_GPC['name'],
            'cate_id' => $_GPC['cate_id'],
            'thumb' => $_GPC['thumb'],
            'content' => $_GPC['status'] == 1 ? $_GPC['content'] : $_GPC['mobilecontent'],
            'description' => $_GPC['description'],
            'status' => $_GPC['status'],
            'createtime' => time()
        );
        if (!empty($_GPC['id'])) {
            pdo_update(GetTableName('template_library',false), $data, array('id' => $_GPC['id']));
        } else {
            pdo_insert(GetTableName('template_library',false), $data);
        }
        message('操作成功！', $this->createWebUrl('templatelibrary', array('op' => 'library')), 'success');
    }
} elseif ($operation == 'recovery'){
    //读取微教育默认数据，并写入到文件(客户数据没有时解开注释调用---只有一次)
    // $list = pdo_fetchAll("SELECT * FROM ".GetTableName('template_library')." WHERE weid = '{$weid}' ORDER BY ssort DESC ");
    // $data = [];
    // foreach ($list as $key => $value) {
    //     $data[$key] = array(
    //         array(
    //             'weid' => $value['weid'],
    //             'name' => $value['name'],
    //             'cate_id' => $value['cate_id'],
    //             'thumb' => $value['thumb'],
    //             'content' => $value['content'],
    //             'description' => $value['description'],
    //             'ssort' => $value['ssort'],
    //             'status' => $value['status'],
    //             'createtime' => $value['createtime'],
    //         ),
    //     );
    // }
    // $data = json_encode($data);
    // WriteLibrary($data,'templibrary_txt');
    // 读取微教育默认数据，并写入到文件(客户数据没有时解开注释调用---只有一次)
    $cate_data = getCateData($weid);
    foreach ($cate_data as $key => $value) {
        pdo_insert(GetTableName('template_library_category',false),$value);
    }
    $dir = IA_ROOT . '/addons/fm_jiaoyu/inc/web/templibrary_txt.php';
    $library_data = json_decode(file_get_contents($dir),true);
    foreach ($library_data as $key => $json_data) {
        foreach ($json_data as $k => $value) {
            $inserData = array(
                'weid' => $weid,
                'name' => $value['name'],
                'cate_id' => $value['cate_id'],
                'thumb' => $value['thumb'],
                'content' => $value['content'],
                'description' => $value['description'],
                'ssort' => $value['ssort'],
                'status' => $value['status'],
                'createtime' => $value['createtime'],
            );
            pdo_insert(GetTableName('template_library',false),$inserData);
        }
    }
    message('操作成功！', $this->createWebUrl('templatelibrary', array('op' => 'display')), 'success');
} elseif ($operation == 'truncate'){
    pdo_query("truncate TABLE ".tablename('wx_school_template_library_category'));
    pdo_query("truncate TABLE ".tablename('wx_school_template_library'));
    message('操作成功！', $this->createWebUrl('templatelibrary', array('op' => 'display')), 'success');
} else {
    message('请求方式不存在');
}
function getCateData($weid){
    $data = array(
        array(
            'weid' => $weid,
            'name' => '其他通知',
            'type' => 0,
            'status' => 1,
            'ssort' => 1,
            'createtime' => time(),
        ),
        array(
            'weid' => $weid,
            'name' => '培训机构',
            'type' => 0,
            'status' => 1,
            'ssort' => 2,
            'createtime' => time(),
        ),
        array(
            'weid' => $weid,
            'name' => '活动通知',
            'type' => 0,
            'status' => 1,
            'ssort' => 3,
            'createtime' => time(),
        ),
        array(
            'weid' => $weid,
            'name' => '安全通知',
            'type' => 0,
            'status' => 1,
            'ssort' => 4,
            'createtime' => time(),
        ),
        array(
            'weid' => $weid,
            'name' => '班级通知',
            'type' => 0,
            'status' => 1,
            'ssort' => 5,
            'createtime' => time(),
        ),
        array(
            'weid' => $weid,
            'name' => '疫情相关',
            'type' => 0,
            'status' => 1,
            'ssort' => 6,
            'createtime' => time(),
        ),
        array(
            'weid' => $weid,
            'name' => '放假通知',
            'type' => 0,
            'status' => 1,
            'ssort' => 7,
            'createtime' => time(),
        ),
        array(
            'weid' => $weid,
            'name' => '作业通知',
            'type' => 0,
            'status' => 1,
            'ssort' => 8,
            'createtime' => time(),
        ),
    );
    return $data;
}
function WriteLibrary($GetData,$fileName="templibrary"){
	$txtname = $fileName.'.php';
    $DIR = IA_ROOT . '/attachment/log/templibrary';
	if(!is_dir($DIR)){
		mkdir(iconv("UTF-8", "GBK", $DIR),0777,true);
	}
    $txtpath_name = $DIR.'/' . $txtname;
	ob_start(); //打开缓冲区
	echo $GetData;
	$a = ob_get_contents(); //输出缓冲区内容到$a,相当于赋值给$a
	ob_clean();   //这里清除缓冲区内容

	$fp = fopen($txtpath_name,"a");//打开文件资源通道 不存在则自动创建
    fwrite($fp,$a."\r\n");//写入文件
	fclose($fp);//关闭资源通道
	return $DIR;
}
include $this->template('web/templatelibrary');
?>