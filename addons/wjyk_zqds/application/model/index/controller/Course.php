<?php

namespace app\index\controller;

use think\Controller;

class Course extends Controller
{
    
    /**
     * 热门搜索
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=hot
     */
    public function hot(){
        global $_W,$_GPC;
        
        $system = pdo_get('wjyk_zqds_system',array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(!empty($system['hot'])){
            $hot = explode(",", $system['hot']);
        }else{
            $hot = [];
        }
    
        return result(0, 'success', $hot);
    }
    
    /**
     * 课程分类列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=cate_list
     */
    public function cate_list(){
        global $_W,$_GPC;
        $cateList= pdo_getall('wjyk_zqds_category',array(
            'uniacid' => $_W['uniacid'],
            'is_display' => 1
        ),array(),'','sort desc');
        
        return result(0, 'success', $cateList);
    }
    
    /**
     * 课程搜索
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=course_search
     * @param
     *         name  课程名称
     */
    public function course_search(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $name = input('name');
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];

        if(!empty($name)){
            $condition .= " AND  name LIKE '%{$name}%' ";
        }
        
        $teacherList = array();
        
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_course') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_course')  ."  WHERE ".$condition;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
    
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $v['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$k]['teacherName'] = $teacher['name'];
                $list[$k]['teacherAvatar'] = $teacher['avatar'];
                
                $fans = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_focus"). " WHERE teacherid = :teacherid AND uniacid = :uniacid ",array(
                    'uniacid' => $_W['uniacid'],
                    'teacherid' => $teacher['id'],
                ));
                
                $teacher['fans'] = $fans;
                
                
                $course = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_course"). " WHERE teacherid = :teacherid AND uniacid = :uniacid ",array(
                    'uniacid' => $_W['uniacid'],
                    'teacherid' => $teacher['id'],
                ));
                
                $teacher['course'] = $course;
                
                $focus = pdo_get('wjyk_zqds_focus',array(
                    'uniacid' => $_W['uniacid'],
                    'uid' => $uid,
                    'teacherid' => $teacher['id']
                ));
                
                if(!empty($focus)){
                    $teacher['focus'] = 1;
                }else{
                    $teacher['focus'] = 0;
                }
                
                array_push($teacherList, $teacher);
    
                $chapter = pdo_getall('wjyk_zqds_chapter',array(
                    'courseid' => $v['id'],
                    'uniacid' => $_W['uniacid']
                ));
    
                if(empty($chapter)){
                    $list[$k]['count'] = 0;
                }else{
                    $list[$k]['count'] = count($chapter);
                }
    
            }
            
            $teacherList = $this->a_array_unique($teacherList);
            
            $count = count($teacherList);
            
            if(!empty($teacherList)){
                $teacherList = $teacherList[0];
            }
        }else{
            $list = array();
            $count = 0;
        }
    
        
        return result(0, 'success', array(
            'list' => $list,
            'count' => $count,
            'teacherList' => $teacherList
        ));
    
    
    }
    
    public function a_array_unique($array){
        $out = array();
    
        foreach ($array as $key=>$value) {
            if (!in_array($value, $out)){
                $out[$key] = $value;
            }
        }
    
        $out = array_values($out);
        return $out;
    }
    
    /**
     * 课程搜索查看更多
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=course_search_all
     * @param
     *         name  课程名称
     */
    public function course_search_all(){
        global $_W,$_GPC;
    
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $name = input('name');
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
    
        if(!empty($name)){
            $condition .= " AND  name LIKE '%{$name}%' ";
        }
    
        $teacherList = array();
    
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_course') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_course')  ."  WHERE ".$condition;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
    
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $v['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                
                $fans = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_focus"). " WHERE teacherid = :teacherid AND uniacid = :uniacid ",array(
                    'uniacid' => $_W['uniacid'],
                    'teacherid' => $teacher['id'],
                ));
                
                $teacher['fans'] = $fans;
                
                
                $course = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_course"). " WHERE teacherid = :teacherid AND uniacid = :uniacid ",array(
                    'uniacid' => $_W['uniacid'],
                    'teacherid' => $teacher['id'],
                ));
                
                $teacher['course'] = $course;
    
    
                $focus = pdo_get('wjyk_zqds_focus',array(
                    'uniacid' => $_W['uniacid'],
                    'uid' => $uid,
                    'teacherid' => $teacher['id']
                ));
    
                if(!empty($focus)){
                    $teacher['focus'] = 1;
                }else{
                    $teacher['focus'] = 0;
                }
    
                array_push($teacherList, $teacher);
    
            }
    
            $teacherList = $this->a_array_unique($teacherList);
            
            
    
        }else{
            $list = array();
        }
    
        return result(0, 'success', $teacherList);
    }
    
    /**
     * 课程列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=course_list
     * @param
     *         teacherid  讲师id 
     * @param
     *         categoryid  分类id  
     * @param
     *         name  课程名称              
     * @param
     *         page  页码
     * @param
     *         psize  每页条数                                      
     */
    public function course_list(){
        global $_W,$_GPC;
        
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
        
        $cateList= pdo_getall('wjyk_zqds_category',array(
            'uniacid' => $_W['uniacid'],
            'is_display' => 1
        ),array(),'','sort desc');
        
        $categoryid = input('categoryid');
        $name = input('name');
        $is_recommend = input('is_recommend');
        $is_vip = input('is_vip');
        
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
        
        if(!empty($categoryid)){
            $condition .= " AND categoryid = :categoryid";
            $params[':categoryid'] = $categoryid;
        }
        
        if(!empty(input('teacherid'))){
            $condition .= " AND teacherid = :teacherid";
            $params[':teacherid'] = input('teacherid');
        }
        
        if(!empty($name)){
            $condition .= " AND  name LIKE '%{$name}%' ";
        }
        
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_course') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
        
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_course')  ."  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
                
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $v['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$k]['teacherName'] = $teacher['name'];
                $list[$k]['teacherAvatar'] = $teacher['avatar'];
            
                $chapter = pdo_getall('wjyk_zqds_chapter',array(
                    'courseid' => $v['id'],
                    'uniacid' => $_W['uniacid']
                ));
                
                if(empty($chapter)){
                    $list[$k]['count'] = 0;
                }else{
                    $list[$k]['count'] = count($chapter);
                }
            
            }
        }else{
            $list = array();
        }
        
        
        $totalPage = ceil($total / $psize);
        
        return result(0, 'success', array(
            'list' => $list,
            'total' => $total,
            'pindex' => $pindex,
            'psize' => $psize,
            'totalPage' => $totalPage
        ));
        
    
    }
    
    /**
     * 课程目录列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=chatper_list
     * @param
     *         courseid  课程id
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function chatper_list(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
    
        $courseid = input('courseid');
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
    
        if(!empty($courseid)){
            $condition .= " AND courseid = :courseid";
            $params[':courseid'] = $courseid;
        }

    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_chapter') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_chapter')  ."  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
    
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $v['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$k]['teacherName'] = $teacher['name'];
                $list[$k]['teacherAvatar'] = $teacher['avatar'];
                
                
                $process = pdo_get('wjyk_zqds_process',array(
                    'id' => $v['id'],
                    'uid' => $uid,
                    'uniacid' => $_W['uniacid']
                ));
                
                if(!empty($process)){
                    $list[$k]['process'] = 1;
                }else{
                    $list[$k]['process'] = 0;
                }
    
            }
        }else{
            $list = array();
        }
    
        
        $totalPage = ceil($total / $psize);
    
        return result(0, 'success', array(
            'list' => $list,
            'total' => $total,
            'pindex' => $pindex,
            'psize' => $psize,
            'totalPage' => $totalPage
        ));
    
    
    }
    
    /**
     * 添加/编辑课程
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=edit_course
     * @param
     *            id  课程id 编辑时传
     * @param
     *            categoryid  分类id
     * @param
     *            teacherid  讲师id
     * @param
     *            name    课程名称
     * @param
     *            subhead    副标题
     * @param
     *            cover    封面
     * @param
     *            detail   课程介绍
     * @param
     *            pic_url   详情图
     * @param
     *            is_charge   是否收费（1-是，2-否）
     * @param
     *            charge   费用
     * @param
     *            is_vip   是否vip免费观看（1-是，2-否）
     */
    public function edit_course(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $data = array(
            'uniacid' => $_W['uniacid'],
            'categoryid' => $_GPC['categoryid'],
            'teacherid' => $_GPC['teacherid'],
            'name' => $_GPC['name'],
            'subhead' => $_GPC['subhead'],
            'cover' => $_GPC['cover'],
            'detail' => $_GPC['detail'],
            'pic_url' => $_GPC['pic_url'],
            'is_charge' => $_GPC['is_charge'],
            'charge' => $_GPC['charge'],
            'is_vip' => $_GPC['is_vip'],
        );
    
        if(!empty(input('id'))){
            pdo_update('wjyk_zqds_course',$data,array(
                'uniacid' => $_W['uniacid'],
                'id' => input('id')
            ));
            return result(0,'操作成功');
        }else{
            $data['createtime'] = time();
            
            $result = pdo_insert('wjyk_zqds_course',$data);

            if($result){
                return result(0,'添加成功');
            }else{
                return result(-1,'添加失败',$data);
            }
        }
    
    }
    
    /**
     * 删除课程
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=del_course
     * @param
     *            id  课程id
     */
    public function del_course(){
        global $_W,$_GPC;
    
        $result = pdo_delete('wjyk_zqds_course',array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['id']
        ));

        if($result){
            
            pdo_delete('wjyk_zqds_view_history',array(
                'uniacid' => $_W['uniacid'],
                'courseid' => $_GPC['id']
            ));
            
            pdo_delete('wjyk_zqds_collect',array(
                'uniacid' => $_W['uniacid'],
                'courseid' => $_GPC['id']
            ));
            
            return result(0,'删除成功');
        }else{
            return result(-1,'删除失败',$_GPC['id']);
        }
    
    }
    
    /**
     * 添加累计学习时长
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=add_viewtime
     * @param
     *            time  时长 (秒)
     */
    public function add_viewtime(){
        global $_W,$_GPC;
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $time = $_GPC['time'];

        pdo_update('wjyk_zqds_user',array(
            'viewtime +=' => round($time/60)
        ),array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        return result(0,'操作成功');
        
    }
    
    /**
     * 添加学习视频/音频
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=add_study
     * @param
     *            type  1-音频   2-视频
     */
    public function add_study(){
        global $_W,$_GPC;
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $type = $_GPC['type'];
        
        if($type == 1){
            pdo_update('wjyk_zqds_user',array(
                'audio_study +=' => 1
            ),array(
                'uniacid' => $_W['uniacid'],
                'uid' => $uid
            ));
        }else{
            pdo_update('wjyk_zqds_user',array(
                'video_study +=' => 1
            ),array(
                'uniacid' => $_W['uniacid'],
                'uid' => $uid
            ));
        }
    
        
    
        return result(0,'操作成功');
    
    }
    
    
    /**
     * 添加/编辑章节
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=edit_chapter
     * @param
     *            id  章节id 编辑时传
     * @param
     *            courseid  课程id
     * @param
     *            teacherid  讲师id
     * @param
     *            name    章节名称
     * @param
     *            cover    封面
     * @param
     *            is_charge   是否收费（1-是，2-否）
     * @param
     *            charge   费用
     */
    public function edit_chapter(){
        global $_W,$_GPC;
    
        $data = array(
            'uniacid' => $_W['uniacid'],
            'courseid' => $_GPC['courseid'],
            'teacherid' => $_GPC['teacherid'],
            'name' => $_GPC['name'],
            'cover' => $_GPC['cover'],
            'is_charge' => $_GPC['is_charge'],
            'charge' => $_GPC['charge'],
        );
    
        if(!empty(input('id'))){
            pdo_update('wjyk_zqds_chapter',$data,array(
                'uniacid' => $_W['uniacid'],
                'id' => input('id')
            ));
            return result(0,'操作成功');
        }else{
            $result = pdo_insert('wjyk_zqds_chapter',$data);
    
            if($result){
                return result(0,'添加成功');
            }else{
                return result(-1,'添加失败',$data);
            }
        }
    
    }
    
    /**
     * 章节详情
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=chapter_detail
     * @param
     *            id  章节id
     */
    public function chapter_detail(){
        global $_W,$_GPC;
    
        $chapter = pdo_get('wjyk_zqds_chapter',array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['id']
        ));
    
        return result(0,'success',$chapter);
    
    }
    
    /**
     * 删除章节
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=del_chapter
     * @param
     *            id  章节id
     */
    public function del_chapter(){
        global $_W,$_GPC;
    
        $result = pdo_delete('wjyk_zqds_chapter',array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['id']
        ));
    
        if($result){
            return result(0,'删除成功');
        }else{
            return result(-1,'删除失败',$_GPC['id']);
        }
    
    }
    
    /**
     * 完成章节
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=finish_chapter
     * @param
     *            id  章节id
     */
    public function finish_chapter(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $data = [
            'uid' =>$uid,
            'uniacid' => $_W['uniacid'],
            'chapterid' => $_GPC['id'],
            'createtime' => time()
        ];
    
        $result = pdo_insert('wjyk_zqds_process',$data);
    
        if($result){
            return result(0,'完成成功');
        }else{
            return result(-1,'完成失败');
        }
    
    }

    /**
     * 课程详情
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=course_detail
     * @param
     *            id  课程id 
     */
    public function course_detail(){
        global $_W;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $id = input('id');
        
        $course= pdo_get("wjyk_zqds_course",array(
            'uniacid' => $_W['uniacid'],
            'id' => $id
        ));
        
        $user= pdo_get("wjyk_zqds_user",array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        $course['user_vip'] = $user['is_member'];
        
        
        
        $collect = pdo_get('wjyk_zqds_collect',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'courseid' => $id
        ));
        
        if(!empty($collect)){
            $course['collect'] = 1;
        }else{
            $course['collect'] = 0;
        }
        
        
        $teacher = pdo_get('wjyk_zqds_teacher',array(
            'id' => $course['teacherid'],
            'uniacid' => $_W['uniacid']
        ));
        $course['teacherName'] = $teacher['name'];
        $course['teacherAvatar'] = $teacher['avatar'];
        $course['teacherIntro'] = $teacher['introduction'];
        
        $focus = pdo_get('wjyk_zqds_focus',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'teacherid' => $teacher['id']
        ));
        
        if(!empty($focus)){
            $course['focus'] = 1;
        }else{
            $course['focus'] = 0;
        }
        
        
        $history = pdo_get("wjyk_zqds_view_history",array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'courseid' => $id,
        ));
        
        
        $data = array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'courseid' => $id,
            'createtime' => time()
        );
        
        if(!empty($history)){
            pdo_update('wjyk_zqds_view_history',$data,array(
                'uniacid' => $_W['uniacid'],
                'id' => $history['id']
            ));
        }else{
            pdo_insert("wjyk_zqds_view_history",$data);
        }   
        
        $order = pdo_get('wjyk_zqds_order',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'courseid' => $id
        ));
        
        if(!empty($order)){
            $course['order'] = 1;
        }else{
            $course['order'] = 0;
        }
        
        $course['pic_url'] = explode(',',$course['pic_url']);
        
   
        return result(0, 'success', $course);
    }
    
    
    /**
     * 购买全部课程
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=settlement
     * @param
     *            id  课程id
     */
    public function settlement(){
        global $_W;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $result = array();
        
        $course = pdo_get('wjyk_zqds_course',array(
            'uniacid' => $_W['uniacid'],
            'id' => input('id')
        ));
        
        $user = pdo_get('wjyk_zqds_user',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        $result['amount_payable'] = $course['charge'];
        $result['balance'] = $user['integral'];
        
        
        $set = pdo_get('wjyk_zqds_integral',array(
            'uniacid' => $_W['uniacid']
        ));
        
        if($user['integral'] > $course['integral']){
            
            $result['integral'] = $course['integral'];
            if(!empty($set['exchange'])){
                $result['deduction'] = round($course['integral'] / $set['exchange'],2);
            }else{
                $result['deduction'] = 0;
            }
        }else{
            
            if($user['integral']> 0){
                $result['integral'] = $user['integral'];
                
                if(!empty($set['exchange'])){
                    $result['deduction'] = round($user['integral'] / $set['exchange'],2);
                }else{
                    $result['deduction'] = 0;
                }
            }else{
                $result['integral'] = 0;
                $result['deduction'] = 0;
            }
            
            
        }
        $result['total'] = round($result['amount_payable']-$result['deduction'],2);
        
        return result(0,'success',$result);
    }
    
    
    /**
     * 确认购买
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=sureBuy
     * @param
     *            courseid  课程id
     * @param
     *            teacherid  讲师id 
     * @param
     *            payment_type  付款方式 1-余额支付，2-微信支付           
     * @param
     *            amount_payable  应付金额 （总价）             
     * @param
     *            total  实付
     * @param
     *            integral  积分数量
     * @param
     *            deduction  抵扣金额                                         
     */
    public function sureBuy(){
        global $_W;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $user = pdo_get('wjyk_zqds_user',array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
        ));
        
        if($user['integral'] > input('integral') ){
            return result(-1,'积分不足');
        }
        
        $orderno = getPayNo('OD');
        
        $data = array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'courseid' => input('courseid'),
            'teacherid' => input('teacherid'),
            'logno' => $orderno,
            'payment_type' => input('payment_type'),
            'amount_payable' => input('amount_payable'),
            'total' => input('total'),
            'integral' => input('integral'),
            'deduction' => input('deduction'),
            'createtime' => time()
        );
        
        $result = pdo_insert("wjyk_zqds_order",$data);
        if($result){
            
            if(input('integral') > 0){
                $data = array(
                    'uid' => $uid,
                    'uniacid' => $_W['uniacid'],
                    'type' => 2,
                    'integral' => input('integral'),
                    'createtime' => time()
                );
                
                pdo_insert("wjyk_zqds_integral_log",$data);
                
                pdo_update('wjyk_zqds_user',array(
                    'integral -='=> input('integral')
                ),array(
                    'uid' => $uid,
                    'uniacid' => $_W['uniacid'],
                ));
            }
            
            
            $system = pdo_get('wjyk_zqds_system', array(
                'uniacid' => $_W['uniacid']
            ));
            
            $user = pdo_get('wjyk_zqds_user', array(
                'uniacid' => $_W['uniacid'],
                'uid' => $uid
            ));
            
            $course = pdo_get('wjyk_zqds_course', array(
                'uniacid' => $_W['uniacid'],
                'id' => input('courseid'),
            ));
            
            
            pdo_update('wjyk_zqds_course',array(
                'sold +=' => 1,
            ), array(
                'uniacid' => $_W['uniacid'],
                'id' => input('courseid'),
            ));
            
            
            if (!empty($system['buyTemplate'])) {
            
                $data = array(
                    'first' => array(
                        'value' => "您好，您已购买成功！",
                        'color' => '#ff510'
                    ),
                    'keyword1' => array(
                        'value' => $orderno,
                        'color' => '#ff510'
                    ),
                    'keyword2' => array(
                        'value' => $course['name'],
                        'color' => '#ff510'
                    ),
                    'keyword3' => array(
                        'value' => input('total')."元",
                        'color' => '#ff510'
                    ),
                    'keyword4' => array(
                        'value' => date('Y-m-d H:i',time()),
                        'color' => '#ff510'
                    ),
                    'remark' => array(
                        'value' => $system['buyRemark'],
                        'color' => '#ff510'
                    )
                );
                $account_api = \WeAccount::create();
                $url = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=index&m=wjyk_zqds&wxref=mp.weixin.qq.com#/pages/user/my-courses/my-courses";
                $account_api->sendTplNotice($user['openid'], $system['buyTemplate'], $data,$url);
            }
            
            if(empty($system['earnings']) || $system['earnings'] == 1){
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => input('teacherid'),
                    'uniacid' => $_W['uniacid'],
                ));
                
                $res = pdo_update('wjyk_zqds_user',array(
                    'balance +='=> input('amount_payable')
                ),array(
                    'uid' => $teacher['uid'],
                    'uniacid' => $_W['uniacid'],
                ));
                
                if($res){
                
                    $course = pdo_get('wjyk_zqds_course',array(
                        'id' => input('courseid'),
                        'uniacid' => $_W['uniacid'],
                    ));
                
                    $log = [
                        'uid' => $teacher['uid'],
                        'uniacid' => $_W['uniacid'],
                        'money' => input('amount_payable'),
                        'type' => 1,
                        'text' => $course['name'],
                        'createtime' => time()
                    ];
                    pdo_insert('wjyk_zqds_payment_log',$log);
                }
            }
            
            
            
            
            $total = input('amount_payable');
            
            
            //分销
            $setting = pdo_get("wjyk_zqds_brokerage_set",array(
                'uniacid'=>$_W['uniacid']
            ));
            
            if($setting['is_open'] == 1){//分销开启
            
            
            
                switch ($setting['is_level']){
                    case 1;
                    $commission[0]= $total*$setting['oneLevel'];
                    break;
                    case 2;
                    $commission[0]=$total*$setting['oneLevel'];
                    $commission[1]=$total*$setting['twoLevel'];
                    break;
                    case 3;
                    $commission[0] = $total*$setting['oneLevel'];
                    $commission[1]=$total*$setting['twoLevel'];
                    $commission[2]=$total*$setting['threeLevel'];
                    break;
                    default;
                    $commission=array();
                    break;
                }
            
            
            
                $pid[0]=pdo_getcolumn("wjyk_zqds_user",array('uid'=>$uid),'pid',1);
                if(!empty($pid[0])){
                    $pid[1]=pdo_getcolumn("wjyk_zqds_user",array('uid'=>$pid[0]),'pid',1);
                }
                if(!empty($pid[1])){
                    $pid_three=pdo_getcolumn("wjyk_zqds_user",array('uid'=>$pid[1]),'pid',1);
                    if(!empty($pid_three)){
                        $pid[2]=$pid_three;
                    }
                }
            
            
            
                $t=time();
                $sql=" INSERT INTO ".tablename('wjyk_zqds_brokerage_log')." (uid,uniacid,pid,total,money,createtime) VALUES ";
                foreach ($commission as $k => $v){
            
                    if($v<0.01 || empty($pid[$k])){
                        continue;
                    }
                    pdo_update("wjyk_zqds_user",array('brokerage_wait +='=>$v),array('id'=>$pid[$k]));
                    $sql.="(".$uid.",".$_W['uniacid'].",".$pid[$k].",".$total.",".$v.",".$t."),";
                }
                $sql=substr($sql,0,-1);
                $sql.=";";
                $res=pdo_query($sql);
            }
            
            
            
            
            return result(0,'购买成功');
        }else{
            return result(-1,'购买失败');
        }
    }
    
    
    /**
     * 增加播放量
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=add_view
     * @param
     *            type  1-课程   2-章节 
     * @param
     *            id  课程id/章节id
     */
    public function add_view(){
        global $_W;
        
        $type = input('type');
        if($type == 1){
            $result = pdo_update('wjyk_zqds_course',array(
                'view +='=> 1,
            ),array(
                'uniacid' => $_W['uniacid'],
                'id' => input('id')
            ));
        }else if($type == 2){
            $result = pdo_update('wjyk_zqds_chapter',array(
                'view +='=> 1,
            ),array(
                'uniacid' => $_W['uniacid'],
                'id' => input('id')
            ));
        }
        
        if($result){
            return result(0,'操作成功');
        }else{
            return result(-1,'操作失败');
        }
    }
    
    
    /**
     * 收藏
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=collect
     * @param
     *            id  课程id  
     */
    public function collect(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $id = input('id');
        
        $flag = pdo_get('wjyk_zqds_collect',array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'courseid' => $id,
        ));
        
        if(!empty($flag)){
            return result(-1,'已收藏！');
        }else{
        

            $data = array(
                'uid' => $uid,
                'uniacid' => $_W['uniacid'],
                'courseid' => $id,
                'createtime' => time()
            );
    
            $result = pdo_insert("wjyk_zqds_collect",$data);
            if($result){
                return result(0,'收藏成功');
            }else{
                return result(-1,'收藏失败');
            }
        }
    
    }
    
    /**
     * 取消收藏
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=uncollect
     * @param
     *            id  课程id
     */
    public function uncollect(){
        global $_W,$_GPC;
    
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $id = input('id');
    
        $result = pdo_delete('wjyk_zqds_collect',array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'courseid' => $id,
        ));
    
        if($result){
            return result(0,'取消成功');
        }else{
            return result(-1,'取消失败');
        }
    
    }
    
    /**
     * 评价列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=evaluate_list
     * @param
     *         courseid  课程id
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function evaluate_list(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $courseid = input('courseid');
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
    
        if(!empty($courseid)){
            $condition .= " AND courseid = :courseid";
            $params[':courseid'] = $courseid;
        }
    
        $flag = 0;
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_evaluate') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_evaluate')  ."  WHERE ".$condition;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
                if($v['uid'] == $uid){
                    $flag = 1;
                }
    
                $user = pdo_get('wjyk_zqds_user',array(
                    'uid' => $v['uid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$k]['nickname'] = $user['nickname'];
                $list[$k]['avatar'] = $user['avatar'];
                $list[$k]['is_member'] = $user['is_member'];

                //获取今天凌晨的时间戳
                $day = strtotime(date('Y-m-d',time()));
                //获取昨天凌晨的时间戳
                $pday = strtotime(date('Y-m-d',strtotime('-1 day')));
                //获取现在的时间戳
                $nowtime = time();
                $t = $nowtime - $v['createtime'];
                if($v['createtime'] < $pday){
                    $str = date('Y-m-d',$v['createtime']);
                }elseif($v['createtime']<$day && $v['createtime']>$pday){
                    $str = "昨天";
                }elseif($t>60*60){
                    $str = floor($t/(60*60))."小时前";
                }elseif($t>60){
                    $str = floor($t/60)."分钟前";
                }else{
                    $str = "刚刚";
                }
                
                $list[$k]['createtime'] = $str;                
    
            }
        }else{
            $list = array();
        }
    
        return result(0, 'success', $list);
    
    
    }
    
    /**
     * 评论
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=course&tp_a=evaluate
     * @param
     *            id  课程id
     * @param
     *            content  内容            
     */
    public function evaluate(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $id = input('id');
        
        $flag = pdo_get('wjyk_zqds_evaluate',array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'courseid' => $id,
        ));
        
        if(!empty($flag)){
            return result(-1,'已评价！');
        }else{
            $data = array(
                'uid' => $uid,
                'uniacid' => $_W['uniacid'],
                'courseid' => $id,
                'content' => input('content'),
                'createtime' => time()
            );
            
            $result = pdo_insert("wjyk_zqds_evaluate",$data);
            if($result){
                return result(0,'评价成功');
            }else{
                return result(-1,'评价失败');
            }
        }
    }
    

}

