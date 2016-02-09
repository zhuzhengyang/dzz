<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="admin/scripts/admin.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
html,body{
overflow:hidden;
background:#FBFBFB;
}
.bs-left-container{
width:120px;
}
.bs-main-container{
margin-left:120px;
overflow:auto;
}
.progress.active .progress-bar{
-webkit-animation:none;
animation:none;
transition:none;
-webkit-box-shadow:none;
box-shadow:none;
}
</style><?php include template('common/header_simple_end'); ?><div class="bs-container clearfix">
  <div class="bs-left-container  clearfix">
    <?php include template('left'); ?> 
  </div>
  <div class="left-drager">
     <div class="left-drager-op"><div class="left-drager-sub"></div></div>
  </div>
      
  <div class="bs-main-container  clearfix" >
    <div class="main-header">
        	<div class="clearfix" style="line-height:40px;padding:0 10px;font-size:12px;">
            	<strong style="font-size:14px;">在线升级</strong>
                <?php if($operation == 'patch' || $operation == 'cross') { ?>
                <?php if(is_array($steplang)) foreach($steplang as $key => $value) { ?>                <?php if($key>0 && $key<=5) { ?>
                <span class="text-muted"   <?php if($key==$step) { ?>style="color:green"<?php } ?>><?php echo $key;?>.<?php echo $value;?></span>
                <?php } ?>
               <?php } ?>
                <?php } ?>
       		 </div>
        </li>
      </ul>
    </div>
    
     <?php if($operation=='check') { ?>
     <div class="main-content" style="border-top:1px solid #FFF">
     <?php if($msg) { ?>
     	<div  id="step4" style="padding:20px;height:450px">
          <div class="alert alert-warning text-center">
                 <?php echo $msg;?>
           </div>
         </div>
     <?php } else { ?>
       <div style="padding:20px;"> 
     		<div class="text-center" style="width:300px;margin:0 auto">
             <p style="margin:20px 0;">正在检测新的升级版本</p>
             <div class="progress progress-striped active" style="border:1px solid #5bc0de"><div class="progress-bar progress-bar-info " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"><span class="sr-only">100% Complete</span></div></div>
             
            </div> 
             <script type="text/javascript">
  jQuery('.progress-bar').animate({width:'100%'},3000,function(){
  window.location.href='<?php echo ADMINSCRIPT;?>?mod=system&op=upgrade&operation=check&checking=1';
  });
  </script>
      </div>
     
      <?php } ?>
      </div>
      <?php } elseif($operation=='showupgrade') { ?>
      <div class="main-content" style="border-top:1px solid #FFF">
        <?php if($msg) { ?>
        <div id="step4" style="padding:20px;height:450px">
           <div class="alert alert-warning">
              <?php echo $msg;?>
           </div>
        </div>
        <?php } else { ?>
         <table class="table table-hover">
         <thead><th colspan="5">检测到有新的版本可供升级，您可以选择自动升级或者下载安装包手动升级。</th></thead>
         <?php if(is_array($list)) foreach($list as $value) { ?>         <tr><td><?php echo $value['title'];?></td><td><?php echo $value['btn1'];?></td><?php if($value['official']) { ?><td><?php echo $value['official'];?></td><?php } ?></tr>
         <?php } ?>
         
         </table>
        <?php } ?> 
       </div>
     <?php } elseif($operation=='patch' || $operation=='cross' ) { ?>
     
     <div class="main-content" style="border-top:1px solid #FFF;">
        <?php if(!$_G['setting']['bbclosed']) { ?>
            <div style="padding:20px;height:450px">
               <div class="alert alert-warning text-center">
                 <?php echo $msg;?>
               </div>
            </div>
        <?php } elseif($step==1) { ?>
        	<table class="table table-hover">
             <thead><th colspan="5">待更新文件列表</th></thead>
             <?php if(is_array($updatefilelist)) foreach($updatefilelist as $value) { ?>             <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-file"></i> <?php echo $value;?></td></tr>
             <?php } ?>
             <thead><th colspan="5">&nbsp;<b>文件存放目录:</b>  ./data/update/dzzoffice<?php echo $version;?></th></thead>
             <thead><th colspan="5">&nbsp;<input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $linkurl;?>'" value="下载更新"><?php echo upgradeinformation(0)?></th></thead>
             
             </table>
       
        <?php } elseif($step==2) { ?>
           <div  style="padding:20px;"><?php echo $msg;?></div>
        
        <?php } elseif($step==3) { ?>
         <?php if($msg) { ?>
            <div  id="step4" style="padding:20px;">
               <div class="alert alert-warning text-center">
                  <?php echo $msg;?>
               </div>
            </div>
          <?php } else { ?>
             <table class="table table-hover">
             <thead><th colspan="5">与本地文件的比对结果，状态 <span style="color:red;">差异</span> 表示该本地文件被修改过<br />注意：如果您的源文件是通过 <span style="color:red;">非二进制</span> 方式上传到服务器，可能导致对比结果不准确</th></thead>
             <?php if(is_array($updatefilelist)) foreach($updatefilelist as $v) { ?>             <?php if(isset($ignorelist[$v])) { ?>
             
             <?php } elseif(isset($modifylist[$v])) { ?>
             <tr><td class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;差异 &nbsp;<i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $v;?></td></tr>
              <?php } elseif(isset($showlist[$v])) { ?>
              <tr><td class="text-success">&nbsp;&nbsp;&nbsp;&nbsp;正常 &nbsp;<i class="glyphicon glyphicon-ok"></i> <?php echo $v;?></td></tr>
              <?php } else { ?> 
               <tr><td class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;新增 &nbsp;<i class="glyphicon glyphicon-plus"></i> <?php echo $v;?></td></tr>
              <?php } ?> 
             <?php } ?>
              <thead><th colspan="5">升级文件已经全部下载完毕，并存储到服务器目录:  ./data/update/dzzoffice<?php echo $version;?></th></thead>
              <thead><th colspan="5">&nbsp;继续升级，将会把现有的旧文件备份到目录:  ./data/back/dzzoffice<?php echo CORE_VERSION;?> ，并用新的文件进行覆盖 </th></thead>
             <thead><th colspan="5">&nbsp;<input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $linkurl;?>';" value="<?php if(!empty($modifylist)) { ?>强制升级<?php } else { ?>正常升级<?php } ?>" /> <?php echo upgradeinformation(0)?></th></thead>
             
             </table>
         <?php } ?> 
        <?php } elseif($step==4) { ?>
         <?php if($msg) { ?>
            <div id="step4" style="padding:20px;height:450px">
                <div  class="alert alert-warning text-center">
                  <?php echo $msg;?>
               </div>
            </div>
          <?php } elseif($_GET['siteftpsetting']) { ?>
          <form name="aliform" class="form-horizontal form-horizontal-left" action="<?php echo $action;?>" method="post" style="padding:20px;">
                 <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
                 <p style="padding-left:20px;font-weight:bold;font-size:16px;padding-bottom:20px;">站点 FTP 设置</p>
                  <div class="form-group">
                    <label class="control-label">FTP 服务器地址</label>
                      <input type="text" class="form-control required" name="siteftp[host]" value="" placeholder="主机IP地址">
                      <span class="help-inline">可以是 FTP 服务器的 IP 地址或域名</span>
                  </div>
                  <div class="form-group">
                    <label class="control-label">FTP 服务器端口</label>
                      <input type="text" class="form-control required" name="siteftp[port]" value="21" placeholder="端口">
                      <span class="help-inline">默认为 21</span>
                  </div>
                  <div class="form-group">
                    <label class="control-label">FTP 帐号</label>
                      <input type="text" class="form-control required" name="siteftp[username]" value="" placeholder="FTP帐号用户名称">
                    <span class="help-inline">该帐号必需具有以下权限：读取文件、写入文件、删除文件、创建目录、子目录继承</span>
                  </div>
                  <div class="form-group">
                    <label class="control-label">FTP 密码</label>
                      <input type="password" class="form-control required" name="siteftp[password]" value="" placeholder="FTP帐号用户密码">
                    
                  </div>
                   <!--<div class="form-group">
                    <label class="control-label">编码</label>
                      <select class="form-control" name="siteftp[charset]">
                      <option value="GBK" selected="selected">GBK</option>
                      <option value="UTF-8">UTF-8</option>
                      <option value="BIG5">BIG5</option>
                      </select>
                    <span class="help-inline">根据FTP服务器的编码设置，不一致会导致乱码</span>
                    
                  </div>-->
                 
                  <div class="form-group">
                    <label class="control-label">站点根目录</label>
                      <input type="text" class="form-control required" name="siteftp[attachdir]" value="" >
                      <span class="help-inline">站点根目录的绝对路径或相对于 FTP 主目录的相对路径，结尾不要加斜杠“/”，“.”表示 FTP 主目录</span>
                  </div>
                  <div class="form-group">
                   <label class="control-label"></label>
                    <label class="checkbox-inline" style="width:180px;"><input type="checkbox" name="siteftp[pasv]" value="1">使用被动模式</label>
                    <span class="help-inline">一般情况下非被动模式即可，如果存在上传失败问题，可尝试打开此设置</span>
                  </div>
                 <div class="form-group">
                   <label class="control-label" ></label>
                    <label class="checkbox-inline" style="width:180px;"><input type="checkbox" name="siteftp[ssl]" value="1">启用安全链接</label>
                     <span class="help-inline">注意：FTP 服务器必需开启了 SSL</span>
                  </div>
                  <div class="form-group">
                     <label class="control-label"></label>
                      <input type="submit" class="btn btn-primary" style="padding:6px 25px" value="确定">
                 </div>
               </form>
          <?php } ?> 
       <?php } elseif($step==5) { ?>
         <div style="padding:20px;">
               <div class="alert alert-success text-center">
                  <?php echo $msg;?>
               </div>
            </div>
        <?php } ?> 
     </div> 
     
     <?php } ?> 
      
</div>
<script type="text/javascript">  
jQuery('.left-drager').leftDrager_layout();
function createIframe(src){
document.getElementById('step4').innerHTML='<iframe  marginheight="0" marginwidth="0" allowtransparency="true" frameborder="0"  src="'+src+'" style="width:100%;height:100%;"></iframe>';
}
</script><?php include template('common/footer_simple'); ?>