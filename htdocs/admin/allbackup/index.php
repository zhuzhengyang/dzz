<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @version     DzzOffice 1.1 2014.07.05
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ') || !defined('IN_ADMIN')) {
	exit('Access Denied');
}
include libfile('class/DbManage');

set_time_limit(0);
$do=$_GET['do'];
if($do=='backup'){
	
	$db = new DBManage ( $_G['config']['db']['1']['dbhost'], $_G['config']['db']['1']['dbuser'], $_G['config']['db']['1']['dbpw'], $_G['config']['db']['1']['dbname'], $_G['config']['db']['1']['dbcharset']);
	$folder=dgmdate($_G['timestamp'],'Y-m-d-h-i-s').'-'.random(5);
	$db->backup('','./data/allbackup/'.$folder.'/db/',0,$folder);
	copy_dir('./data/attachment/','./data/allbackup/'.$folder.'/file/');
	echo('附件目录拷贝成功');
	//exit('备份成功');
	showmessage('备份成功',ADMINSCRIPT.'?mod=allbackup');
}elseif($do=='delete'){//删除备份
	$folder=trim($_GET['folder']);
	rmdirs('./data/allbackup/'.$folder.'/');
	showmessage('备份删除成功',ADMINSCRIPT.'?mod=allbackup');
}elseif($do=='restore'){//恢复备份
	$folder=trim($_GET['folder']);
	//exit('./data/allbackup/'.$folder.'/db/'.$folder.'_all_v1.sql');
	$db = new DBManage ( $_G['config']['db']['1']['dbhost'], $_G['config']['db']['1']['dbuser'], $_G['config']['db']['1']['dbpw'], $_G['config']['db']['1']['dbname'], $_G['config']['db']['1']['dbcharset']);
	$db->restore('./data/allbackup/'.$folder.'/db/'.$folder.'_all_v1.sql');
	copy_dir('./data/allbackup/'.$folder.'/file/','./data/attachment/');
	//exit('备份恢复成功');
	showmessage('备份恢复成功',ADMINSCRIPT.'?mod=allbackup');
}else{
	$list=array();
	$srcdir='./data/allbackup';
	$dir = @opendir($srcdir);
	while($entry = @readdir($dir)) {
		
		if($entry != '.' && $entry != '..') {
			if(is_dir($srcdir.'/'.$entry)) {
				$list[]=$entry;
			}
		}
	}
	include template('main');
}

function copy_dir($srcdir, $destdir) {
		$dir = @opendir($srcdir);
		while($entry = @readdir($dir)) {
			$file = $srcdir.$entry;
			if($entry != '.' && $entry != '..') {
				if(is_dir($file)) {
					copy_dir($file.'/', $destdir.$entry.'/');
				} else {
					mkdirs(dirname($destdir.$entry));
					copy($file, $destdir.$entry);
				}
			}
		}
		closedir($dir);
	}
function mkdirs($dir) {
	if(!is_dir($dir)){
		if(!mkdirs(dirname($dir))) {
			return false;
		}
		if(!@mkdir($dir, 0777)) {
			return false;
		}
	}
	return true;
}
function rmdirs($srcdir) {
		$dir = @opendir($srcdir);
		while($entry = @readdir($dir)) {
			$file = $srcdir.$entry;
			if($entry != '.' && $entry != '..') {
				if(is_dir($file)) {
					rmdirs($file.'/');
				} else {
					@unlink($file);
				}
			}
		}
		closedir($dir);
		rmdir($srcdir);
	}
?>
