<?php
/*
 *      [Dzz!] (C)2010-2012 dzz.cc
 *      This is NOT a freeware, use is subject to license terms
 *		
 *		Design by angelrain $
 *
 * ============================================================================
 * 版权所有 2010-2012 大桌子，并保留所有权利。
 * 网站地址: http://dzz.cc；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式、任何目的的再发布。
 * ============================================================================
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
$lang=& dzzlang('dim/message');
require_once dzz_libfile('function/friend');
if(!$_G['uid']){
	showmessage(dzzlang('message','no_privilege'),DZZSCRIPT,'',array('showdialog'=>1, 'showmsg' => true, 'closetime' => 3));
}
$uid =isset($_GET['uid'])?intval($_GET['uid']):$_G['uid'];
$space = dzzgetspace($uid);
$perpage = 30;

$maxpage=0;
$page = empty($_GET['page'])?0:intval($_GET['page']);
if($page<1) $page = 1;
$start = ($page-1)*$perpage;



$list = array();
$mynotice = $count = 0;
$multi = '';

$do = (!empty($_GET['do']) && in_array($_GET['do'], array('userapp','privacy')))?$_GET['do']:'notice';


if($do == 'userapp') {

	space_merge($space, 'status');

	if($_GET['action'] == 'del') {
		$appid = intval($_GET['appid']);
		C::t('common_myinvite')->delete_by_appid_touid($appid, $_G['uid']);
		//showmessage('do_success', DZZSCRIPT,array());
	}

	$filtrate = 0;
	$count = 0;
	$apparr = array();
	$type = intval($_GET['type']);
	foreach(C::t('common_myinvite')->fetch_all_by_touid($_G['uid']) as $value) {
		$count++;
		$key = md5($value['typename'].$value['type']);
		$apparr[$key][] = $value;
		if($filtrate) {
			$filtrate--;
		} else {
			if($count < $perpage) {
				if($type && $value['appid'] == $type) {
					$list[$key][] = $value;
				} elseif(!$type) {
					$list[$key][] = $value;
				}
			}
		}
	}
	$mynotice = $count;
} elseif($do=='privacy'){
	if(submitcheck('privacy2submit')) {
		$space['privacy']['filter_note'] = array();
		if(isset($_POST['privacy']['filter_note'])) {
			foreach ($_POST['privacy']['filter_note'] as $key => $value) {
				$space['privacy']['filter_note'][$key] = 1;
			}
		}
		require_once libfile('function/spacecp');
		privacy_update();
	
		require_once libfile('function/friend');
		friend_cache($_G['uid']);
	}
	space_merge($space, 'field_home');
	$operation = in_array($_GET['op'], array('base', 'feed', 'filter', 'getgroup')) ? trim($_GET['op']) : 'base';
	$filter_note = empty($space['privacy']['filter_note'])?array():$space['privacy']['filter_note'];
	$iconnames = $appids = $icons = $uids = $users = array();
	
	foreach ($filter_note as $key => $value) {
		list($type, $uid) = explode('|', $key);
		$types[$key] = $type;
		$uids[$key] = $uid;
		if(is_numeric($type)) {
			$appids[$key] = $type;
		}
	}
	if($uids) {
		foreach(C::t('user')->fetch_all($uids) as $uid => $value) {
			$users[$uid] = $value['username'];
		}
	}
	if($appids) {
		foreach(C::t('common_myapp')->fetch_all($appids) as $value) {
			$iconnames[$value['appid']] = $value['appname'];
		}
	}
} else{

	if(!empty($_GET['ignore'])) {
		C::t('user_notification')->ignore($_G['uid']);
	}

	foreach (array('wall', 'piccomment', 'blogcomment', 'clickblog', 'clickpic', 'sharecomment', 'doing', 'friend', 'credit', 'bbs', 'system', 'thread', 'task', 'group') as $key) {
		$noticetypes[$key] = lang('notification', "type_$key");
	}

	$isread = in_array($_GET['isread'], array(0, 1)) ? intval($_GET['isread']) : 0;
	$type = trim($_GET['type']);
	$wherearr = array('1');
	if(!empty($type)) {
		$wherearr[] = "`type`='$type'";
	}
	$new = 1;
	$wherearr[] = "`uid`='{$_G[uid]}'";

	$sql = implode(' AND ', $wherearr);


	$newnotify = false;
	$count=DB::result_first("select COUNT(*) from ".DB::table('user_notification')." where $sql ");
	if($count) {
		/*if($new && $perpage == 30) {
			$perpage = 200;
		}*/
		$query=DB::query("select * from ".DB::table('user_notification')." where $sql ORDER BY dateline DESC limit $start,$perpage");
		while($value=DB::fetch($query)){
			if($value['new']) {
				$newnotify = true;
				$value['style'] = 'color:#FFF;font-weight:bold;';
			} else {
				$value['style'] = 'color:#EEE';
			}
			$value['rowid'] = '';
			if(in_array($value['type'], array('friend', 'poke'))) {
				$value['rowid'] = ' id="'.($value['type'] == 'friend' ? 'pendingFriend_' : 'pokeQuery_').$value['authorid'].'" ';
			}
			if($value['from_num'] > 0) $value['from_num'] = $value['from_num'] - 1;
			$list[$value['id']] = $value;
		}
		
	
		$multi = '';
		$maxpage=ceil($count/$perpage);
			//$multi = pmmulti($count, $perpage, $page, $_G['siteurl'].DZZSCRIPT."?mod=dim&op=notice&isread=1&ajaxtarget=$_GET[ajaxtarget]");
		
	}

	if($newnotify) {
		C::t('user_notification')->ignore($_G['uid'], true, true);
		if($_G['setting']['cloud_status']) {
			$noticeService = Cloud::loadClass('Service_Client_Notification');
			$noticeService->setNoticeFlag($_G['uid'], TIMESTAMP);
		}
	}

	if($space['newprompt']) {
		C::t('user')->update($_G['uid'], array('newprompt'=>0));
	}
	if($_G['setting']['my_app_status']) {
		$mynotice = C::t('common_myinvite')->count_by_touid($_G['uid']);
	}

	$readtag = array($isread => ' class="a"');
}
if($page>1){
	include dzztemplate('dim/notice_list');
}else{
	include dzztemplate('dim/notice');
}

?>
