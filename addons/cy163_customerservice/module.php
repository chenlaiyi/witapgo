<?php
/**
 * 万能客服模块定义
 *
 * @author 梅小西
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
define('ROOT_PATH', IA_ROOT.'/addons/cy163_customerservice/');

class Cy163_customerserviceModule extends WeModule {

	public function settingsDisplay($settings) {
        global $_GPC, $_W;
        if (checksubmit()) {
			$cfg = array(
				'notaddkf'=>intval($_GPC['notaddkf']),
				'title'=>trim($_GPC['title']),
				
				'admins'=>trim($_GPC['admins']),
				
				'tpldomain'=>trim($_GPC['tpldomain']),
				
				'voiceon'=>intval($_GPC['voiceon']),
				'searchkf'=>intval($_GPC['searchkf']),
				
				'canshare'=>intval($_GPC['canshare']),
				
				'istplon'=>intval($_GPC['istplon']),
				'tplonlineon'=>intval($_GPC['tplonlineon']),
				'unfollowtext'=>trim($_GPC['unfollowtext']),
				'followqrcode'=>trim($_GPC['followqrcode']),
				'sharetitle'=>trim($_GPC['sharetitle']),
				'sharedes'=>trim($_GPC['sharedes']),
				'tpl_kefu'=>trim($_GPC['tpl_kefu']),
				'sharethumb'=>trim($_GPC['sharethumb']),
				'kefutplminute'=>intval($_GPC['kefutplminute']),
				'bgcolor'=>trim($_GPC['bgcolor']),
				'defaultavatar'=>trim($_GPC['defaultavatar']),
				'issharemsg'=>intval($_GPC['issharemsg']),
				'isshowwgz'=>intval($_GPC['isshowwgz']),
				'sharetype'=>intval($_GPC['sharetype']),
				'mingan'=>trim($_GPC['mingan']),
				'temcolor'=>trim($_GPC['temcolor']),
				'textcolor'=>trim($_GPC['textcolor']),
				'copyright'=>trim($_GPC['copyright']),
				'isgrouptplon'=>intval($_GPC['isgrouptplon']),
				'grouptplminute'=>intval($_GPC['grouptplminute']),
				'isgroupon'=>intval($_GPC['isgroupon']),
			 	'groupshow'=>intval($_GPC['groupshow']),
				'footertext1'=>trim($_GPC['footertext1']),
				'footertext2'=>trim($_GPC['footertext2']),
				'qiniuaccesskey'=>trim($_GPC['qiniuaccesskey']),
				'qiniusecretkey'=>trim($_GPC['qiniusecretkey']),
				'qiniubucket'=>trim($_GPC['qiniubucket']),
				'qiniuurl'=>trim($_GPC['qiniuurl']),
				'liedui'=>trim($_GPC['liedui']),
				'isqiniu'=>intval($_GPC['isqiniu']),
				'ishowgroupnum'=>intval($_GPC['ishowgroupnum']),
				'zjtype'=>intval($_GPC['zjtype']),
				'chosekefutem'=>intval($_GPC['chosekefutem']),
				'wechatview'=>intval($_GPC['wechatview']),
				'voicekefu'=>intval($_GPC['voicekefu']),
				'voicekehu'=>intval($_GPC['voicekehu']),
				//'tulingkey'=>trim($_GPC['tulingkey']),
				//'istulingon'=>intval($_GPC['istulingon']),
				'suiji'=>intval($_GPC['suiji']),
				'bdmodel'=>intval($_GPC['bdmodel']),
				
				'footer4on'=>intval($_GPC['footer4on']),
				'footertext3'=>trim($_GPC['footertext3']),
				'footer4thumb'=>trim($_GPC['footer4thumb']),
				'footer4url'=>trim($_GPC['footer4url']),
				
				'footer5on'=>intval($_GPC['footer5on']),
				'footertext4'=>trim($_GPC['footertext4']),
				'footer5thumb'=>trim($_GPC['footer5thumb']),
				'footer5url'=>trim($_GPC['footer5url']),
				
				'footer6on'=>intval($_GPC['footer6on']),
				'footertext5'=>trim($_GPC['footertext5']),
				'footer6thumb'=>trim($_GPC['footer6thumb']),
				'footer6url'=>trim($_GPC['footer6url']),
				
				'footer1thumb'=>trim($_GPC['footer1thumb']),
				'footer2thumb'=>trim($_GPC['footer2thumb']),
				
				'mapkey'=>trim($_GPC['mapkey']),
			);
			
			
			
			//$results = print_r($cfg, true); 
			//$path = ROOT_PATH.'messi22.txt';
			//file_put_contents($path,$results);
			
            if ($this->saveSettings($cfg)) {
                message('保存成功', 'refresh');
            }
        }
        load()->func('tpl');
		include $this->template('setting');
    }
	
}