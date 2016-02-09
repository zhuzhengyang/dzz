<?php if(!defined('IN_DZZ')) exit('Access Denied'); if(empty($_GET['inajax'])) { include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<style>
body{background:rgb(58, 110, 165);}
</style><?php include template('common/header_simple_end'); ?><div class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:block;" >
<div class="modal-dialog" style="font-size:14px;">
        <div class="modal-content" >

<?php } $loginhash = 'L'.random(4);?><!--[if lt IE 9]>
  <script src="static/js/jquery.placeholder.js" type="text/javascript" type="text/javascript"></script>
<![endif]-->
      <div id="lostpw_container_<?php echo $loginhash;?>">
      	<div class="modal-header">
             <?php if(!empty($_GET['inajax'])) { ?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><?php } ?>
            <h4  class="modal-title"><span id="returnmessage3_<?php echo $loginhash;?>">找回密码</span></h4>
         </div>
         <div class="modal-body" style="line-height:30px;">
           <form method="post" autocomplete="off" id="lostpwform_<?php echo $loginhash;?>" class="form-horizontal " role="form"  onsubmit="ajaxpost('lostpwform_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>');return false;" action="user.php?mod=lostpasswd">
              <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
               <input type="hidden" name="lostpwsubmit" value="true" />
               <input type="hidden" name="handlekey" value="lostpw_<?php echo $loginhash;?>" />
              <div class="form-group" >
                <label class="control-label col-sm-3" for="lostpw_email">登录邮箱</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="email" id="lostpw_email"  value=""  placeholder="填写您的登录邮箱" />
                </div>
              </div>
              <div class="form-group" >
                <label class="control-label col-sm-3" for="lostpw_username">真实姓名</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control"  name="username" id="lostpw_username"  value=""  placeholder="填写注册时使用的姓名"  />
                </div>
              </div>
              <div class="form-group last" >
                <div class="col-sm-3"></div>
                <div class="col-sm-8">
                  <button class="btn btn-primary"  type="submit"  name="lostpwsubmit" value="true" ><strong>提交</strong></button>
                  &nbsp;&nbsp;&nbsp;<a class="btn btn-default" href="user.php?mod=logging"  onclick="try{_login.logging();return false}catch(e){return true}" title="返回登录">返回登录</a>
                </div>
              </div>
            </form>
      	 </div>
        <div class="modal-footer" style="display:none;">
        	<button type="button" class="btn btn-primary toMail" >现在去邮箱</button>
            <button type="button" class="btn btn-default toIndex" onclick="location.href='<?php echo $_G['siteurl'];?>'">回到首页</button>
        </div>
      </div>
 <script type="text/javascript">
 	jQuery('#lostpw_email').focus();
function succeedhandle_lostpw_<?php echo $loginhash;?>(url, message, values) {
var el=jQuery('#lostpw_container_<?php echo $loginhash;?>');
var mail='http://mail.'+values['email'].split('@')[1];

el.find('.modal-title').html('密码找回邮件发送成功');
el.find('.modal-body').html(message);
el.find('.modal-footer .toMail').on('click',function(){
window.location.href=mail;
})
el.find('.modal-footer').show();
};
jQuery(document).ready(function(e) {
        if(jQuery('.ie8').length){ //ie8模拟placeholder;
jQuery(':input[placeholder]').each(function(){
jQuery(this).placeholder();
});
}
    });
 </script>
 <?php if(empty($_GET['inajax'])) { ?>
 </div>
 </div>
</div>
<script type="text/javascript">
jQuery('body').addClass('modal-open');
</script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php include template('common/footer'); } ?>