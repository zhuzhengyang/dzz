<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="dzz/connect/images/connect.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="dzz/scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php include template('common/header_simple_end'); ?><div class="container" style="height:100%">
  	<div class="main-header clearfix">
         <ul class="nav nav-pills nav-pills-bottomguide">
              <li><a href="<?php echo BASESCRIPT;?>?mod=connect">我的云</a></li>
              <li><a href="<?php echo BASESCRIPT;?>?mod=connect&op=addcloud">添加云</a></li>
               <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=connect&op=oauth&bz=ftp">添加FTP</a></li>
        </ul>
    </div>
<div class="main-content clearfix">
    	<div class="container" style="padding:15px;">
           	 <form  name="aliform" class="form-horizontal form-horizontal-left" action="<?php echo BASESCRIPT;?>?mod=connect&op=oauth" method="post" onsubmit="return validate(this)">
   				 <input type="hidden" name="ftpsubmit" value="true" />
                  <input type="hidden" name="bz" value="ftp" />
                 <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
                  <div class="form-group">
                    <label class="control-label" >站点名称</label>
                      <input type="text"  class="form-control required" name="config[cloudname]"  value="" >
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label" >IP地址</label>
                      <input type="text"  class="form-control required" name="config[host]"  value="" placeholder="主机IP地址">
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label" >端口</label>
                      <input type="text"  class="form-control required" name="config[port]"  value="21" placeholder="端口">
                      <span  class="help-inline"></span>
                  </div>
                  <div class="form-group">
                    <label class="control-label" >用户名</label>
                      <input type="text"  class="form-control required" name="config[username]"  value="" placeholder="FTP帐号用户名称">
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label" >密码</label>
                      <input type="password"   class="form-control required" name="config[password]"  value="" placeholder="FTP帐号用户密码">
                    
                  </div>
                   <div class="form-group">
                    <label class="control-label" >编码</label>
                      <select class="form-control" name="config[charset]">
                      <option value="GBK" selected="selected">GBK</option>
                      <option value="UTF-8">UTF-8</option>
                      <option value="BIG5">BIG5</option>
                      </select>
                    <span class="help-inline">根据FTP服务器的编码设置，不一致会导致乱码</span>
                    
                  </div>
                  <div class="form-group">
                   <label class="control-label" ></label>
                    <label class="checkbox-inline" ><input type="checkbox"  name="config[pasv]" checked="checked" value="1" >使用被动模式</label>
                    <label class="checkbox-inline" ><input type="checkbox"  name="config[ssl]"  value="1" >启用安全链接</label>
                  </div>
                 
                  
                  <div class="form-group">
                     <label class="control-label" ></label>
                      <input type="submit" class="btn btn-primary" style="padding:6px 25px" value="添加" >
                 </div>
               </form>
           </div>
    </div>
 </div>
 <script type="text/javascript">

function validate(form){
var i=0;
jQuery("input.required").each(function(){
if(jQuery(this).val()==''){
jQuery(this).focus();
return false;
}
i++;
});
if(i<jQuery("input.required").length){
return false;
}else{
return true;
}
}




 </script><?php include template('common/footer_simple'); ?>