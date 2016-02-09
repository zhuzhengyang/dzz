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
}.pagination {
float:right;	
}

input[type="text"]{
margin:0;
}
html,body{
width:100%;heiht:100%;
overflow:hidden;
word-break:break-all;word-wrap:break-word;
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
        	<ul class="nav nav-pills  nav-pills-bottomguide" >
                <li <?php if($operation=='illegal') { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=illegal">用户错误登录</a></li> 
                <li <?php if($operation=='sendmail') { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=sendmail">邮件发送失败</a></li>
                 <li <?php if($operation=='cp') { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=cp">后台访问</a></li> 
                 <li <?php if($operation=='error') { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=error">系统错误</a></li>
                <span class="pull-right" style="margin:3px;"><?php echo $sel;?></span>
            </ul>
        </div>
    	<div class="main-content" style="border-top:1px solid #FFF">
       
          	<?php if($operation=='illegal') { ?>
            <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=<?php echo $operation;?>" class="form-horizontal form-horizontal-left" method="post" name="cpform">
                <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                <input type="hidden" name="lpp" value="20">
            	<table class="table">
                	<thead><th>时间</th><th>IP 地址</th><th>尝试用户名</th><th>尝试密码</th><th>安全提问</th></thead>
                 <?php if($list) { ?>
                    <?php if(is_array($list)) foreach($list as $log) { ?>                    <tr><td><?php echo $log['1'];?></td><td><?php echo $log['5'];?></td><td><?php echo $log['2'];?></td><td><?php echo $log['3'];?></td><td><?php echo $log['4'];?></td></tr>
                    <?php } ?>
                 <?php } else { ?> 
                 	<tr><td colspan="5">没有相关的结果</td>
                 <?php } ?>
                <tr>
                	<td colspan="5">
                         <div class="pull-left input-group" style="width:100px;">
                             <span class="input-group-addon">每页显示</span>
                             <select class="input-sm form-control" style="margin:0;width:60px;" onchange="if(this.options[this.selectedIndex].value != '') {this.form.lpp.value = this.options[this.selectedIndex].value;this.form.submit(); }" ><option value="20" <?php echo $checklpp['20'];?>> 20 </option><option value="40" <?php echo $checklpp['40'];?>> 40 </option><option value="80" <?php echo $checklpp['80'];?>> 80 </option></select>
                          </div>
                           <div class="pull-left input-group" style="width:128px;">
                           <input type="text" class="input-sm form-control" style="width:90px;border-left:0" name="keyword" value="<?php echo $_GET['keyword'];?>">
                           <a href="javascript:;" class="input-group-addon" onclick="$('cpform').submit();return false"><i class="glyphicon glyphicon-search"></i></a>
                           </div>
                           <?php echo $multipage;?>
                       
               		 </td>
                 </tr>
                </table>
            </form>
            <?php } elseif($operation=='sendmail') { ?>
            <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=<?php echo $operation;?>" class="form-horizontal form-horizontal-left"  method="post" name="cpform">
                <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                <input type="hidden" name="lpp" value="20">
            	<table class="table">
                	<thead><th>时间</th><th>用户名</th><th>邮箱</th></thead>
                   <?php if($list) { ?>
                    <?php if(is_array($list)) foreach($list as $log) { ?>                    <tr><td><?php echo $log['1'];?></td><td><?php echo $log['6'];?></td><td><?php echo $log['5'];?></td></tr>
                    <?php } ?>
                 <?php } else { ?> 
                 	<tr><td colspan="5">没有相关的结果</td>
                 <?php } ?>
                <tr>
                	<td colspan="15">
                       <div class="pull-left input-group" style="width:100px;">
                             <span class="input-group-addon">每页显示</span>
                             <select class="input-sm form-control" style="margin:0;width:60px;" onchange="if(this.options[this.selectedIndex].value != '') {this.form.lpp.value = this.options[this.selectedIndex].value;this.form.submit(); }" ><option value="20" <?php echo $checklpp['20'];?>> 20 </option><option value="40" <?php echo $checklpp['40'];?>> 40 </option><option value="80" <?php echo $checklpp['80'];?>> 80 </option></select>
                          </div>
                           <div class="pull-left input-group" style="width:128px;">
                           <input type="text" class="input-sm form-control" style="width:90px;border-left:0" name="keyword" value="<?php echo $_GET['keyword'];?>">
                           <a href="javascript:;" class="input-group-addon" onclick="$('cpform').submit();return false"><i class="glyphicon glyphicon-search"></i></a>
                           </div>
                           <?php echo $multipage;?>
               		 </td>
                 </tr>
                </table>
            </form>
            <?php } elseif($operation=='cp') { ?>
            <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=<?php echo $operation;?>" class="form-horizontal form-horizontal-left"  method="post" name="cpform">
                <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                <input type="hidden" name="lpp" value="20">
            	<table class="table" >
                	<thead><th width="80">操作者</th><th  width="80">用户组</th><th  width="100">IP 地址</th><th width="120">时间</th><th>其他</th></thead>
                  <?php if($list) { ?> 
                    <?php if(is_array($list)) foreach($list as $key => $log) { ?>                    <tr><td><?php echo $log['2'];?></td><td><?php echo $log['3'];?></td><td><?php echo $log['4'];?></td><td><?php echo $log['1'];?></td><td ><a href="javascript:;" onclick="togglecplog('<?php echo $key;?>')"><?php echo cutstr($log[6], 200)?></a></td></tr>
                    <thead id="cplog_<?php echo $key;?>" style="display:none"><td colspan="10"><?php echo $log['6'];?></td></thead>
                    <?php } ?>
                <?php } else { ?> 
                 	<tr><td colspan="5">没有相关的结果</td>
                 <?php } ?>
                <tr>
                	<td colspan="15">
                       <div class="pull-left input-group" style="width:100px;">
                             <span class="input-group-addon">每页显示</span>
                             <select class="input-sm form-control" style="margin:0;width:60px;" onchange="if(this.options[this.selectedIndex].value != '') {this.form.lpp.value = this.options[this.selectedIndex].value;this.form.submit(); }" ><option value="20" <?php echo $checklpp['20'];?>> 20 </option><option value="40" <?php echo $checklpp['40'];?>> 40 </option><option value="80" <?php echo $checklpp['80'];?>> 80 </option></select>
                          </div>
                           <div class="pull-left input-group" style="width:128px;">
                           <input type="text" class="input-sm form-control" style="width:90px;border-left:0" name="keyword" value="<?php echo $_GET['keyword'];?>">
                           <a href="javascript:;" class="input-group-addon" onclick="$('cpform').submit();return false"><i class="glyphicon glyphicon-search"></i></a>
                           </div>
                           <?php echo $multipage;?>
               		 </td>
                 </tr>
                </table>
            </form>
            
            <script type="text/javascript">
function togglecplog(k) {
var cplogobj = $('cplog_'+k);
if(cplogobj.style.display == 'none') {
cplogobj.style.display = '';
} else {
cplogobj.style.display = 'none';
}
}
</script>
            <?php } elseif($operation=='error') { ?>
               <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=log&operation=<?php echo $operation;?>" class="form-horizontal form-horizontal-left"   method="post" name="cpform">
                <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                <input type="hidden" name="lpp" value="20">
            	<table class="table" >
                	<thead><th width="80">时间</th><th >Dzz! 提示</th></thead>
                  <?php if($list) { ?>
                    <?php if(is_array($list)) foreach($list as $log) { ?>                    <tr><td width="80"><?php echo $log['1'];?></td><td  style=""><?php echo $log['2'];?></td></tr>
                    <?php } ?>
                 <?php } else { ?> 
                 	<tr><td colspan="5">没有相关的结果</td>
                 <?php } ?>
                <tr>
                	<td colspan="2">
                       <div class="pull-left input-group" style="width:100px;">
                             <span class="input-group-addon">每页显示</span>
                             <select class="input-sm form-control" style="margin:0;width:60px;" onchange="if(this.options[this.selectedIndex].value != '') {this.form.lpp.value = this.options[this.selectedIndex].value;this.form.submit(); }" ><option value="20" <?php echo $checklpp['20'];?>> 20 </option><option value="40" <?php echo $checklpp['40'];?>> 40 </option><option value="80" <?php echo $checklpp['80'];?>> 80 </option></select>
                          </div>
                           <div class="pull-left input-group" style="width:128px;">
                           <input type="text" class="input-sm form-control" style="width:90px;border-left:0" name="keyword" value="<?php echo $_GET['keyword'];?>">
                           <a href="javascript:;" class="input-group-addon" onclick="$('cpform').submit();return false"><i class="glyphicon glyphicon-search"></i></a>
                           </div>
                           <?php echo $multipage;?>
                       
               		 </td>
                 </tr>
                </table>
            </form>
                   
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">  
jQuery('.left-drager').leftDrager_layout();
</script><?php include template('common/footer_simple'); ?>