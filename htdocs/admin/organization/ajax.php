<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @version     DzzOffice 1.0 release  2014.3.30
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ') || !defined('IN_ADMIN')) {
	exit('Access Denied');
}
error_reporting(E_ERROR);
include_once libfile('function/organization');
$do=trim($_GET['do']);
$orgid=intval($_GET['orgid']);
if(submitcheck('departsubmit')){
	//更新机构indesk
	$orgid=intval($_GET['orgid']);
	C::t('organization')->update($orgid,array('indesk'=>intval($_GET['indesk'])));
	foreach($_GET['org']['disp'] as $key => $value){
		if(empty($_GET['org']['orgname'][$key])) continue;
		$setarr=array(
						'orgname'=>$_GET['org']['orgname'][$key],
						'disp'   =>$_GET['org']['disp'][$key],
						'indesk'   =>$_GET['org']['indesk'][$key]
						);
		C::t('organization')->update_by_orgid($key,$setarr);
	}
	foreach($_GET['addorg']['disp'] as $key => $value){
		if(empty($_GET['addorg']['orgname'][$key])) continue;
		$setarr=array(
						'orgname'=>$_GET['addorg']['orgname'][$key],
						'disp'   =>$_GET['addorg']['disp'][$key],
						'forgid' =>$_GET['addorg']['forgid'][$key],
						);
		C::t('organization')->insert_by_forgid($setarr);
	}
	include_once libfile('function/cache');
	updatecache('organization');
	showmessage('do_success',BASESCRIPT,array(),array('showmsg'=>true));
}elseif($do=='editorg'){
	$setarr=array('forgid'=>intval($_GET['forgid']),
				  'orgname'=>rawurldecode($_GET['name']),
				  'disp'=>intval($_GET['disp']),
				  'forgid'=>0
				);
	if(!$orgid){ //如果没有orgid ，根据机构名称来获取。
		$orgid=DB::result_first("select orgid from ".DB::table('organization')." where forgid='0' and  orgname='{$setarr['name']}'");
	}
	if($orgid){
		if(C::t('organization')->update_by_orgid($orgid,$setarr)){
			include_once libfile('function/cache');
			updatecache('organization');
			$setarr['orgid']=$orgid;
			echo json_encode($setarr);
			exit();
		}else{
			$setarr['orgid']=$orgid;
			$setarr['error']='not modified';
			echo json_encode($setarr);
			exit();
		}
	}else{
		$setarr['dateline']=TIMESTAMP;
		if($setarr=C::t('organization')->insert_by_forgid($setarr)){
			include_once libfile('function/cache');
			updatecache('organization');
		}else{
			$setarr['error']='create organization failure';
		}
		echo json_encode($setarr);
		exit();
	}
}elseif($do=='deleteorg'){
	if($org=C::t('organization')->delete_by_orgid($orgid)){
		if($org['error']){
			echo json_encode(array('error'=>$org['error']));
			exit();
		}
		include_once libfile('function/cache');
		updatecache('organization');
		echo json_encode($org);
		exit();
	}else{
		echo json_encode(array('error'=>'删除错误！'));
		exit();
	}
}elseif($do=='savemoderators'){
	$orgid=intval($_GET['orgid']);
	$return=array();
	$uids=empty($_GET['uids'])?'':explode(',',$_GET['uids']);
	$moderators=empty($_GET['muids'])?array():explode(',',$_GET['muids']);
	C::t('organization_user')->delete_by_orgid($orgid);
	if($uids){
		foreach($uids as $uid){
			C::t('organization_user')->insert($uid,$orgid,in_array($uid,$moderators));
		}
	}
	include_once libfile('function/cache');
	updatecache('organization');
	echo json_encode($return);
	exit();
}
include template('ajax');

?>
