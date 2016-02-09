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
require_once libfile('function/organization');
$organization=C::t('organization')->fetch_all_by_forgid(0);
$defaultorgid=0;
//默认选中第一个机构
foreach($organization as $key=>$value){
	$defaultorgid=$key;
	break;
}
$orgid=empty($_GET['orgid'])?$defaultorgid:intval($_GET['orgid']);
$refer=dreferer();

//获取机构列表
if($org=C::t('organization')->fetch($orgid)){
	$org['moderators1']=C::t('organization_user')->fetch_moderators_by_orgid($org['orgid']);
	$org['membersum']=DB::result_first("select COUNT(*) from %t where orgid = %d",array('organization_user',$orgid));
}

if(isset($organization[$orgid])) $organization[$orgid]['active']='sel';



//获取当前机构的部门列表
$department=array();
if($orgid) {
	$html=getDepartment($orgid);
}
include template('main');
function getDepartment($orgid,$i=0){
	$html='';
	//$data[$orgid]['i']=$i;
	$i++;
	if($count=C::t('organization')->fetch_all_by_forgid($orgid,true)){
		
		$k=1;
		foreach(C::t('organization')->fetch_all_by_forgid($orgid) as $key=> $value){
			$value['moderators1']=C::t('organization_user')->fetch_moderators_by_orgid($value['orgid']);
			$value['membersum']=DB::result_first("select COUNT(*) from %t where orgid = %d",array('organization_user',$value['orgid']));
			
			$html1=getDepartment($value['orgid'],$i);
			$html.='<tr id="depart_'.$value['orgid'].'" forgid="'.$orgid.'"  _orgid="'.$value['orgid'].'" >';
			$html.='	<td><input type="text" class="form-control input-sm" name="org[disp]['.$value['orgid'].']" value="'.$value['disp'].'" style="width:45px;" /></td>';
			$html.='<td><div class="child-org">';
			for($j=0;$j<$i-1;$j++){
				$html.='<span class="child-tree tree-su">&nbsp;</span>';
			}
			$html.='<span class="child-tree '.($k<$count?'tree-heng':'tree-heng1').'">&nbsp;</span><input type="text" class="form-control input-sm" name="org[orgname]['.$value['orgid'].']" value="'.$value['orgname'].'" maxlength="10" />';
			$html.='<a href="javascript:;" forgid="'.$orgid.'"  forgid="'.$value['orgid'].'" title="添加下级部门"  style="padding-left:10px;"  onclick="addDepartment(this)"><i class="glyphicon glyphicon-plus">&nbsp;</i></a>';
			if($html1=='')	$html.='<a href="javascript:;"   style="padding-left:10px;" forgid="'.$orgid.'" forgid="'.$value['orgid'].'" title="删除此部门" onclick="delDepartment(this)"><i class="glyphicon glyphicon-remove">&nbsp;</i></a>';
			$html.='</div></td>';
			$html.='	<td><input type="checkbox" title="创建桌面快捷方式"  name="org[indesk]['.$value['orgid'].']" value="1" '.($value['indesk']?'checked="checked"':'').' /></td>';
			$html.='<td>';
			$html.='<a href="javascript:;" _orgid="'.$value['orgid'].'" onclick="editModerators(this)"  title="添加（编辑）成员"><i class="glyphicon glyphicon-edit">&nbsp;</i>';
			$html.='&nbsp;<span id="membersum_'.$value['orgid'].'">'.($value['membersum']?$value['membersum']:'').'</span></a>';
			$html.='<span id="moderators_username_'.$value['orgid'].'">';
			foreach($value['moderators1'] as $user){
				$html.='<a class="moderators-item" uid="'.$user['uid'].'" href="javascipt:;">'.$user['username'].'</a>';
			}
			$html.='</span>';
			$html.='</td>';
			$html.='</tr>';
			if($html1){
				$html.=$html1;
			}
			$k++;
		}
	}
	return $html;
}
?>
