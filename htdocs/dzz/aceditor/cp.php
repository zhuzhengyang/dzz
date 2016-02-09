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

if(isset($_GET['do']) && $_GET['do']=='save'){
	if(!$path=dzzdecode($_GET['path'])){
		exit(json_encode(array('msg'=>'参数错误')));
	}
	$msg=array();
	$message=$_GET['fileContent'];
	try{
		
		if($_GET['code']) $message=diconv($message, CHARSET,$_GET['code']); 
		$icoarr=IO::setFileContent($path,$message);
		if($icoarr){
				if($icoarr['error']){
					echo json_encode(array('error'=>$icoarr['error']));
					exit();
				}else{
					if($_GET['isnew']){
						$data=array();
						$data['code']=$_GET['code'];
						$data['dpath']=$icoarr['dpath'];
						$data['path']=$icoarr['path'];
						if(!$icoarr['bz']){
							$arr=getPathByPfid($icoarr['pfid']);
							$patharr=array();
							while($arr){
								$patharr[]=array_pop($arr);
							}
							$data['tree']=implode('/',$patharr).'/'.$icoarr['name'];
						}else $data['tree']=$icoarr['path'];
						if($icoarr['ext']) $data['filename']=trim($icoarr['name'],'.'.$icoarr['ext']).'.'.$icoarr['ext'];
						else $data['filename']=$icoarr['name'];
					}
					echo json_encode(array('msg'=>'success','data'=>$data));
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
}elseif($_GET['do']=='saveto'){
	$msg=array();
	$message=$_GET['fileContent'];
	try{
		
		if($_GET['code']) $message=diconv($message, CHARSET,$_GET['code']); 
		$path=$_GET['path'];
		$filename=strtolower($_GET['filename']);
		if($icoarr=IO::upload_by_content($message,$path,$filename)){
			if($arr['error']){
			}else{
				$data=array();
				$data['code']=$_GET['code'];
				$data['dpath']=$icoarr['dpath'];
				$data['path']=$icoarr['path'];
				if(!$icoarr['bz']){
					$arr=getPathByPfid($icoarr['pfid']);
					$patharr=array();
					while($arr){
						$patharr[]=array_pop($arr);
					}
					$data['tree']=implode('/',$patharr).'/'.$icoarr['name'];
				}else $data['tree']=$icoarr['path'];
				if($icoarr['ext']) $data['filename']=trim($icoarr['name'],'.'.$icoarr['ext']).'.'.$icoarr['ext'];
				else $data['filename']=$icoarr['name'];
				echo json_encode(array('msg'=>'success','data'=>$data,'icoarr'=>$icoarr));
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
}elseif($_GET['do']=='getDataByPath'){ //获取文件信息和内容
	if(!$path=dzzdecode($_GET['path'])){
		exit(json_encode(array('error'=>'文件不存在')));
	}
	if(!$icoarr=IO::getMeta($path)){
		exit(json_encode(array('error'=>'获取文件信息错误')));
	}
	if($icoarr['error']){
		exit(json_encode(array('error'=>$icoarr['error'])));
	}
	if(!perm_check::checkperm($icoarr)){
		$icoarr['readOnly']=1;
	}else{
		$icoarr['readOnly']=0;
	}
	$str=(IO::getFileContent($path));
	require_once DZZ_ROOT.'./dzz/class/class_encode.php';
	$p=new Encode_Core();
	$code=$p->get_encoding($str);
	if($code) $str=diconv($str,$code, CHARSET); 
	$icoarr['str']=($str);
	$icoarr['code']=$code;
	if(!$icoarr['bz']){
		$arr=getPathByPfid($icoarr['pfid']);
		$patharr=array();
		while($arr){
			$patharr[]=array_pop($arr);
		}
		$icoarr['tree']=implode('/',$patharr).'/'.$icoarr['name'];
	}else $icoarr['tree']=$icoarr['path'];
	if($icoarr['ext']) $icoarr['filename']=trim($icoarr['name'],'.'.$icoarr['ext']).'.'.$icoarr['ext'];
	else $icoarr['filename']=$icoarr['name'];
	exit(json_encode($icoarr));
}


?>
