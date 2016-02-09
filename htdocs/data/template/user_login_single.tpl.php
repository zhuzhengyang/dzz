<?php if(!defined('IN_DZZ')) exit('Access Denied'); 
0
|| checktplrefresh('./user/template/login_single.htm', './core/template/default/common/seccheck.htm', 1453173436, '', './data/template/user_login_single.tpl.php', './user/template/', 'login_single')
;?><?php include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<!--[if lt IE 9]>
  <script src="static/js/jquery.placeholder.js" type="text/javascript" type="text/javascript"></script>
<![endif]-->
<style>
html body {
overflow: hidden
}
.mainContainer{
overflow-x:hidden;
overflow-y:auto;
position:relative;
z-index:10;
background:url(dzz/images/b.gif);
}

.modal-content {
position: absolute;
width: auto;
margin: 10px;
left: 0;
top: 0;
right: 0;
z-index: 900;
text-shadow: 1px 1px 1px #FFF;
background-color: RGBA(255,255,255,0.9);

}
.ie8 .modal-content {
width: 350px;
margin: 10px;
position: absolute;
right: 80px;
top: 80px;
z-index: 900;
left: auto;
background-color: RGBA(255,255,255,0.9);
}

@media (min-width: 400px) {
.modal-content{
width: 350px;
position: absolute;
right: 80px;
top: 80px;
z-index: 900;
left: auto;
background-color: RGBA(255,255,255,0.9);
}
}
@media (min-width: 768px) {
.modal-content {
width: 350px;
margin: 0;
position: absolute;
top: 80px;
right: 80px;
left: auto;
z-index: 900;
background-color: RGBA(255,255,255,0.9);
}
}
.form-login .form-group-lg {
margin-bottom: 20px;
}
.form-login .form-group-lg .form-control {
padding: 10px 16px;
height: 46px;
}

.siteinfo{
padding:50px 20px 20px 50px;
opacity: 0.9;
font-weight: 700;
text-shadow: 1px 1px 1px #000;
color: #FFF;
}
.siteinfo-title {
font-size: 40px;
padding-bottom:20px;
}
.siteinfo-subtitle {
font-size: 30px;
padding-bottom:20px;
}
</style>
<script src="dzz/scripts/imgReady.js" type="text/javascript"></script><?php include template('common/header_simple_end'); $loginhash = 'L'.random(4);?><!--背景层-->
<div id="wrapper_div" style="width: 100%;height:100%;  position: absolute; top: 0px; left: 0px; margin: 0px; padding: 0px; overflow: hidden;z-index:-1;  font-size: 0px; background:<?php echo $_G['setting']['loginset']['bcolor'];?>;"> 
<?php if($_G['setting']['loginset']['img']) { ?><img src="<?php echo $_G['setting']['loginset']['img'];?>" name="imgbg" id="imgbg" style="right: 0px; bottom: 0px; top: 0px; left: 0px; z-index: 10;margin:0;padding:0;overflow:hidden; position: absolute;width:100%;height:100%" height="100%" width="100%"><?php } ?>
  <?php if($_G['setting']['loginset']['url']) { ?><iframe id="wrapper_frame" name="wrapper_frame" src="<?php echo $_G['setting']['loginset']['url'];?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" style="z-index:20;position:absolute;width:100%;height:100%;background:url(dzz/images/b.gif);"></iframe><?php } ?>
</div>
<div class="mainContainer clearfix" >
<!--文字层-->
    <div class="siteinfo">
        <div class="siteinfo-title"> <?php echo $_G['setting']['loginset']['title'];?> </div>
        <div class="siteinfo-subtitle"> <?php echo $_G['setting']['loginset']['subtitle'];?> </div>
    </div>

<div class="modal-content" >
<div id="main_message">
  <div id="layer_login_<?php echo $loginhash;?>" >
    <div class="modal-header" style="border-bottom:1px solid #DDD;" >
      <h4  class="modal-title text-center" ><span id="returnmessage_<?php echo $loginhash;?>">登录平台<?php if($_G['setting']['bbclosed']>0) { ?> - 网站关闭中<?php } ?> </span></h4>
    </div>
    <div class="modal-body" style="font-size:14px;padding:30px 30px 20px 30px;">
      <form method="post"  name="login " id="loginform_<?php echo $loginhash;?>" class="form-login"   role="form" onsubmit="<?php if($this->setting['pwdsafety']) { ?>pwmd5('password3_<?php echo $loginhash;?>');<?php } ?>pwdclear = 1; ajaxpost('loginform_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>');return false;"  action="user.php?mod=logging&amp;action=login&amp;loginsubmit=yes<?php if(!empty($_GET['handlekey'])) { ?>&amp;handlekey=<?php echo $_GET['handlekey'];?><?php } if(isset($_GET['frommessage'])) { ?>&amp;frommessage<?php } ?>&amp;loginhash=<?php echo $loginhash;?>">
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
        <?php if($auth) { ?>
        <input type="hidden" name="auth" value="<?php echo $auth;?>" />
        <?php } else { ?> 
        <div class="form-group form-group-lg">
          <input type="text" class="form-control" id="email_<?php echo $loginhash;?>" placeholder="邮箱或用户名" name="email"  autocomplete="off"  >
        </div>
        <div class="form-group form-group-lg">
          <input type="password"  class="form-control " id="password3_<?php echo $loginhash;?>" placeholder="登录密码" name="password" onfocus="clearpwd()" autocomplete="off"  >
        </div>
        <?php } ?> 
        
       
        <div class="form-group form-group-lg" >
          <label class="checlbox checkbox-inline">
            <input type="checkbox"  name="cookietime" id="cookietime_<?php echo $loginhash;?>"  value="2592000" <?php echo $cookietimecheck;?> />
            30天内自动登录</label>
          <a class="pull-right" tabindex="-1" href="user.php?mod=lostpasswd">找回密码</a> </div>
        
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
          <!-- <?php if(!$this->setting['bbclosed'] && !empty($_GET['inajax'])) { ?><a class="btn btn-link" href="javascript:;" onclick="ajaxget('user.php?mod=clearcookies&formhash=<?php echo FORMHASH;?>', 'returnmessage1_<?php echo $loginhash;?>', 'returnmessage1_<?php echo $loginhash;?>');return false;" title="清除痕迹" class="pull-right"> <span id="returnmessage1_<?php echo $loginhash;?>" class="text-muted ">清除痕迹</span></a><?php } ?> --> </div>
        <?php if($_G['setting']['regstatus']>0) { ?>
        <div class="form-group last" style="margin-bottom:0" > 还没有帐号？&nbsp;<a  class="" tabindex="-1" href="user.php?mod=register"  <?php if(!empty($_GET['inajax'])) { ?>onclick="_login.register();return false;"<?php } ?> title="<?php echo $_G['setting']['reglinkname'];?>"><?php echo $_G['setting']['reglinkname'];?></a> </div>
        <?php } ?>
      </form>
    </div>
    <?php if($_G['setting']['pwdsafety']) { ?> 
    <script src="dzz/scripts/md5.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script> 
    <?php } ?> 
  </div>
  
</div>
<div class="nfl" id="main_succeed" style="display: none">
        <div class="modal-body">
          <div class="alert_right">
            <div id="succeedmessage"></div>
            <div id="succeedlocation" class="alert_btnleft"></div>
            <p class="alert_btnleft"><a id="succeedmessage_href" href="javascript:;">如果您的浏览器没有自动跳转，请点击此链接</a></p>
          </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
var clientHeight,clientWidth;
var width,height;
function setHeightCenter(flag){
clientWidth=document.documentElement.clientWidth;
clientHeight=document.documentElement.clientHeight;
var modalHeight=jQuery('.modal-content').outerHeight(true);
jQuery('.mainContainer').css('height',clientHeight);
if(jQuery('.ie8').length){
if(clientWidth<430){
jQuery('.modal-content').css({'top':0,'width':'auto','margin':'10px','left':0,'right':0});
}else if(clientWidth<768){
jQuery('.modal-content').css({'top':'80px','width':'350px','margin':'0','left':'auto','right':'80px'});
}else{
jQuery('.modal-content').css({'top':'80px','width':'350px','margin':'0','left':'auto','right':'80px'});
}
}
var top=(clientHeight-modalHeight)/2;
if(top>100) top=100;

if(top>10) jQuery('.modal-content').css('top',top);
else jQuery('.modal-content').css('top',10);
}
var pwdclear = 1;
function initinput_login() {
document.body.focus();
<?php if(!$auth) { ?>
if($('loginform_<?php echo $loginhash;?>')) {
$('loginform_<?php echo $loginhash;?>').email.focus();
}
<?php } ?>
}

function clearpwd() {
if(pwdclear) {
$('password3_<?php echo $loginhash;?>').value = '';
}
pwdclear = 0;
}
function setImage(){
clientWidth=document.documentElement.clientWidth;
clientHeight=document.documentElement.clientHeight;
var r0=clientWidth/clientHeight;
var r1=width/height;
if(r0>r1){//width充满
w=clientWidth;
h=w*(height/width);
}else{
h=clientHeight;
w=h*(width/height);
}
document.getElementById('imgbg').style.width=w+'px';
document.getElementById('imgbg').style.height=h+'px';
}
var Timer=null;
window.onresize=function(){
if(Timer) window.clearTimeout(Timer);
Timer=window.setTimeout(function(){setHeightCenter();setImage();},50);
}


jQuery(document).ready(function(e) {
    setHeightCenter(true);
initinput_login();
if($('imgbg')){
imgReady($('imgbg').src, function () {
width=this.width; 
height=this.height;
});
}
if(jQuery('.ie8,.ie9').length){ //ie8模拟placeholder;
jQuery(':input[placeholder]').each(function(){
jQuery(this).placeholder();
});
}
});

</script> 
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script> <?php include template('common/footer'); ?>