<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="dzz/styles/menu/default/style.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="dzz/connect/images/connect.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="dzz/scripts/_common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
#menu.nav-pills li a {
padding: 5px 10px;
margin: 4px;
border-radius: 3px;
}
</style><?php include template('common/header_simple_end'); ?><div class="container" style="height:100%">
  	<div class="main-header2 clearfix">
        <ul class="nav nav-pills nav-pills-bottomguide pull-left">
              <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=connect">我的云</a></li>
              <li><a href="<?php echo BASESCRIPT;?>?mod=connect&op=addcloud">添加云</a></li>
        </ul>
          <ul id="menu" class="nav nav-pills  list-unstyled pull-right">
            
          </ul>
    </div>
<div class="main-content clearfix">
    	<div class="" style="padding:15px;">
            <ul class="thumbnails list-unstyled ">
            <?php if(is_array($mycloud)) foreach($mycloud as $value) { ?>                <li id="item_<?php echo $value['bz'];?>_<?php echo $value['id'];?>"  bz="<?php echo $value['bz'];?>" cid="<?php echo $value['id'];?>" icoid="<?php echo $value['icoid'];?>" class="cloud-item ">
                   <div class="thumbnail" style="margin:0">
                    <div class="selectbox"></div>
                        <img src="<?php echo $value['img'];?>" width="100" icoid="<?php echo $value['icoid'];?>" />
                        <h5 class="text-center" style="height:20px;line-height:20px;overflow:hidden;margin-bottom:5px"><a icoid="<?php echo $value['icoid'];?>" href="javascript:;" title="<?php echo $value['cloudname'];?>"><?php echo $value['cloudname'];?></a></h5>
                    </div>
                </li>
            <?php } ?>
            </ul>
          
        </div>
    </div>
 </div>
 <div id="right_ico" class="menu " style="display:none;">
    <div class="menu-item" onClick="Open('-icoid-');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-open"></span><span class="menu-text">打开</span></div>
    <div class="menu-item delete" onClick="Delete('-cid-','-bz-');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-delete"></span><span class="menu-text">删除</span></div>
     <div class="menu-item" onClick="Rename('-cid-','-bz-');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-rename"></span><span class="menu-text">重命名</span></div>
    <div class="menu-item" onClick="Todesktop('-icoid-','-bz-');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-desktop"></span><span class="menu-text">添加到桌面</span></div>
</div>
<div id="shadow" style="display:none;position:absolute"></div>
<div id="renameContainer" style="position:absolute;left:-500px;top:-500px;width:161px;height:35px;z-index:100">
<textarea id="rename" bz="" cid="" style="width:100%;height:100%;margin:0"></textarea>
</div>
 <script type="text/javascript">
 
 var json=<?php echo $icosdata_json;?>;
 for(var i in json){
 parent._config.sourcedata.icos[i]=json[i];
 }
  var jsonfolder=<?php echo $folderdata_json;?>;
 for(var i in jsonfolder){
 parent._config.sourcedata.folder[i]=jsonfolder[i];
 }
 var ajaxurl='<?php echo DZZSCRIPT;?>?mod=connect&op=ajax';
 </script>
 <script src="dzz/connect/scripts/mycloud.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php include template('common/footer_simple'); ?>