<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<div class="main-header" style="padding:0 15px">
  <ul class="nav nav-pills nav-pills-bottomguide">
    <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=orguser&op=edituser&do=add&orgid=<?php echo $orgid;?>" onclick="jQuery('#orguser_container').load(this.href);return false;">添加用户</a></li>
  </ul>
</div>
<div class="main-body" style="padding:15px 15px 15px 22px;">
  <div id="return_adduser" style="display:none"></div>
  <form id="accountform" name="accountform" class="form-horizontal form-horizontal-left" action="<?php echo BASESCRIPT;?>?mod=orguser&op=edituser" method="post" onsubmit="account_submit();return false">
    <input type="hidden" name="accountadd" value="true" />
    <input type="hidden" name="uid" value="<?php echo $uid;?>" />
    <input type="hidden" name="handlekey" value="adduser" />
    <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
    <div class="form-group">
      <label class="control-label" for="email">登录邮箱</label>
      <div class="controls">
        <input type="text" class="form-control input-sm" id="email" name="email" autocomplete="off" value="<?php echo $user['email'];?>" onblur="checkemail(this.id);">
        <p  id="emailmore" style="height:1px;margin:0;">&nbsp;</p>
      </div>
      <span id="chk_email" class="help-inline"> <span id="suc_email"></span><kbd class="p_chk"></kbd> 必填，可用于系统登录，员工关注企业号时，会根据邮箱来匹配。</span> </div>
    <div class="form-group">
      <label class="control-label" for="nickname">登录用户名</label>
      <div class="controls">
        <input type="text" class="form-control input-sm" id="nickname" name="nickname" placeholder="登录用户名（选填）" autocomplete="off" value="<?php echo $user['nickname'];?>" onblur="checknick(this.id);">
      </div>
      <span id="chk_nickname" class="help-inline"> <span id="suc_nickname"></span><kbd class="p_chk"></kbd> 选填，可用于系统登录 </span> </div>
    <div class="form-group">
      <label class="control-label" for="username">姓 名</label>
      <div class="controls">
        <input type="text" class="form-control input-sm" class="form-control input-sm" placeholder="用户真实姓名" id="username" name="username" autocomplete="off" value="<?php echo $user['username'];?>" >
      </div>
      <span id="chk_username" class="help-inline">必填，系统中显示，便于同事辨识</span> </div>
     
       <div class="form-group">
          <label class="control-label" for="username">手机号码</label>
          <div class="controls">
            <input type="text" class="form-control input-sm" class="form-control input-sm" placeholder="微信绑定的手机号码" id="phone" name="phone" autocomplete="off" value="<?php echo $user['phone'];?>" >
          </div>
           <span id="chk_phone" class="help-inline">选填，微信绑定的手机号码，员工关注企业号时，会根据员工微信绑定的手机来匹配。</span>
      </div>
     
       <div class="form-group">
          <label class="control-label" for="username">微信号</label>
          <div class="controls">
            <input type="text" class="form-control input-sm" class="form-control input-sm" placeholder="员工微信号" id="weixinid" name="weixinid" autocomplete="off" value="<?php echo $user['weixinid'];?>">
          </div>
           <span id="chk_weixinid" class="help-inline">选填，员工微信号，员工关注企业号时，会根据员工的微信号来匹配。</span>
      </div>
    
    <div class="form-group">
      <label class="control-label" for="password">登录密码</label>
      <div class="controls">
        <input type="text" class="form-control input-sm" name="password" autocomplete="off" id="password" placeholder="输入密码">
      </div>
      <span id="chk_password" class="help-inline"> <span id="suc_password"></span> <kbd id="chk_password" class="p_chk"></kbd> </span> </div>
    <div class="form-group">
      <label class="control-label" for="password2">确认密码</label>
      <div class="controls">
        <input type="text" class="form-control input-sm" id="password2" name="password2" autocomplete="off" placeholder="再次输入密码" >
      </div>
      <span id="chk_password2" class="help-inline"> <span id="suc_password2"></span> <kbd id="chk_password2" class="p_chk"></kbd> </span> </div>
    <div class="form-group">
      <label class="control-label"></label>
      <div class="controls"> <a href="javascript:;" class="btn btn-simple" onclick="randomPass()">生成随机密码</a> </div>
    </div>
    <div class="form-group">
      <label class="control-label" for="addsize">额外空间</label>
      <div class="controls"  style="width:180px;">
        <div class="input-group " > <input type="text" class="form-control input-sm" style="width:146px;" id="addsize" <?php if($_G['adminid']!=1) { ?>disabled="disabled"<?php } ?> name="addsize" value="0" autocomplete="off" > <span class="input-group-addon">M</span> </div>
      </div>
      <span class="help-inline">单位M，额外增加用户存储空间（用户的总空间=默认空间+额外空间）</span> </div>
    <div class="form-group">
      <label class="control-label" for="">停用此用户</label>
      <div class="controls ml20" style="width:160px;">
        <label class="checkbox-inline" ><input type="checkbox" name="status" <?php if($_G['adminid']!=1) { ?>disabled="disabled"<?php } ?> value="1" <?php if($user['status']) { ?>checked<?php } ?>>停用</label>
      </div>
      <span class="help-inline">用户停用后，该用户将不能登录系统，请谨慎操作</span> </div>
    <div class="form-group">
      <label class="control-label" for="">系统权限</label>
      <div class="controls ml20" style="width:160px;">
        <label class="checkbox-inline" ><input type="checkbox" name="adminid" <?php if($_G['adminid']!=1) { ?>disabled="disabled"<?php } ?> value="1" <?php if($user['adminid']==1) { ?>checked<?php } ?>>设为系统管理员</label>
      </div>
      <span class="help-inline">设置用户为系统管理员后，此用户将拥有系统管理权限，请慎重！</span> </div>
    <div class="form-group">
      <label class="control-label" for="depart">部门职位&nbsp;[&nbsp;<a href="javascript:;" class="glyphicon glyphicon-plus" onclick="addorgsel()" title="增加一项"></a>&nbsp;]</label>
      <div id="selorg_container" class="controls selorg-container"> 
        <?php if($org) { ?>
        <ul class="nav nav-pills">
             <li class="dropdown org">
                 <input id="sel_orgid_<?php echo $org['orgid'];?>" type="hidden" name="orgids[]"  value="<?php echo $org['orgid'];?>" onchange="selDepart(this)" />
                  <button type="button" id="orgid_<?php echo $org['orgid'];?>_Menu" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <?php echo $org['depart'];?> <span class="caret"></span>
                  </button>
                  <div id="orgid_<?php echo $orgid_dropdown_menu;?>" class="dropdown-menu org-sel-box" role="menu" aria-labelledby="orgid_<?php echo $org['orgid'];?>_Menu">
                       <iframe name="orgid_<?php echo $org['orgid'];?>_iframe" class="org-sel-box-iframe" src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=orgid_<?php echo $org['orgid'];?>&amp;nouser=1&amp;moderator=1" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" ></iframe>
                  </div>
              </li>
             <li class="dropdown job">
                <input type="hidden" name="jobids[]" value="0" />
                  
                  <a href="javascript:;" data-toggle="dropdown" role="button" _jobid="0"  class="dropdown-toggle btn btn-simple jobid"><span>无</span><b class="caret"></b></a>
                 
                    <ul aria-labelledby="drop-depart" role="menu" class="dropdown-menu"  >
                          <li role="presentation"><a href="javascript:;" tabindex="-1" role="menuitem" _jobid="0" onclick="selJob(this)">无</a></li>
                          <?php if(is_array($org['jobs'])) foreach($org['jobs'] as $value1) { ?> 
                          <li role="presentation"><a href="javascript:;" tabindex="-1" role="menuitem" _jobid="<?php echo $value1['jobid'];?>" onclick="selJob(this)"><?php echo $value1['name'];?></a></li>
                          <?php } ?>
                    </ul>
              </li>
             <li ><a style="margin:0 10px 10px 0;" href="javascript:;"  onclick="delDepart(this)" ttitle="删除"><i class="glyphicon glyphicon-remove"></i></a></li>
         </ul> 
        <?php } ?>
        <ul id="nav" class="nav nav-pills">
         <li class="dropdown org">
             <input id="sel_orgid_tpml" type="hidden" name="orgids[]"  value="0" onchange="selDepart(this)" />
              <button type="button" id="orgid_tpml_Menu" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                请选择机构或部门 <span class="caret"></span>
              </button>
              <div id="orgid_tpml_dropdown_menu" class="dropdown-menu org-sel-box" role="menu" aria-labelledby="orgid_tpml_Menu">
                   <iframe name="orgid_tpml_iframe" class="org-sel-box-iframe" src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=orgid_tpml&amp;nouser=1&amp;moderator=1" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" ></iframe>
              </div>
          </li>
          <li class="dropdown job">
              <input type="hidden" name="jobids[]" value="0" />
              <a href="javascript:;" data-toggle="dropdown" role="button" _job="0"  class="dropdown-toggle btn btn-simple jobid"><span>无</span><b class="caret"></b></a>
                <ul aria-labelledby="drop-job" role="menu" class="dropdown-menu"  ></ul>
          </li>
          <li><a href="javascript:;"  onclick="delDepart(this)" ttitle="删除"><i class="glyphicon glyphicon-remove"></i></a></li>
       </ul>
      </div>
    </div>
    <div class="form-group">
      	<label class="control-label" for="">上司职位</label>
        <div id="upjob" class="controls selorg-container">
        	<ul  class="nav nav-pills">
                 <li class="dropdown org">
                        <input id="sel_uporgid" type="hidden" name="uporgid"  value="0" onchange="selDepart(this)" />
                          <button type="button" id="uporgid_Menu" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                            请选择机构或部门 <span class="caret"></span>
                          </button>
                          <div id="uporgid_dropdown_menu" class="dropdown-menu org-sel-box" role="menu" aria-labelledby="uporgid_Menu">
                               <iframe name="uporgid_iframe" class="org-sel-box-iframe" src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=uporgid&amp;nouser=1" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" ></iframe>
                         </div>
                  </li>
                  <li class="dropdown job">
                  <input type="hidden" name="upjobid"  value="0">
                  <a href="javascript:;" data-toggle="dropdown" role="button" _jobid="0"  class="dropdown-toggle btn btn-simple jobid"><span>无</span><b class="caret"></b></a>
                
                    <ul aria-labelledby="drop-job" role="menu" class="dropdown-menu"> 
                    <li role="presentation"><a href="javascript:;" tabindex="-1" role="menuitem" _jobid="0" onclick="selJob(this)">无</a></li>
                    </ul>
                  </li>
             </ul>
        </div>
      </div>
    <div class="form-group">
      <label class="control-label"></label>
      <div class="controls">
        <input type="button" class="btn btn-success" value="确认添加" onclick="account_submit()">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label class="checkbox-inline">
          <input type="checkbox" name="sendmail" value="1" checked="checked" >
          发送密码到用户邮箱</label>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" reload="1">

var orgsel_html=jQuery('#nav').html();
var lastusername = '', lastpassword = '', lastemail = '', lastinvitecode = '', stmp = new Array(), modifypwd = false;
var pwlength = 0;
var strongpw = new Array();
    var ignoreEmail = false;
   	addMailEvent($('email'));
    checkPwdComplexity($('password'),$('password2'),false);

function account_submit(){

//判断用户名
if($('email').value==''){
$('email').focus();
showmessage('登录邮箱必填','danger',1000,1);
return false;
}
if($('username').value==''){
$('username').focus();
showmessage('姓名必填','danger',1000,1);
return false;
}

if($('password').value==''){
$('password').focus();
showmessage('还没有填写登录密码','danger',1000,1);
return false;
}
if($('password2').value==''){
showmessage('还没有填写确认密码','danger',1000,1);
$('password2').focus();
return false;
}
if($('password').value!=$('password2').value){
showmessage('两次输入的密码不一致','danger',1000,1);
$('password').focus();
return false;
}
var p_chks = $('accountform').getElementsByTagName('kbd');
var flag=0;
for(i = 0;i < p_chks.length;i++){
if(p_chks[i].className == 'p_chk' && p_chks[i].innerHTML != ''){
return false;
}
}
//判定微信号和手机
var phone=$('phone').value;
if(phone!='' && phone.match(/^\d+$/)==null ){
$('phone').focus();
showmessage('手机号码不合法','danger',1000,1);
return false;
}
var weixinid=$('weixinid').value;
if(weixinid!='' && weixinid.match(/^[A-Za-z][\w|-]+$/)==null ){
$('weixinid').focus();
showmessage('微信号不合法','danger',1000,1);
return false;
}

ajaxpost('accountform','ajaxwaitid','return_adduser');
return false;
}
function succeedhandle_adduser(url, message, values) {
var uid=values['uid'];
var orgids=values['orgids'];
showDetail(uid,'user');
var inst = jQuery("#classtree").jstree(true);
inst.refresh(true);
showmessage(message,'success',3000,1);
};
function errorhandle_adduser(msg,values){
showmessage(msg,'success',3000,1);
}


jQuery(document).ready(function(e) {
jQuery('.dropdown-menu li.disabled a').on('click',function(){
return false;
});
});
function randomPass(){
var pass=(Math.round(Math.random()*100000000));
jQuery('#password').val(pass).trigger('blur');
jQuery('#password2').val(pass).trigger('blur');
}
</script> 
