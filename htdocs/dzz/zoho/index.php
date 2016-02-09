<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @version     DzzOffice 1.0 release  2014.3.30
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
$ZohoAPIKey=''; //将申请到的zoho,地址https://zapi.zoho.com/apigen.do

$docexts=array('doc', 'docx', 'rtf', 'odt', 'htm', 'html', 'txt');
$sheetexts=array('xls', 'xlsx', 'ods', 'sxc', 'csv', 'tsv');
$showexts=array('ppt', 'pptx', 'pps', 'ppsx', 'odp', 'sxi');

$path=rawurldecode($_GET['path']);

$data=IO::getMeta($path);
if(!perm_check::checkperm('admin',$data)){
	$mode='view';
}else{
	$mode='normaledit';
}
$posturl='';
if(in_array($data['ext'],$docexts)){
	$posturl='https://exportwriter.zoho.com/remotedoc.im';
}elseif(in_array($data['ext'],$sheetexts)){
	$posturl='https://sheet.zoho.com/remotedoc.im';
}elseif(in_array($data['ext'],$showexts)){
	$posturl='https://show.zoho.com/remotedoc.im';
}else{
	showmessage('不支持的格式');
}
$stream=IO::getFileUri($path);
$length=strlen($content);
$saveurl=$_G['siteurl'].DZZSCRIPT.'?mod=system&op=ajax&do=savefile&path='.rawurlencode($path);
include template('zohoedit');

?>
