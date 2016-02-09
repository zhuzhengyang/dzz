<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="dzz/connect/images/connect.css?<?php echo VERHASH;?>" rel="stylesheet" media="all"><?php include template('common/header_simple_end'); ?><div class="container" style="height:100%">
  	<div class="main-header clearfix">
        <ul class="nav nav-pills nav-pills-bottomguide">
              <li><a href="<?php echo BASESCRIPT;?>?mod=connect">我的云</a></li>
              <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=connect&op=addcloud">添加云</a></li>
        </ul>
        
    </div>
<div class="main-content clearfix">
    	<div style="padding:15px;">
        <?php if(is_array($cloud)) foreach($cloud as $key => $value) { ?>       	 <h4 ><?php echo $value['header'];?></h4>
            <ul class="thumbnails list-unstyled clearfix">
             <?php if(is_array($value['list'])) foreach($value['list'] as $value1) { ?>                <li  bz="<?php echo $value1['bz'];?>"  data_type="<?php echo $key;?>" class="cloud-item " >
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
 <script type="text/javascript">
 function connect_start(bz,type){//开始云连接
switch(type){
case 'pan':
url='<?php echo DZZSCRIPT;?>?mod=connect&bz='+bz+'&op=oauth';
window.location.href=url;
break;
case 'storage':
url='<?php echo DZZSCRIPT;?>?mod=connect&bz='+bz+'&op=oauth';
window.location.href=url;
break;
case 'ftp':
url='<?php echo DZZSCRIPT;?>?mod=connect&bz='+bz+'&op=oauth';
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



 </script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php include template('common/footer_simple'); ?>