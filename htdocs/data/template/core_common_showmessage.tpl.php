<?php if(!defined('IN_DZZ')) exit('Access Denied'); if(!$_G['inajax']) { include template('common/header_common'); ?><div id="ct" class="container " style="margin:20px">
<?php if(!$param['login']) { ?>
<div class="well" style="max-width:500px;margin:0 auto">
<?php } else { ?>
<div class="well" id="main_succeed" style="max-width:500px;margin:0 auto;display: none">
<div class="f_c altw">
<div class="alert_right">
<h5 id="succeedmessage"></h5>
<p id="succeedlocation" class="alert_btnleft"></p>
<p class="alert_btnleft"><a id="succeedmessage_href">如果您的浏览器没有自动跳转，请点击此链接</a></p>
</div>
</div>
</div>
<div class="well" id="main_message">
             
<?php } } else { include template('common/header_ajax'); } if($param['msgtype'] == 1 || $param['msgtype'] == 2 && !$_G['inajax']) { ?>
<div class="f_c altw">
<div id="messagetext" class="<?php echo $alerttype;?>">
<h5><?php echo $show_message;?></h5>
<?php if($url_forward) { if(!$param['redirectmsg']) { ?>
<p class="alert_btnleft"><a href="<?php echo $url_forward;?>">如果您的浏览器没有自动跳转，请点击此链接</a></p>
<?php } else { ?>
<p class="alert_btnleft"><a href="<?php echo $url_forward;?>">如果 <?php echo $refreshsecond;?> 秒后下载仍未开始，请点击此链接</a></p>
<?php } } elseif($allowreturn) { ?>
<script type="text/javascript">
if(history.length > (BROWSER.ie ? 0 : 1)) {
document.write('<p class="alert_btnleft"><a href="javascript:history.back()">[ 点击这里返回上一页 ]</a></p>');
} else {
document.write('<p class="alert_btnleft"><a href="./">[ <?php echo $_G['setting']['bbname'];?> 首页 ]</a></p>');
}
</script>
<?php } ?>
</div>
<?php if($param['login']) { } ?>
</div>
<?php } elseif($param['msgtype'] == 2) { ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">提示信息</h4>
        </div>
        <div class="modal-body">
<div class="<?php echo $alerttype;?>"><?php echo $show_message;?></div>
        </div>
<div class="modal-footer">
<?php if($param['closetime']) { ?>
<span class="btn btn-link text-muted"><?php echo $param['closetime'];?> 秒后窗口关闭</span>
<?php } elseif($param['locationtime']) { ?>
<span class="btn btn-link text-muted"><?php echo $param['locationtime'];?> 秒后页面跳转</span>
<?php } if($param['login']) { ?>
<button type="button" class="btn btn-info" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');showWindow('login', 'user.php?mod=logging&action=login');"><strong>登录</strong></button>
<?php if(!$_G['setting']['bbclosed']) { ?>
<button type="button" class="btn btn-info" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');window.open('user.php?mod=rigister');"><em><?php echo $_G['setting']['reglinkname'];?></em></button>
<?php } } ?>
            <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>!close!</strong></button>
</div>
<?php } else { ?><?php echo $show_message;?><?php } if(!$_G['inajax']) { ?>
</div>
</div><?php include template('common/footer'); } else { include template('common/footer_ajax'); } ?>
