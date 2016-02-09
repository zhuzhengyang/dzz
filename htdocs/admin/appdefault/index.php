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
if(submitcheck('appsubmit')){
	$setarr=array();
	foreach($_GET['disp'] as $key=>$value){
		$setarr=array(
						'disp'=>intval($value),
						'position'=>intval($_GET['position'][$key]),
						'notdelete'=>intval($_GET['notdelete'][$key]),
						);
		C::t('app_market')->update($key,$setarr);
	}
	showmessage('do_success',dreferer());
}
$positionarr=array('0'=>'无','1'=>'开始菜单','2'=>'桌面','3'=>'任务栏');
include libfile('function/organization');
$group=intval($_GET['group']);
$depid=intval($_GET['depid']);

$org=array();
if($depid) $org=C::t('organization')->fetch($depid);
$orgtree=getDepartmentOption(0,BASESCRIPT.'?mod=appdefault');


$position=intval($_GET['position']);
$keyword=trim($_GET['keyword']);


$page = empty($_GET['page'])?1:intval($_GET['page']);
$perpage=20;
$gets = array(
		'mod'=>'appdefault',
		'keyword'=>$keyword,
		'depid' => $tagid,
		'group'=>$group,
		'position'=>$position,
	);
$theurl = BASESCRIPT."?".url_implode($gets);
$refer=urlencode($theurl.'&page='.$page);

$order='ORDER BY disp';
$start=($page-1)*$perpage;
$list=array();
$sqlarr=array();
if($depid){
	//获取此机构所有下级机构的id
	$orgids=getOrgidTree($depid);
	if($appids=C::t('app_organization')->fetch_appids_by_orgid($orgids)){
		$sqlarr[]="appid IN (".dimplode($appids).") and `group`='1'";
	}else{
		$sqlarr[]="appid='0'";
	}

}elseif($group==1){
	$appids=array();
	foreach(DB::fetch_all("select appid from %t where 1 ",array('app_organization')) as $value){
		$appids[$value['appid']]=$value['appid'];
	}
	if($appids ){
		$sqlarr[]="appid NOT IN (".dimplode($appids).") and `group`='1'";
	}else{
		$sqlarr[]="`group`='1'";
	}
	
}else{
	$sqlarr[]="`group`='{$group}'";
}
if($sqlarr){
	$sql="(".implode('and',$sqlarr)." )";
}else{
	$sql=" `group='0'";
}
if($keyword) {
	$sql.=" and  appname like '%$keyword%'";
}elseif($position){
	$sql.=" and `position`='{$position}'";
}

$apps=array();

if($count=DB::result_first("SELECT COUNT(*) FROM ".DB::table('app_market')." WHERE $sql ")){
	$apps=DB::fetch_all("SELECT * FROM ".DB::table('app_market')." WHERE $sql $order limit $start,$perpage");
	$multi=multi($count, $perpage, $page, $theurl,'pull-right');
}
foreach($apps as $value){
	
	if($value['appico']!='dzz/images/default/icodefault.png' && !preg_match("/^(http|ftp|https|mms)\:\/\/(.+?)/i", $value['appico'])){
		$value['appico']=$_G['setting']['attachurl'].$value['appico'];
	}
	$value['appurl']=BASESCRIPT.'?mod=app&op=edit&appid='.$value['appid'];
	$list[]=$value;
}

include template('app');

?>
