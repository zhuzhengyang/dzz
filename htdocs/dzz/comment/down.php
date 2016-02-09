<?php
/*
 * 下载
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
$qid=intval($_GET['qid']);
$attachexists = FALSE;
	$attach=C::t('comment_attach')->fetch_by_qid($qid);
	if(!$attach['aid']){
		topshowmessage('附件不存在，或不是可下载的文件');
	}
	//更新下载数量
	C::t('comment_attach')->update($attach['qid'],array('downloads'=>$attach['downloads']+1));
	$filename = $_G['setting']['attachdir'].$attach['attachment'];
	!$_G['config']['output']['gzip'] && ob_end_clean();
	$filesize = !$attach['remote'] ? filesize($filename) : $attach['filesize'];
	if(strpos(strtolower($attach['filename']),$attach['filetype'])===false){
		$attach['filename'].='.'.$attach['filetype'];
	}
	$attachurl=getAttachUrl($attach,true);
	if($attach['title']) $attach['filename'] = '"'.(strtolower(CHARSET) == 'utf-8' && (strexists($_SERVER['HTTP_USER_AGENT'], 'MSIE') || strexists($_SERVER['HTTP_USER_AGENT'], 'rv:11')) ? urlencode($attach['title']) : $attach['title']).'"';
	else{
		$attach['filename'] = '"'.(strtolower(CHARSET) == 'utf-8' && strexists($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? urlencode($attach['title']) : $attach['title']).'"';
	}
	$db = DB::object();
	$db->close();
	$chunk = 10 * 1024 * 1024; 
	if(!$fp = @fopen($attachurl, 'rb')) {
		exit('文件不存在');
	}
	dheader('Date: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
	dheader('Last-Modified: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
	dheader('Content-Encoding: none');
	dheader('Content-Disposition: attachment; filename='.$attach['filename']);
	dheader('Content-Type: application/octet-stream');
	dheader('Content-Length: '.$filesize);
	!$_G['config']['output']['gzip'] && ob_end_clean();
	while (!feof($fp)) { 
		echo fread($fp, $chunk);
		@ob_flush();  // flush output
		@flush();
	}
	exit();
	
		
?>
