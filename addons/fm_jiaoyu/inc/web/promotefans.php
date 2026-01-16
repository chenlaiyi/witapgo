<?php
/**
 * 微教育模块
 *
 * @author CC
 */
global $_GPC, $_W;
$weid              = $_W['uniacid'];
$action            = 'promotefans';
$this1             = 'no2';
$GLOBALS['frames'] = $this->getNaveMenu($_GPC['schoolid'], $action);
$operation         = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$schoolid          = intval($_GPC['schoolid']);

$logo = pdo_fetch("SELECT logo,title,is_kb FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
$tid_global = $_W['tid'];

$xxz = false; //学习值
if (IsHasQx($tid_global,1000945,1,$schoolid)){
    $xxz = true;
}
$dhgz = false;
if (IsHasQx($tid_global,1000946,1,$schoolid)){
    $dhgz = true;
}
if($operation == 'display'){
   
    $setInfo = pdo_fetch("SELECT * FROM " . GetTableName('yiheedu_set') . " WHERE weid='{$weid}' AND schoolid='{$schoolid}'");
    if(checksubmit('submit')){
        $data = array(
            'weid' => $weid,
            'schoolid' => $schoolid,
            'name' => $_GPC['name'],
            'tea_level' => $_GPC['tea_level'],
            'tea_level1' => $_GPC['tea_level1'],
            'tea_level2' => $_GPC['tea_level2'],
            'tea_level3' => $_GPC['tea_level3'],
            'stu_level1' => $_GPC['stu_level1'],
            'show_level' => $_GPC['show_level'],
            'promote_level' => $_GPC['promote_level'],
            'law' => $_GPC['law'],
            'deal' => $_GPC['deal'],
        );
        if(!empty($_GPC['id'])){
            pdo_update(GetTableName('yiheedu_set',false), $data, array('id' => $_GPC['id']));
        }else{
            pdo_insert(GetTableName('yiheedu_set',false), $data);
        }
        $this->imessage('操作成功!', referer(), 'success');
    }
}else if($operation == 'rule'){ //查询所有规则
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $list  = pdo_fetchall("SELECT * FROM " . GetTableName('yiheedu_rule') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' ORDER BY ssort DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);
    $total = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . GetTableName('yiheedu_rule') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}'");
    $pager = pagination($total, $pindex, $psize);
}else if($operation == 'get_rule'){ //查询单个规则
    $info = pdo_fetch("SELECT * FROM " . GetTableName('yiheedu_rule') . " WHERE id = '{$_GPC['id']}'");
    $result['data'] = $info;
    die(json_encode($result));
}else if($operation == 'save_rule'){ // 保存规则
    $data = array(
        'schoolid' => $schoolid,
        'weid' => $weid,
        'ssort' => $_GPC['rule_ssort'],
        'name' => $_GPC['rule_name'],
        'score' => $_GPC['rule_score'],
        'money' => $_GPC['rule_money'],
        'day_max' => $_GPC['rule_day_max'],
        'max' => $_GPC['rule_max'],
        'createtime' => time(),
    );
    if($_GPC['rule_id']){
        pdo_update(GetTableName('yiheedu_rule',false), $data, array('id' =>$_GPC['rule_id']));
        $result['result'] = true;
        $result['msg'] = '修改成功!';
    }else{
        pdo_insert(GetTableName('yiheedu_rule',false), $data);
        $result['result'] = true;
        $result['msg'] = '创建成功!';
    }
    die(json_encode($result));
}else if($operation == 'del_rule'){ //删除规则
    pdo_delete(GetTableName('yiheedu_rule',false),array('id'=>$_GPC['id']));
    $this->imessage('删除成功', referer(), 'success');	
}else if($operation == 'form_record'){
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 10;
    $condition = '';
    if (!empty($_GPC['type'])) {
        if($_GPC['type'] == 1){
		    $condition .= " AND f.sid = '0' ";
        }else{
            $condition .= " AND f.sid != '0' ";
        }
    }
    if (!empty($_GPC['name'])) {
		$condition .= " AND f.name LIKE '%{$_GPC['name']}%' ";
    }
    $status = isset($_GPC['status']) ? intval($_GPC['status']) : -1;
    if($status >= 0) {
		$condition .= " AND f.status = '{$status}'";
    }	
    if(!empty($_GPC['createtime']['start'])) {
		$starttime = strtotime($_GPC['createtime']['start']);
		$endtime = strtotime($_GPC['createtime']['end']) + 86399;
		$condition .= " AND f.createtime > '{$starttime}' AND f.createtime < '{$endtime}'";
	} else {
		$starttime = strtotime('-365 day');
		$endtime = TIMESTAMP;
    }

    if (!empty($_GPC['kc_id'])) {
        $condition .= " AND f.kc_id = '{$_GPC['kc_id']}' ";
    }

    $list  = pdo_fetchall("SELECT f.id,f.name,f.mobile,f.status,(CASE WHEN !kc.name then kc.name else '无' end) as kcname,(CASE WHEN !u.name then u.name else '无' end) as f_name,f.createtime,f.content,f.sid FROM " . GetTableName('yiheedu_form') . " as f LEFT JOIN ".GetTableName('yiheedu_promote_user')." as u ON u.id = f.pu_id LEFT JOIN ".GetTableName('tcourse')." as kc ON kc.id = f.kc_id WHERE f.weid = '{$weid}' And f.schoolid = '{$schoolid}' $condition ORDER BY f.id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);
    $kcList = pdo_fetchall("SELECT (CASE WHEN !kc.name then kc.name else '不限' end) as name,(CASE WHEN kc.id then kc.id else '0' end) as id FROM ".GetTableName('yiheedu_form')." as f LEFT JOIN ".GetTableName('tcourse')." as kc ON kc.id = f.kc_id WHERE f.schoolid = '{$schoolid}' GROUP BY f.kc_id ");
    $total = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . GetTableName('yiheedu_form') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}'");
    $pager = pagination($total, $pindex, $psize);
}else if($operation == 'changeForm'){ //申请批改
    $item = pdo_fetch("SELECT id,kc_id,openid,pu_id,mobile,name,sid FROM " . GetTableName('yiheedu_form') . " WHERE id = '{$_GPC['id']}'");
    if(!$item['sid']){
        if($_GPC['status'] == 1){ //同意后的操作
            //查看当前是否是老师
            $tid = pdo_fetch("SELECT id FROM " . GetTableName('teachers') . " WHERE schoolid = '{$schoolid}' AND openid = '{$item['openid']}' ")['id'];
            if(!$tid){ //不是老师就为老师添加一条记录
                $t_data = array(
                    'schoolid' => $schoolid,
                    'weid' => $weid,
                    'tname' => $item['name'],
                    'mobile' => $item['mobile'],
                    'openid' => $item['openid'],
                );
                pdo_insert(GetTableName('teachers',false),$t_data);
                $tid = pdo_insertid();
            }

            $uid = pdo_fetch("SELECT id FROM " . GetTableName('user') . " WHERE schoolid = '{$schoolid}' AND tid = '{$tid}' ");
            if(empty($uid)){
                $u_data = array(
                    'tid' => $tid,
                    'weid' =>  $weid,
                    'schoolid' => $schoolid,
                    'openid' => $item['openid'],
                    'createtime' => time()
                );
                pdo_insert(GetTableName('user',false),$u_data);
            }

            // 当前老师是否有唯一身份
            $pu_id = pdo_fetch("SELECT id FROM " . GetTableName('yiheedu_promote_user') . " WHERE schoolid = '{$schoolid}' AND tid = '{$tid}'")['id'];
            if(!$pu_id){ //不存在就添加一条记录(唯一身份)
                $p_data = array(
                    'schoolid' => $schoolid,
                    'weid' => $weid,
                    'name' => $item['name'],
                    'tid' => $tid,
                );
                pdo_insert(GetTableName('yiheedu_promote_user',false),$p_data);
                $pu_id = pdo_insertid();  
            }
            //当前课程当前老师的上级的上级id
            $ff_id = pdo_fetch("SELECT f_id FROM " . GetTableName('yiheedu_promote_relation') . " WHERE schoolid = '{$schoolid}' AND pu_id = '{$item['pu_id']}' AND kc_id = '{$item['kc_id']}'")['f_id'];
            // 当前老师当前课程是否已经有权推广
            $relation = pdo_fetch("SELECT id,f_id FROM " . GetTableName('yiheedu_promote_relation') . " WHERE schoolid = '{$schoolid}' AND pu_id = '{$pu_id}' AND kc_id = '{$item['kc_id']}'");
            if($relation){ //当前课程下,当前老师已经是推广员了
                if($relation['f_id'] == 0){ //当前课程下， 当前老师没有上级
                    pdo_update(GetTableName('yiheedu_promote_relation',false), array('f_id'=>$item['pu_id'],'ff_id'=>$ff_id), array('id' =>$relation['id']));
                }else{
                    $this->imessage('您当前操作的已经存在了上级!', referer(), 'error');  
                }
            }else{ //当前老师，当前课程，没有进行关系绑定
                $p_r_data = array(
                    'schoolid' => $schoolid,
                    'weid' => $weid,
                    'kc_id' => $item['kc_id'],
                    'f_id' => $item['pu_id'],
                    'ff_id' => $ff_id,
                    'pu_id' => $pu_id,
                    'createtime' => time(),
                );
                pdo_insert(GetTableName('yiheedu_promote_relation',false),$p_r_data);
            }
            //将除了当前提交的数据外全部提交修改为2拒绝
            $AllForm = pdo_fetchAll("SELECT id FROM " . GetTableName('yiheedu_form') . " WHERE kc_id = '{$item['kc_id']}' AND openid = '{$item['openid']}' AND sid = 0");
            foreach ($AllForm as $id) {
                pdo_update(GetTableName('yiheedu_form',false), array('status'=>2), array('id' =>$id));
            }
        }
    }else{
        if($_GPC['status'] == 1){
            pdo_update(GetTableName('students',false), array('promote_status'=>$_GPC['status']), array('id' =>$item['sid']));
            $hasuser = pdo_fetch("SELECT id FROM " . GetTableName('yiheedu_promote_user') . " WHERE schoolid = '{$schoolid}' AND sid = '{$item['sid']}'");
            if(!$hasuser){
                $p_data = array(
                    'schoolid' => $schoolid,
                    'weid' => $weid,
                    'name' => $item['name'],
                    'sid' => $item['sid'],
                );
                pdo_insert(GetTableName('yiheedu_promote_user',false),$p_data);
            }
        }
    }
    
    pdo_update(GetTableName('yiheedu_form',false), array('status'=>$_GPC['status']), array('id' =>$_GPC['id']));
    $this->imessage('操作成功', referer(), 'success');  
}else if($operation == 'del_form'){ //删除申请
    pdo_delete(GetTableName('yiheedu_form',false),array('id'=>$_GPC['id']));
    $this->imessage('删除成功', referer(), 'success');  
}else if($operation == 'show_attribute'){
    if($_GPC['type'] == 1){
        $condition = "  AND l.tid = '{$_GPC['id']}' ";
        $condition2 = "  AND a.type = 1 ";
        $name = pdo_fetch("SELECT s_name FROM ".GetTableName('students')." WHERE id ='{$_GPC['id']}'")['s_name'];
    }else{
        $condition = "  AND l.sid = '{$_GPC['id']}' ";
        $condition2 = "  AND a.type = 2 ";
        $name = pdo_fetch("SELECT tname FROM ".GetTableName('teachers')." WHERE id ='{$_GPC['id']}'")['tname'];
    }
    $attributeList = pdo_fetchall("SELECT a.id,a.name,a.category,l.content,l.category as childCategory,l.is_lock FROM " . GetTableName('attribute') ." as a LEFT JOIN " . GetTableName('attributelog') . " as l ON a.id = l.attr_id $condition WHERE a.weid = '{$weid}' AND a.schoolid = '{$schoolid}' $condition2 ORDER BY a.ssort DESC ");
	foreach ($attributeList as $key => $value) {
		if($value['category'] == 'date'){
			$attributeList[$key]['content'] = $value['content'] > 1 ? $value['content'] : 1 ;
		}
    }
    include $this->template('public/comattribute');
	die();
}

include $this->template('web/promotefans');
?>