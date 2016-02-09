<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="dzz/connect/images/connect.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" type="text/javascript"></script>
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

</style><?php include template('common/header_simple_end'); ?><div class="bs-container clearfix">
  <div class="bs-left-container  clearfix">
    <?php include template('left'); ?> 
  </div>
  <div class="left-drager">
     <div class="left-drager-op"><div class="left-drager-sub"></div></div>
  </div>
  <div class="bs-main-container  clearfix">
  	<div class="main-header clearfix">
        <ul class="nav nav-pills nav-pills-bottomguide">
        <li ><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=dzz"> 设置</a></li>
        <li ><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=space">空间管理</a></li>
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=spaceadd">添加存储位置</a></li>
      </ul>
        
    </div>
<div class="main-content clearfix"  style="border-top:1px solid #FFF">
    	<div style="padding:15px;">
        <?php if(is_array($list)) foreach($list as $key => $value) { ?>       	 <h4 ><?php echo $value['header'];?></h4>
            <ul class="thumbnails list-unstyled clearfix">
             <?php if(is_array($value['list'])) foreach($value['list'] as $value1) { ?>                <li  bz="<?php echo $value1['bz'];?>"  data_type="<?php echo $key;?>" class="cloud-item span2" >
                    <div class="thumbnail">
                        <img src="dzz/images/default/system/<?php echo $value1['bz'];?>.png" width="100" />
                        <h5 class="text-center" style="height:20px;line-height:20px;overflow:hidden;margin-bottom:5px"><?php echo $value1['name'];?></h5>
                    </div>
                </li>
            <?php } ?>
            </ul>
          <?php } ?>
        </div>
    </div>
 </div>
</div>
 <script type="text/javascript">
 jQuery('.left-drager').leftDrager_layout();
 function connect_start(bz,type){//开始云连接
switch(type){
case 'pan':
url='<?php echo ADMINSCRIPT;?>?mod=cloud&bz='+bz+'&op=oauth';
window.location.href=url;
break;
case 'storage':
url='<?php echo ADMINSCRIPT;?>?mod=cloud&bz='+bz+'&op=oauth';
window.location.href=url;
break;
case 'ftp':
url='<?php echo ADMINSCRIPT;?>?mod=cloud&bz='+bz+'&op=oauth';
window.location.href=url;
break;
}
}
jQuery(document).ready(function(e) {
     jQuery('.thumbnails li').mouseenter(function(){
jQuery(this).addClass('hover');
}).mouseleave(function(){
jQuery(this).removeClass('hover');
}).click(function(){
var bz=jQuery(this).attr('bz');
var type=jQuery(this).attr('data_type');
connect_start(bz,type);
});
jQuery(document).mousedown(function(){
jQuery('.thumbnails li').removeClass('Selected');
});
});


 </script><?php include template('common/footer_simple'); ?>