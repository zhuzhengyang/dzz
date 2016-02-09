<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('header_common'); ?><script type="text/javascript">
//if(window != top){top.window.onbeforeunload=null;top.location = location;};

//设置参数
try{
_config.opens='<?php echo $_GET['open'];?>';
_config.sitename='<?php echo $sitename;?>';
_config.self='<?php echo $space['self'];?>';
_config.gid=0;
_config.myuid=parseInt('<?php echo $_G['uid'];?>');
_config.myusername="<?php echo $_G['username'];?>";
_config.uid='<?php echo $uid;?>';
_config.leavealert=parseInt('<?php echo $_G['setting']['leavealert'];?>');
_config.ajaxurl="<?php echo DZZSCRIPT;?>?mod=system&op=ajax";
_config.systemurl="<?php echo DZZSCRIPT;?>?mod=system";
_config.saveurl="<?php echo DZZSCRIPT;?>?mod=system&op=save";
_config.dataurl="<?php echo DZZSCRIPT;?>?mod=system&op=json";
_config.marketurl='<?php echo DZZSCRIPT;?>?mod=market';
_config.systhameurl='<?php echo DZZSCRIPT;?>?mod=thame';
_config.loginurl='user.php?mod=logging&action=login';
_config.logouturl='user.php?mod=logging&action=logout';
_config.registerurl='user.php?mod=register';
_config.thame=<?php echo $thamejson;?> || {};
_config.formhash='<?php echo $_G['formhash'];?>';
_config.screenWidth=Math.max(document.documentElement.clientWidth, document.body.clientWidth);
_config.screenHeight= _config.getWindowHeight();
}catch(e){}
function notice_image_resize(obj){
var w=obj.width;
var h=obj.height;
var ml=0;
var mt=0;
if(w<80 || h<80){
jQuery(obj).css({'max-height':80,'max-width':80});
}else{
if(w>h){
ml=-(w/h*80-80)/2;
jQuery(obj).css({'max-width':'auto','height':80,'margin-left':ml});
}else{
mt=-(h/w*80-80)/2;
jQuery(obj).css({'max-width':'auto','width':80,'margin-top':mt});
}
}
}
</script>
<div id="videocss_loaded" class="videocss_loaded_flag" style="z-index:-9999999;position:absolute;" ></div>
<div id="usercss_loaded" class="usercss_loaded_flag" style="z-index:-9999999;position:absolute;" ></div>
<div id="popModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="popModal_title" class="modal-title" id="myModalLabel">正在加载，请稍候...</h4>
          </div>
          <div id="popModal_body" class="modal-body">
            	 <table   height="100%" width="100%"><tbody><tr><td align="center" valign="middle"><div class="loading_img"><div class="loading_process"></div></div></td></tr></tbody></table>
          </div>
          <div id="popModal_footer" class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
<iframe id="hideframe" name="hideframe" src="about:blank" frameBorder="0" marginHeight="0" marginWidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>
<div id="_blank"  unselectable="on" onselectstart="return event.srcElement.type== 'text';" style="display:none; background: url(dzz/images/b.gif); z-index:10000;width:100%;height:100%;margin:0;padding:0; right: 0px; bottom: 0px;position: absolute; top:0px; left: 0px;"></div>

<div id="MsgContainer"  unselectable="on" onselectstart="return event.srcElement.type== 'text';" style="display:none; background: url(dzz/images/b.gif); z-index:10001;width:100%;height:100%;margin:0;padding:0; right: 0px; bottom: 0px;position: absolute; top:0px; left: 0px;"></div>

<div id="input_" style="position:relative;word-wrap: break-all; word-break: normal;display:none; background:'' "></div>
<div id="loading_info" style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;margin:0;padding:0;overflow:hidden; z-index: 11000;background:transparent;">
   <table   height="100%" width="100%"><tbody><tr><td align="center" valign="middle"><div class="loading_img"><div class="loading_process"></div></div></td></tr></tbody></table>
</div>


<div id="wrapper_div" style=" width:100%; height:100%;right: 0px; bottom: 0px;position: absolute; top: 0px; left: 0px;margin:0;padding:0;overflow:hidden;  z-index:-9999; background:rgb(58, 110, 165);font-size:0px;">
    <img src="dzz/images/b.gif" name="imgbg" id="imgbg" style="right: 0px; bottom: 0px; top: 0px; left: 0px; z-index: -1;margin:0;padding:0;overflow:hidden; position: absolute;width:100%;height:100%" height="100%" width="100%">
    <iframe id="wrapper_frame" name="wrapper_frame" src="about:blank" frameBorder="0" marginHeight="0" marginWidth="0" width="0" height="0" allowtransparency="true"></iframe>
    <a id="hidebackground_button" title="显示桌面" href="javascript:;" onclick="_login.showBackground();" style="display:none" ></a>
</div>
<div id="body_container" style="position:absolute;margin:0;padding:0;overflow:hidden">
  <div id="_body" style="position:absolute;margin:0;padding:0;overflow:hidden"><div id="pop_upload_Container" class="pop-upload-container"></div></div>
 <div class="taskbar" id="taskbar" unselectable="on" onselectstart="return event.srcElement.type== 'text';" style="position:absolute;margin:0;padding:0;">
     <div class="taskbar-guide-logging" ></div>
<div id="taskbar_back" class="taskbar-back"></div>
     <div id="taskbar_start" class="taskbar-sub taskbar-start" data-toggle="tooltip" data-original-title="开始">
     	<img src="dzz/images/default/start.png" style="width:32px;height:32px; margin:4px" />
        <div class="gb_I"></div>
        <div class="gb_H"></div>
        <div class="tips"></div>
      </div>
     <div id="taskbar_spacer_start" class="taskbar-spacer taskbar-spacer-start "></div>
     <div id="taskbar_dock" class="taskbar-sub taskbar-dock" ><div id="taskbar_dock_inner"></div> </div>
     <div id="taskbar_spacer_tray" class="taskbar-spacer taskbar-spacer-tray "></div>
     <div id="taskbar_tray" class="taskbar-sub taskbar-tray">
     	<a id="tray_notification" class="taskbar-tray-item taskbar-tray-notification" title="通知">
       		<div class="gb_I"></div>
             <div class="gb_H"></div>
        </a>
        <a id="tray_copyright" class="taskbar-tray-item taskbar-tray-copyright" title="版权">
        	<div class="gb_I"></div>
            <div class="gb_H"></div>
        </a>
        <a id="tray_showdesktop" class="taskbar-tray-item taskbar-tray-showdesktop btn btn-primary btn-xs" title="显示桌面"></a>
     </div>
</div>
 <div id="startmenu" class="startmenu fade in " >        	
 	<div id="startmenu_back"></div>

    <div id="startmenu_title" class="startmenu-title clearfix">
    	<div class=" startmenu-title-item avatar"><img src="avatar.php?uid=<?php echo $_G['uid'];?>" /></div>
        <div class="startmenu-title-item username"><a href="javascript:;" onclick="_login.configWindow('profile');jQuery('#startmenu').hide();return false;"><?php echo $_G['username'];?></a></div>
        <div class="startmenu-title-item logout">
            <?php if($_G['uid']) { ?>
          	 <a href="javascript:;" onclick="_login.click('logout');jQuery('#startmenu').hide();return false" class=" exit">退出</a>
            <?php } else { ?>
            <a href="javascript:;" onclick="_login.logging();jQuery('#startmenu').hide();return false" class=" logon">登 录</a>
            <?php if($_G['setting']['regstatus']>0) { ?><a href="javascript:;" onclick="_login.register();jQuery('#startmenu').hide();return false" class=" register"><?php echo $_G['setting']['reglinkname'];?></a> <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div  class="startmenu-appContainer" id="startmenu_appContainer">
    	<div id="startmenu_app" class="startmenu-app clearfix" unselectable="on" onselectstart="return false;">
        </div>
    </div>
    <!--<div id="startmenu_page" class="startmenu-page"></div>-->
    <!--<div id="startmenu_search" class="startmenu-bottom"> 
       <input id="searchInput" type="text" placeholder="搜索应用" >
    </div>-->
 </div>  
  <div id="noticeContainer" class="noticeContainer fade in " >
    <div id="noticeContainer_title" class="noticeContainer-title clearfix">
        <div class="pull-left noticeContainer-title-item left"><span id="filter_return" class="">通知</span></div>
        <div class="pull-right noticeContainer-title-item right">
          	<a id="notice_mute" class="mute" title="免打扰模式">免打扰</a>
            <a id="notice_clear" class="clear " title="全部清除">全部清除</a>
            <a id="notice_filter" class="filter" title="通知过滤设置">设置</a>
        </div>
    </div>
    <div  class="noticeContainer-body" id="noticeContainer_body">
    	<div class="noticelist" id="noticelist">
           
        </div>
    </div>
    <div  class="noticeContainer-filter" id="noticeContainer_filter">
    	<div class="title">设置</div>
        <div class="subtitle">允许以下来源的通知：</div>
    	<div class="filterlist" id="filterlist">
        	<div class="filter-item clearfix">
            	<div class="appsel"><input type="checkbox" value="1" checked  /></div>
                <div class="appinfo">
               	 <span class="appico"><img class="img_16_16" src="avatar.php?uid=1&amp;size=middle" /></span><span class="appname">22222</span>
                </div>
            </div>
            <div class="filter-item clearfix">
            	<div class="appsel"><input type="checkbox" value="1" checked  /></div>
                <div class="appinfo">
               	 <span class="appico"><img class="img_16_16" src="avatar.php?uid=1&amp;size=middle" /></span><span class="appname">dkfjalsdfjasdflsad</span>
                </div>
            </div>
            <div class="filter-item clearfix">
            	<div class="appsel"><input type="checkbox" value="1" checked  /></div>
                <div class="appinfo">
               	 <span class="appico"><img class="img_16_16" src="avatar.php?uid=1&amp;size=middle" /></span><span class="appname">dkfjalsdfjasdflsad</span>
                </div>
            </div>
        </div>
    </div>
  
 </div>   

 
   	
  <div id="start_menu" class="menu" style="display:none;" >
         	<div class="menu-item open" onClick="_start.Open('_appid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-icon icon-open"></span><span class="menu-text">打开</span></div>
            <div class="menu-item uninstall" onClick="_start.Operation('_appid','uninstall');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-icon icon-realdel"></span><span class="menu-text">卸载</span></div>
            <div class="menu-item todesktop" onClick="_start.Operation('_appid','todesktop');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-icon icon-todesktop icon-star_1"></span><span class="menu-text">添加到桌面</span></div>
           <div class="menu-item todock" onClick="_start.Operation('_appid','todock');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-icon icon-todock"></span><span class="menu-text">添加到任务栏</span></div>
        </div>
 <div id="upload_progress" style="position:absolute;right:10px;bottom:10px;z-index:9999999;width:300px;display:none">
<div class="alert alert-info ">
    	<button type="button" class="close"  onclick="jQuery('#upload_progress').hide();">&times;</button>
    	<h5 class="progress-title"></h5>
        <div  class="progress progress-striped active" style="margin-bottom:15px;">
            <div class="progress-bar" style="width:0%;"></div>
        </div>
    </div>
</div>
<div id="pop_noticeContainer" class="pop_noticeContainer fade in" ></div>

</div>
<div id="copyrightmenu" class="copyrightmenu fade in" >
  	 <div class="sitecopyright"><?php echo $_G['setting']['sitecopyright'];?></div>
     <div class="dzzcopyright">Powered By <a href="http://www.dzzoffice.com" target="_blank">DzzOffice</a>&nbsp;<?php echo CORE_VERSION;?></div>
  </div> 		

<div id="right_img" class="menu" style="display:none;">
          	<div class="menu-item"><span class="menu-icon icon-wallpaper"></span><span class="menu-text">设为壁纸</span><span class="menu-rightarrow"></span>
 	<div class=" menu " style="display:none">
<div class="menu-item" onClick="_config.setback('_imgurl',1,'','backimg');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-text">拉伸</span></div>
<div class="menu-item" onClick="_config.setback('_imgurl',2,'','backimg');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-text">平铺</span></div>
<div class="menu-item" onClick="_config.setback('_imgurl',3,'','backimg');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-text">居中</span></div>

</div>
</div>
        </div>

        <div id="right_ico" class="menu" style="display:none;">
 <!--<div class="menu-item restore" onClick="_ico.Restore('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-restore"></span><span class="menu-text">还原</span></div>-->
            <div class="menu-item open" onClick="_ico.Open('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-open"></span><span class="menu-text">打开</span></div>
             <div class="menu-item openwith"><span class="menu-icon icon-openwith"></span><span class="menu-text">打开方式</span></div>
             <div class="menu-item shortcut" onClick="_ico.ShortCut('icoid__icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-desktop"></span><span class="menu-text">创建桌面快捷方式</span></div>
             
<div class="menu-item cut" onClick="_select.Cut('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-cut"></span><span class="menu-text">剪切</span></div>
<div class="menu-item copy" onClick="_select.Copy('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-copy"></span><span class="menu-text">复制</span></div>

           
<div class="menu-item rename" onClick="_ico.Rename('_icoid','_filemanageid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-rename"></span><span class="menu-text">重命名</span></div>


<div class="menu-item download" onClick="_ico.downAttach('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-icon icon-download"></span><span class="menu-text">下载</span></div>

            <div class="menu-item share" onClick="_ico.Share('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-icon icon-share"></span><span class="menu-text">分享</span></div>


<div class="menu-item setwallpaper"><span class="menu-icon icon-wallpaper" ></span><span class="menu-text">设为壁纸</span><span class="menu-rightarrow"></span>
 	<div class=" menu " style="display:none">
<div class="menu-item" onClick="_config.setback('_imageurl',1,'','backimg');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-text">拉伸</span></div>
<div class="menu-item" onClick="_config.setback('_imageurl',2,'','backimg');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-text">平铺</span></div>
<div class="menu-item" onClick="_config.setback('_imageurl',3,'','backimg');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();return false;"><span class="menu-text">居中</span></div>

</div>
</div>
<!--<div class="menu-item setwidget" onClick="_widget.setToWidget('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-setwidget"></span><span class="menu-text">设为挂件</span></div>-->
 
 <div class="menu-item realdelete" onClick="_ajax.delIco('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-delete"></span><span class="menu-text">删除</span></div> 
<div class="menu-item empty" onClick="_ico.Empty('_oid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-empty"></span><span class="menu-text">清空回收站</span></div>
            <div class="menu-item property" onClick="_ico.property('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-property"></span><span class="menu-text">属性</span></div>
            <div class="menu-item chmod" onClick="_ico.chmod('_icoid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-chmod"></span><span class="menu-text">权限 CHMOD</span></div>
        </div>

        <div id="right_folder" class=" menu " style="position:absolute;display:none">
<div class="menu-item " ><span class="menu-icon icon-iconview"></span><span class="menu-text">图标大小</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none">
<div class="menu-item" onClick="_filemanage.Arrange('_filemanageid','0','_winid')"><span view="0" class="menu-icon icon-notselect menu-icon-iconview menu_icon_filemanageview_0"></span><span class="menu-text">大图标</span></div>
<div class="menu-item" onClick="_filemanage.Arrange('_filemanageid','1','_winid')"><span view="1" class="menu-icon icon-notselect menu-icon-iconview menu_icon_filemanageview_1"></span><span class="menu-text">中图标</span></div>
<div class="menu-item" onClick="_filemanage.Arrange('_filemanageid','2','_winid')"><span view="2" class="menu-icon icon-notselect menu-icon-iconview menu_icon_filemanageview_2"></span><span class="menu-text">中图标列表</span></div>
<div class="menu-item" onClick="_filemanage.Arrange('_filemanageid','3','_winid')"><span view="3" class="menu-icon icon-notselect menu-icon-iconview menu_icon_filemanageview_3" ></span><span class="menu-text">小图标列表</span></div>
<div class="menu-item" onClick="_filemanage.Arrange('_filemanageid','4','_winid')"><span view="4" class="menu-icon icon-notselect menu-icon-iconview menu_icon_filemanageview_4"></span><span class="menu-text">详细列表</span></div>
   </div>
   <span  class="menu-shadow"></span>
</div>
<div class="menu-item sort" ><span class="menu-icon icon-sort"></span><span class="menu-text">排序方式</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none">
<div class="menu-item" onClick="_filemanage.Disp('_filemanageid','0','_winid')"><span disp="0" class="menu-icon icon-notselect menu-icon-disp menu_icon_filemanagedisp_0" ></span><span class="menu-text">名称</span></div>
<div class="menu-item" onClick="_filemanage.Disp('_filemanageid','1','_winid')"><span disp="1" class="menu-icon icon-notselect menu-icon-disp menu_icon_filemanagedisp_1" ></span><span class="menu-text">大小</span></div>
<div class="menu-item" onClick="_filemanage.Disp('_filemanageid','2','_winid')"><span disp="2" class="menu-icon icon-notselect menu-icon-disp menu_icon_filemanagedisp_2" ></span><span class="menu-text">类型</span></div>
<div class="menu-item" onClick="_filemanage.Disp('_filemanageid','3','_winid')"><span disp="3" class="menu-icon icon-notselect menu-icon-disp menu_icon_filemanagedisp_3" ></span><span class="menu-text">修改时间</span></div>

   </div>
   <span  class="menu-shadow"></span>
</div>
<span class="menu-sep"></span>
<div class="menu-item paste" onClick="_select.Paste('_container',XX,YY);jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-paste"></span><span class="menu-text">粘贴</span></div>
<div class="menu-item create" ><span class="menu-icon icon-create"></span><span class="menu-text">新建</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none">
<div class="menu-item newfolder" onClick="_ico.NewIco('Newfolder','_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-newfolder"></span><span class="menu-text">新建文件夹</span></div>
<div class="menu-item newlink" onclick="_ico.NewIco('Newlink','_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();" ><span class="menu-icon icon-newlink"></span><span class="menu-text">新建网址</span></div>
<div class="menu-item newdzzdoc" onclick="_ico.NewIco('NewDzzDoc','_container','_filemanageid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();" ><span class="menu-icon icon-dzzdoc"></span><span class="menu-text">Dzz文档</span></div>
<div class="menu-item newtext" onclick="_ico.NewIco('NewTxt','_container','_filemanageid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();" ><span class="menu-icon icon-txt" ></span><span class="menu-text">文本文档</span></div>
   </div>
   <span  class="menu-shadow"></span>
</div>
<div class="menu-item upload" style="overflow:hidden" onClick="jQuery('#right_contextmenu').css('z-index',-99999999);jQuery('#shadow').hide();return true;"><span class="menu-icon icon-upload"></span><span class="menu-text">上传</span></div>
<span class="menu-sep"></span>
 <!--<div class="menu-item appmarket" onClick="_login.click('sys_market','_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-appshop"></span><span class="menu-text">应用市场</span></div>-->
  <div class="menu-item empty" onClick="_ico.Empty('_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-empty"></span><span class="menu-text">清空回收站</span></div>
</div>
 <div id="right_body" class=" menu " style="position:absolute;display:none">
<div class="menu-item " ><span id="menu_icon_view" class="menu-icon icon-iconview"></span><span class="menu-text">图标大小</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none"><?php if(is_array($iconview)) foreach($iconview as $value) { ?><div class="menu-item" onClick="_ico.Arrange('<?php echo $value['id'];?>','_container','iconview')"><span pid="menu_icon_iconview_<?php echo $value['id'];?>" class="menu-icon icon-notselect menu-icon-iconview" ></span><span class="menu-text"><?php echo $value['name'];?></span></div>
<?php } ?>
   </div>
   <span  class="menu-shadow"></span>
</div>
<div class="menu-item position" ><span class="menu-icon icon-position"></span><span class="menu-text">排列位置</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none">
<div class="menu-item" onClick="_ico.Arrange('0','_container','position')"><span pid="menu_icon_position_0" class="menu-icon icon-notselect menu-icon-position"></span><span class="menu-text">左上角</span></div>
<div class="menu-item" onClick="_ico.Arrange('2','_container','position')"><span pid="menu_icon_position_2" class="menu-icon icon-notselect menu-icon-position"></span><span class="menu-text">左下角</span></div>
<div class="menu-item" onClick="_ico.Arrange('1','_container','position')"><span pid="menu_icon_position_1" class="menu-icon icon-notselect menu-icon-position"></span><span class="menu-text">右上角</span></div>
<div class="menu-item" onClick="_ico.Arrange('3','_container','position')"><span pid="menu_icon_position_3" class="menu-icon icon-notselect menu-icon-position"></span><span class="menu-text">右下角</span></div>
<div class="menu-item" onClick="_ico.Arrange('4','_container','position')"><span pid="menu_icon_position_4" class="menu-icon icon-notselect menu-icon-position"></span><span class="menu-text">居 中</span></div>
   </div>
   <span  class="menu-shadow"></span>
</div>
<div class="menu-item  direction" ><span class="menu-icon icon-direction"></span><span class="menu-text">排列方向</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none">
<div class="menu-item" onClick="_ico.Arrange('0','_container','direction')"><span did="menu_icon_direction_0" class="menu-icon icon-notselect menu-icon-direction"></span><span class="menu-text">纵向排列</span></div>
<div class="menu-item" onClick="_ico.Arrange('1','_container','direction')"><span did="menu_icon_direction_1" class="menu-icon icon-notselect menu-icon-direction"></span><span class="menu-text">横向排列</span></div>

   </div>
   <span  class="menu-shadow"></span>
</div>
<!--<div class="menu-item  autolist" ><span class="menu-icon icon-autolist"></span><span class="menu-text">排列方式</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none">
<div class="menu-item" onClick="_ico.Arrange('0','_container','autolist')"><span pid="menu_icon_autolist_0" class="menu-icon icon-notselect menu-icon-autolist"></span><span class="menu-text">任意排列</span></div>
<div class="menu-item" onClick="_ico.Arrange('1','_container','autolist')"><span pid="menu_icon_autolist_1" class="menu-icon icon-notselect menu-icon-autolist"></span><span class="menu-text">自动排列</span></div>

   </div>
   <span  class="menu-shadow"></span>
</div>-->
<span class="menu-sep"></span>
<div class="menu-item  create" ><span class="menu-icon icon-create"></span><span class="menu-text">新建</span><span class="menu-rightarrow"></span>
<div class=" menu " style="display:none">
<div class="menu-item newfolder" onClick="_ico.NewIco('Newfolder','_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-newfolder"></span><span class="menu-text">新建文件夹</span></div>
<div class="menu-item newlink" onclick="_ico.NewIco('Newlink','_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();" ><span class="menu-icon icon-newlink"></span><span class="menu-text">新建网址</span></div>
<div class="menu-item newdzzdoc" onclick="_ico.NewIco('NewDzzDoc','_container','_filemanageid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();" ><span class="menu-icon icon-dzzdoc"></span><span class="menu-text">Dzz文档</span></div>
<div class="menu-item newtext" onclick="_ico.NewIco('NewTxt','_container','_filemanageid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();" ><span class="menu-icon icon-txt"></span><span class="menu-text">文本文档</span></div>
   </div>
   <span  class="menu-shadow"></span>
</div>
<div class="menu-item  upload" style="overflow:hidden" onClick="jQuery('#right_contextmenu').css('z-index',-99999999);jQuery('#shadow').hide();"><span class="menu-icon icon-upload"></span><span class="menu-text">上传</span></div>
<div class="menu-item paste" onClick="_select.Paste('_container',XX,YY);jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-paste"></span><span class="menu-text">粘贴</span></div>
<!-- <div class="menu-item newwidget" onclick="_widget.New('_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-setwidget"></span><span class="menu-text">新建挂件</span></div>-->
<span class="menu-sep"></span>
<!--<div class="menu-item  appmarket" onClick="_login.click('sys_market','_container');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-appshop"></span><span class="menu-text">应用市场</span></div>-->
<!--<div class="menu-item  widgetmarket" onClick="_login.click('sys_widget');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-widget"></span><span class="menu-text">挂件市场</span></div>-->

<div class="menu-item  thame" onClick="_login.click('sys_theme');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-zhuti"></span><span class="menu-text">主题设置</span></div>
<!--<div class="menu-item  config" onClick="showWindow('sys_deskconfig','<?php echo DZZSCRIPT;?>?mod=dzzcp&ac=setdefault');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-config"></span><span class="menu-text">默认桌面设置</span></div>-->

</div>
       
    <div id="task_right_Ico" class="menu " style="display:none">
            <div class="menu-item FOCUS" onClick="_dock.Focus('_dockid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-huanyuan"></span><span class="menu-text">还原</span></div>
            <div class="menu-item MAX" onClick="_dock.Max('_dockid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-zuida"></span><span class="menu-text">最大化</span></div>
            <div class="menu-item MIN" onClick="_dock.Min('_dockid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-zuixiao"></span><span class="menu-text">最小化</span></div>
            <div class="menu-item CLOSE" onClick="_dock.Close('_dockid');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-guanbi"></span><span class="menu-text">关闭 </span></div>
        </div>
        
         <div id="jstree_right_Ico" class="menu " style="display:none">
            <div class="menu-item shortcut" onClick="_ico.ShortCut('fid_{fid}');jQuery('#right_contextmenu').hide();jQuery('#shadow').hide();"><span class="menu-icon icon-desktop"></span><span class="menu-text">创建桌面快捷方式</span></div>
          
        </div>
<div id="shadow" style="display:none;position:absolute"  class="DM">
        <table cellpadding="0" cellspacing="0">
        <tr><td class="LEFT_TOP"></td><td class="TOP"></td><td class="RIGHT_TOP"></td></tr>
        <tr><td class="LEFT"></td><td class="CONTENT"><div id="shadow_center"></div></td><td class="RIGHT"></td></tr>
        <tr><td class="LEFT_BOTTOM"></td><td class="BOTTOM"></td><td class="RIGHT_BOTTOM"></td></tr>	
        </table>
    </div>



<?php if(!$_G['uid']) { ?>
    <script src="user/scripts/register.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
<script src="dzz/scripts/jstorage.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/jcLoader.js" type="text/javascript"></script>
<!--[if lte IE 9]>
<script src="dzz/scripts/fonteffect.js" type="text/javascript"></script>
<![endif]-->
<script src="dzz/system/scripts/jquery.jstree.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="dzz/scripts/jquery_file_upload/jquery.ui.widget.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/jquery_file_upload/jquery.iframe-transport.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<!-- The basic File Upload plugin -->
<script src="dzz/scripts/jquery_file_upload/jquery.fileupload.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/jquery_file_upload/jquery.fileupload-process.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/jquery_file_upload/jquery.fileupload-validate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/md5.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/dzz_min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/_common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/sound/_sound.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script type="text/javascript">
_config.init(_config.opens,function(json){
//此处可以添加自己的运行js，在桌面完成时触发
//json： 为传递回来的设置参数，一般用不到，使用全局变量即可。
//if(_config.myuid<1) jQuery('#taskbar_start').trigger('click'); //游客默认打开开始菜单
if(_config.myuid<1){//游客打开登录提示框
jQuery('#taskbar .taskbar-guide-logging').show();
jQuery('#taskbar_start').one('mousedown',function(){jQuery('#taskbar .taskbar-guide-logging').hide();});
}

});

</script>
<script src="static/js/jquery.kpdragsort.js" type="text/javascript" type="text/javascript"></script>
<script src="static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<div style="display:none"><?php echo $_G['setting']['statcode'];?></div>
<div class="notice" id="notice"></div><?php include template('common/footer'); ?> 	