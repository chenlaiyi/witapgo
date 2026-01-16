<?php
/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2020-05-11 16:25:48
 * @LastEditTime: 2020-05-14 16:13:14
 */

global $_GPC, $_W;
$weid              = $_W['uniacid'];
$action            = 'attribute';
$this1             = 'no1';
$schoolid          = intval($_GPC['schoolid']);
$GLOBALS['frames'] = $this->getNaveMenu($_GPC['schoolid'], $action);
$logo              = pdo_fetch("SELECT logo,title FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
load()->func('tpl');
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'teadisplay';
$tid_global = $_W['tid'];

if($operation == 'teadisplay'){
    $type = "1";
    $typeName = "老师属性";
}elseif($operation == 'studisplay'){
    $type = "2";
    $typeName = "学生属性";
}elseif($operation == 'kcdisplay'){
    $type = "3";
    $typeName = "课程属性";
}elseif($operation == 'save'){
    $id = $_GPC['attrid'];
    $data = array(
        'weid' => $_GPC['weid'],
        'schoolid' => $_GPC['schoolid'],
        'name' => $_GPC['name'],
        'type' => $_GPC['type'],
        'category' => $_GPC['category'],
        'ssort' => $_GPC['ssort'] ? $_GPC['ssort'] : 0,
        'createtime' => time(),
    );
    if($id){
        pdo_update(GetTableName('attribute',false),$data,array('id'=>$id));
        $result['msg'] = '修改成功';
        $result['status'] = 1;
    }else{
        pdo_insert(GetTableName('attribute',false),$data);
        $result['msg'] = '添加成功';
        $result['status'] = 1;
    }
    $total = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('attribute')." WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = '{$_GPC['type']}' ");
    $result['total'] = $total;
    die(json_encode($result));
}elseif($operation == 'delete'){
    $id  = intval($_GPC['id']);
    $row = pdo_fetch("SELECT * FROM " . GetTableName('attribute') . " WHERE id = :id", array(':id' => $id));
    if(empty($row)){
        $this->imessage('抱歉，不存在或是已经被删除！', referer(), 'error');
    }
    pdo_delete(GetTableName('attribute',false), array('id' => $id));
    $this->imessage('删除成功！', referer(), 'success');
}
$condition = " AND type = {$type}";
$list = pdo_fetchall("SELECT * FROM " . GetTableName('attribute') ." WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' $condition ORDER BY ssort DESC ");
foreach ($list as &$value) {
    $value['category_name'] = setCategory($value['category']);
    $value['createtime'] = date("Y-m-d H:i",$value['createtime']);
}
$total = count($list);

//属性类型转换
function setCategory($category){
    if($category == 'text'){
        $name = '文本';
    }elseif($category == 'idcard'){
        $name = '身份证';
    }elseif($category == 'phone'){
        $name = '手机';
    }elseif($category == 'number'){
        $name = '数字';
    }elseif($category == 'date'){
        $name = '日期';
    }elseif($category == 'richtext'){
        $name = '富文本';
    }elseif($category == 'file'){
        $name = '附件';
    }
    return $name;
}
include $this->template('web/attribute');
