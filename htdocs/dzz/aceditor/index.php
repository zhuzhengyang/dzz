<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

$icoid=$_GET['icoid'];
if(isset($_GET['do']) && $_GET['do']=='autosave'){
	if(!$path=dzzdecode($_GET['path'])){
		exit(json_encode(array('msg'=>'参数错误')));
	}
	$msg=array();
	$message=$_GET['message'];
	try{
		
		if($_GET['code']) $message=diconv($message, CHARSET,$_GET['code']); 
		$icoarr=IO::setFileContent($path,$message);
		if($icoarr){
				if($icoarr['error']){
					echo json_encode(array('msg'=>$icoarr['error']));
					exit();
				}else{
					echo json_encode(array('msg'=>'success','icodata'=>$icoarr));
					exit();
				}
		 }else{
			echo json_encode(array('msg'=>'保存失败!'));
			exit();
		 }
		
	}catch(Exception $e){
			//var_dump($e);
			echo json_encode(array('msg'=>$e->getMessage()));
			exit();
	}
}elseif(strpos($icoid,'preview')!==false){ //此处兼容feed内文本文档的查看
	$path=dzzdecode($_GET['path']);
	$isadmin=0; //无权限
	$str=(IO::getFileContent($path));
	require_once DZZ_ROOT.'./dzz/class/class_encode.php';
	$p=new Encode_Core();
	$code=$p->get_encoding($str);
	if($code) $str=diconv($str,$code, CHARSET); 
	$str=htmlspecialchars($str);
	include template('textviewer');
}else{
	
	
	$_aceditor=array('fontsize'=>array('12px','13px','14px','15px','16px','18px','24px','32px'),
				 'themes'=>array( 'ace/theme/chrome'=>'Chrome',
									  'ace/theme/clouds'=>'Clouds',
									  'ace/theme/crimson_editor'=>'Crimson Editor',
									  'ace/theme/dawn'=>'Dawn',
									  'ace/theme/dreamweaver'=>'Dreamweaver',
									  'ace/theme/eclipse'=>'Eclipse',
									  'ace/theme/github'=>'GitHub',
									  'ace/theme/solarized_light'=>'Solarized Light',
									  'ace/theme/textmate'=>'TextMate',
									  'ace/theme/tomorrow" selected="selected'=>'Tomorrow',
									  'ace/theme/xcode'=>'XCode',
									  'ace/theme/kuroir'=>'Kuroir',
									  'ace/theme/katzenmilch'=>'KatzenMilch',
									  'ace/theme/ambiance'=>'Ambiance',
									  'ace/theme/chaos'=>'Chaos',
									  'ace/theme/clouds_midnight'=>'Clouds Midnight',
									  'ace/theme/cobalt'=>'Cobalt',
									  'ace/theme/idle_fingers'=>'idle Fingers',
									  'ace/theme/kr_theme'=>'krTheme',
									  'ace/theme/merbivore'=>'Merbivore',
									  'ace/theme/merbivore_soft'=>'Merbivore Soft',
									  'ace/theme/mono_industrial'=>'Mono Industrial',
									  'ace/theme/monokai'=>'Monokai',
									  'ace/theme/pastel_on_dark'=>'Pastel on dark',
									  'ace/theme/solarized_dark'=>'Solarized Dark',
									  'ace/theme/terminal'=>'Terminal',
									  'ace/theme/tomorrow_night'=>'Tomorrow Night',
									  'ace/theme/tomorrow_night_blue'=>'Tomorrow Night Blue',
									  'ace/theme/tomorrow_night_bright'=>'Tomorrow Night Bright',
									  'ace/theme/tomorrow_night_eighties'=>'Tomorrow Night 80s',
									  'ace/theme/twilight'=>'Twilight',
									  'ace/theme/vibrant_ink'=>'Vibrant Ink'
									  ),
				 'default'=>array('fontsize'=>'12px', //默认字体
				 				  'theme'=>'ace/theme/tomorrow', //默认主题
								  'showGutter'=>'1',  //显示行号
								  'wrapMode'=>'1',   //自动换行
								  'indentGuide'=>'1', //显示缩进指示线
								  'printMargin'=>'1', //显示打印宽度指示线
								  'autoComplete'=>'1',  //自动提示
								  'BehavioursEnabled'=>'0',  //自动补全
								  'showInvisible'=> '0' //显示不可见字符
								) 
				 );
	
	include template('main');
}


?>
