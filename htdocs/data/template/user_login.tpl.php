<?php if(!defined('IN_DZZ')) exit('Access Denied'); 
0
|| checktplrefresh('./user/template/login.htm', './core/template/default/common/seccheck.htm', 1453173436, '', './data/template/user_login.tpl.php', './user/template/', 'login')
;?>
<?php if(empty($_GET['inajax'])) { include template('login_single'); ?> 
<?php } else { ?>
<!--[if lt IE 9]>
  <script src="static/js/jquery.placeholder.js" type="text/javascript" type="text/javascript"></script>
<![endif]--><?php $loginhash = 'L'.random(4);?><style>
.form-login .form-group-lg{
margin-bottom:20px;
}
.form-login .form-group-lg .form-control{
padding:10px 16px;
height:46px;
}
#popModal .modal-dialog{
 max-width:350px;
 margin:30px auto;
}
 @media (min-width: 370px){ 
#popModal .modal-dialog{
 margin:20px auto
}
}
 @media (min-width: 768px){ 
#popModal .modal-dialog{
 margin:30px auto
}
}
</style>
    <div id="main_message">
      <div id="layer_login_<?php echo $loginhash;?>" > 
      	 <div class="modal-header">
             <?php if(!empty($_GET['inajax'])) { ?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><?php } ?>
            <h4  class="modal-title text-center" ><span id="returnmessage_<?php echo $loginhash;?>"><?php echo $_G['setting']['sitename'];?><?php if($_G['setting']['bbclosed']>0) { ?> - 网站关闭中<?php } ?> </span></h4>
         </div>
          <div class="modal-body" style="font-size:14px;padding:30px 30px 20px 30px;">
            <form method="post"  name="login " id="loginform_<?php echo $loginhash;?>" class="form-login"   role="form" onsubmit="<?php if($this->setting['pwdsafety']) { ?>pwmd5('password3_<?php echo $loginhash;?>');<?php } ?>pwdclear = 1; ajaxpost('loginform_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>');return false;"  action="user.php?mod=logging&amp;action=login&amp;loginsubmit=yes<?php if(!empty($_GET['handlekey'])) { ?>&amp;handlekey=<?php echo $_GET['handlekey'];?><?php } if(isset($_GET['frommessage'])) { ?>&amp;frommessage<?php } ?>&amp;loginhash=<?php echo $loginhash;?>">
              <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
              <input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
              <?php if($auth) { ?>
              <input type="hidden" name="auth" value="<?php echo $auth;?>" />
              <?php } ?> 
              
              <?php if($invite) { ?>
              <div class="form-group form-group-lg"> 
                 推荐人<a href="user.php?mod=space&amp;uid=<?php echo $invite['uid'];?>" target="_blank"><?php echo $invite['username'];?></a>
              </div>
              <?php } ?> 
              
              <?php if(!$auth) { ?>
              <div class="form-group form-group-lg">
                  <input type="text" class="form-control" id="email_<?php echo $loginhash;?>" placeholder="邮箱或用户名" name="email"  autocomplete="off"  >
               
              </div>
              <div class="form-group form-group-lg">
                  <input type="password"  class="form-control " id="password3_<?php echo $loginhash;?>" placeholder="登录密码" name="password" onfocus="clearpwd()" autocomplete="off"  >
              </div>
              
              <?php } ?> 
              
              <?php if(empty($_GET['auth']) || $questionexist) { ?>
              
              <div id="loginanswer_row_<?php echo $loginhash;?>" class="form-group form-group-lg" <?php if(!$questionexist) { ?> style="display:none"<?php } ?>>
                  <input type="text" class="form-control"  name="answer" id="loginanswer_<?php echo $loginhash;?>" autocomplete="off"  />
              </div>
              <div class="form-group form-group-lg" >
                <label class="checlbox checkbox-inline"><input type="checkbox"  name="cookietime" id="cookietime_<?php echo $loginhash;?>"  value="2592000" <?php echo $cookietimecheck;?> /> 30天内自动登录</label>
                <a class="pull-right" tabindex="-1" href="javascript:;" onclick="<?php if(!empty($_GET['inajax'])) { ?>_login.logging('user.php?mod=lostpasswd&inajax=1')<?php } else { ?>jQuery('#popModal .modal-dialog').load('user.php?mod=lostpasswd&inajax=1')<?php } ?>;return false">找回密码</a>
               </div>
              <?php } ?> 
              
              <?php if($secqaacheck || $seccodecheck) { ?> 
              <?php
$sectpl = <<<EOF

              <sec>
              <sec>
              <sec>
              
EOF;
?>
              <div class="form-group" style="margin-bottom:20px;"> 
                  <?php $_G['sechashi'] = !empty($_G['cookie']['sechashi']) ? $_G['sechash'] + 1 : 0;
$sechash = 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'].$_G['sechashi'];
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex;?><?php
$__STATICURL = STATICURL;$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($secqaacheck) { 
$seccheckhtml .= <<<EOF

    		<div class="clearfix" style="padding:0">
           		 <input name="secanswer" class="form-control"  style="width:100px;float:left" id="secqaaverify_{$sechash}" type="text" autocomplete="off" style="width:100px"  onblur="checksec('qaa', '{$sechash}')"  />
            &nbsp; &nbsp;<a href="javascript:;" onclick="updatesecqaa('{$sechash}');doane(event);" >换一个</a>
                <span id="checksecqaaverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
            </div>
            <div style="padding:5px 0">
                {$sectplqaa['2']}<span id="secqaa_{$sechash}"></span>
                
EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updatesecqaa('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

                {$sectplqaa['3']}
            </div>
       

EOF;
 } 
$seccheckhtml .= <<<EOF

   

EOF;
 if($seccodecheck) { 
$seccheckhtml .= <<<EOF

    			<div class="clearfix" style="padding:0">
                  <input name="seccodeverify" class="form-control"  style="width:100px;float:left"  id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="
EOF;
 if($_G['setting']['seccodedata']['type'] != 1) { 
$seccheckhtml .= <<<EOF
ime-mode:disabled;
EOF;
 } 
$seccheckhtml .= <<<EOF
"  onblur="checksec('code', '{$sechash}')"  />
                  &nbsp;&nbsp;<a tabindex="-1" href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="btn btn-link">换一个</a>
                  <span id="checkseccodeverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
                </div> 
                <div  style="padding:5px 0">
                {$sectplcode['2']}<span id="seccode_{$sechash}"></span>
                
EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

                {$sectplcode['3']}
                </div>
             


EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow);?><?php if(empty($secreturn)) { ?><?php echo $seccheckhtml;?><?php } ?> 
              </div>
              <?php } ?>
               
              <div class="form-group form-group-lg" >
                  <button class="btn btn-primary btn-block"  type="submit" name="loginsubmit" value="true" ><strong style="line-height:30px;">登&nbsp;&nbsp;&nbsp;录</strong></button>
                 <!-- <?php if(!$this->setting['bbclosed'] && !empty($_GET['inajax'])) { ?><a class="btn btn-link" href="javascript:;" onclick="ajaxget('user.php?mod=clearcookies&formhash=<?php echo FORMHASH;?>', 'returnmessage1_<?php echo $loginhash;?>', 'returnmessage1_<?php echo $loginhash;?>');return false;" title="清除痕迹" class="pull-right"> <span id="returnmessage1_<?php echo $loginhash;?>" class="text-muted ">清除痕迹</span></a><?php } ?> -->
              </div>
              <?php if($_G['setting']['regstatus']>0) { ?>
              <div class="form-group last" style="margin-bottom:0" >
                	还没有帐号？&nbsp;<a  class="" tabindex="-1" href="user.php?mod=register"  <?php if(!empty($_GET['inajax'])) { ?>onclick="_login.register();return false;"<?php } ?>  title="<?php echo $_G['setting']['reglinkname'];?>"><?php echo $_G['setting']['reglinkname'];?></a>
              </div>
              <?php } ?>
            </form>
          </div>
          <?php if($_G['setting']['pwdsafety']) { ?> 
          <script src="<?php echo $_G['setting']['jspath'];?>md5.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script> 
          <?php } ?>
      </div>

      
    </div>
        <div class="nfl" id="main_succeed" style="display: none">
            <div class="modal-body">
              <div class="alert_right">
                <div id="succeedmessage"></div>
                <div id="succeedlocation" class="alert_btnleft"></div>
                <p class="alert_btnleft"><a id="succeedmessage_href">如果您的浏览器没有自动跳转，请点击此链接</a></p>
              </div>
            </div>
        </div>
    	<div id="layer_message_<?php echo $loginhash;?>" style="display: none;">
            <div class="modal-header">
                 <?php if(!empty($_GET['inajax'])) { ?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><?php } ?>
                <h4  class="modal-title" ><span id="returnmessage_<?php echo $loginhash;?>"> 用户登录</span></h4>
            </div>
          <div  class="modal-body">
            <div class="alert_right">
              <div id="messageleft_<?php echo $loginhash;?>"></div>
              <p class="alert_btnleft" id="messageright_<?php echo $loginhash;?>"></p>
            </div>
          </div>
   	 </div>
    <script type="text/javascript" reload="1">
var pwdclear = 1;
function initinput_login() {
document.body.focus();
<?php if(!$auth) { ?>
if($('loginform_<?php echo $loginhash;?>')) {
$('loginform_<?php echo $loginhash;?>').email.focus();
}
<?php } ?>
}
initinput_login();
function clearpwd() {
if(pwdclear) {
$('password3_<?php echo $loginhash;?>').value = '';
}
pwdclear = 0;
}
jQuery(document).ready(function(e) {
if(jQuery('.ie8,.ie9').length){ //ie8模拟placeholder;
jQuery(':input[placeholder]').each(function(){
jQuery(this).placeholder();
});
}
});
</script> 

<?php } ?> 
