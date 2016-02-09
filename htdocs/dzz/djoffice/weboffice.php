<?php
/*
 * @copyright   
 * @license     
 * @package     DzzOffice
 * @version     DzzOffice 1.1.3
 * @link       
 * @author      长弓(58170488@qq.com)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
if(isset($_GET['do']) && $_GET['do']=='save'){
	if(!$path=dzzdecode($_GET['path'])){
		exit('此应用不支持直接打开，请在office文档右击选择打开');
	}
	$uid=empty($_GET['uid'])?0:intval($_GET['uid']);
	$member=getuserbyuid($uid);
	setglobal('uid',$member['uid']);
	setglobal('username', $member['username']);
	setglobal('adminid', $member['adminid']);
	setglobal('groupid',$member['groupid']);
	loadcache('usergroup_'.$member['groupid']);
	$fn=$_G['setting']['attachdir'].'./cache/'.md5($path).".lock";
    $uname=(file_get_contents($fn));
    $s=$_GET['uname'];
    if($uname==$s){
        if ($_FILES["file"]["error"] > 0)
        {
		    exit("Return Code: " . $_FILES["file"]["error"]);
        }
	    else
        {
			$str=file_get_contents($_FILES["file"]["tmp_name"]);
			if($icoarr=IO::setFileContent($path,$str)){
				if($icoarr['error']){
					exit(diconv($icoarr['error'],CHARSET,'GBK'));
				}else{
					if( @touch($fn)){exit(' succeed ');}
				}
			}
        }
    }else{
		$user=getuserbyuid($uname);
        exit(diconv('文件超过30分未保存，已经由 '.$user['username'].' 打开编辑，失去保存权限。',CHARSET,'GBK')); 
    }
}elseif(isset($_GET['do']) && $_GET['do']=='unlock'){
    if(!$path=dzzdecode($_GET['path'])){
		exit(json_encode(array('error'=>'参数错误!')));
	}
	$icoarr=IO::getMeta($path);
	$isadmin=0;
	if(perm_check::checkperm('edit',$icoarr)){
		$isadmin=1;
	}
	$fn=$_G['setting']['attachdir'].'./cache/'.md5($path).".lock";
    $uname=(file_get_contents($fn));
    $s=$_GET['uname'];
    if (file_exists($fn) && $isadmin==1 && $uname==$_G['uid']) { //判断文件是否锁定
        unlink($fn);
    }
	exit(json_encode(array('msg'=>'success')));
}else{
	if(!$path=dzzdecode($_GET['path'])){
		showmessage('参数错误!');
	}
	$fn=$_G['setting']['attachdir'].'./cache/'.md5($path).".lock";
	$error='';
	$table='';
    //清除过期的文件锁定，过期时间为30分
    if ((time()-filemtime($fn)) > 1800){unlink($fn);}
      
	$dpath=dzzencode($path);
	$icoarr=IO::getMeta($path);
	$patharr=explode(':',$path);
	if($patharr[0]=='ftp'){
		$fileurl=$_G['siteurl'].DZZSCRIPT.'?mod=io&op=getStream&path='.rawurldecode($_GET['path']);
	}else{
		$fileurl=IO::getFileUri($path);
		$fileurl=str_replace('-internal.aliyuncs.com','.aliyuncs.com',$fileurl);
	}
	//判断有无编辑权限
	$isadmin=0;
	if(perm_check::checkperm('edit',$icoarr)){
		$isadmin=1;
	}
    //判断文件是否锁定
    $uname=file_get_contents($fn);
    $s=$_G['uid'];
    if( $uname==$s || ! file_exists($fn)){$filelocked=0;}else{$filelocked=1;$lockuser=getuserbyuid($uname);}
	$editable=(!$filelocked && $isadmin)?1:0;
	include template('weboffice');
    lockFile($fn,$s); //锁定文件，其它人只能只读
}
/**
 * 锁定文件
 */
function lockFile($aimUrl,$uname) {
    if (file_exists($aimUrl)) {
        return true;
    }
    if( touch($aimUrl)){
        file_put_contents($aimUrl,($uname));
        return true;
    }else{
		return false;
	}
    
}
?>