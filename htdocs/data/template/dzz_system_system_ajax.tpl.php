<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_ajax'); if($do == 'gethottags') { ?>
  <?php echo $jsstr;?>
<?php } elseif($do == 'newdoc' || $do=='newtxt') { ?>
    <style>
 @media (min-width: 768px){ 
 #fwin_newdoc .modal-dialog{width:500px;}
}
</style>
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    	<h4 class="modal-title" id="return_<?php echo $_GET['handlekey'];?>">新建文档</h4>
    </div>

<form id="newdocform" name="newdocform" class="form-horizontal" role="form" action="<?php echo DZZSCRIPT;?>?mod=system&op=ajax&do=<?php echo $do;?>" method="post"  onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>','return_<?php echo $_GET['handlekey'];?>');" style="margin:0">
<input type="hidden" name="refer" value="" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="newdocsubmit" value="true" />
<input type="hidden" name="path" value="<?php echo $path;?>" />
            <input type="hidden" name="ext" value="<?php echo $ext;?>" />

<?php if($_G['inajax']) { ?>
<input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" />
<?php } ?>
          <div class="modal-body">

<!--<div class="span3 clearfix"><label> <input type="text" size="60" class="" name="name"  autocomplete="off" onblur="javascript:if(''==this.value)this.value='<?php echo $foldername;?>';" onfocus="this.select();"  value="<?php echo $foldername;?>" /></label></div>-->
               <div class="input-group">
                  <input name="filename" class="form-control focus" type="text" autocomplete="off" onblur="javascript:if(''==this.value)this.value='<?php echo $name;?>';" onfocus="this.focused=true;this.select();"  onmouseup="if(this.focused){this.focused=false;return false;}"  value="<?php echo $name;?>">
                  <span class="input-group-addon">.<?php echo $ext;?></span>
                </div>
</div>
<!-- <p class="mtn mbm"><em>隐私设置</em></p>-->

<div class="modal-footer">
<button type="submit" name="newdocsubmit_btn" id="newdocsubmit_btn" value="提交" class="btn btn-primary"  ><strong>提交</strong></button>&nbsp;&nbsp; <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>关闭</strong></button>
</div>
</form>
</div>

<script type="text/javascript" reload="1">
jQuery('.fwinmask .focus').select();
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, values) {
var data= eval('(' + decodeURIComponent(values['data']) + ')');
_ico.createIco(data);
hideWindow('<?php echo $_GET['handlekey'];?>');
};

</script> 
<?php } elseif($do == 'newfolder') { ?>
<style>
 @media (min-width: 768px){ 
 #fwin_newfolder .modal-dialog{width:450px;}
}
</style>
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    	<h4 class="modal-title" id="return_<?php echo $_GET['handlekey'];?>">新建文件夹</h4>
    </div>

<form id="newfolderform" name="newfolderform" class="form-horizontal" role="form" action="<?php echo DZZSCRIPT;?>?mod=system&op=ajax&do=newfolder" method="post"  onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>','return_<?php echo $_GET['handlekey'];?>');" style="margin:0">
<input type="hidden" name="refer" value="" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="newfoldersubmit" value="true" />
<input type="hidden" name="path" value="<?php echo $path;?>" />

<?php if($_G['inajax']) { ?>
<input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" />
<?php } ?>
<input id="folder_type" type="hidden" name="type" value="<?php echo $default;?>" />
    <div class="m_c modal-body" style="padding:0;">    
<div  class="c ctw clearfix">
                <?php if($ismoderator) { ?>
<div  class="foldertype  clearfix" >
                    <div class=" foldertype_item selected" val="0" tipid="tip-0" > 
                      <div class="icon_sel" ></div>
                      <table cellpadding="0" cellspacing="0" width="100%" height="100%">
                          <tr>
                            <td align="center">
                            	<img src="dzz/images/default/system/folder-<?php echo $permtitle['flag'];?>.png" width="50">
                                
                            </td>
                          </tr>
                          <tr>
                            <td align="center">继承(<?php echo $permtitle['title'];?>)</td>
                          </tr>
                        
                      </table>
                    </div>
                   <div class="" style="float:left;width:1px;margin:5px 20px 0;height:70px;border-style:solid;border-width:0 1px; border-color:#FFF #FFF #FFF #D2D2D2"></div>
                   <?php if(is_array($permarr)) foreach($permarr as $key => $value) { ?>                    <div class="foldertype_item " val="<?php echo $value['power'];?>" tipid="tip-<?php echo $key;?>"> 
                      <div class="icon_sel" ></div>
                      <table cellpadding="0" cellspacing="0" width="100%" height="100%">
                          <tr><td align="center"><img src="dzz/images/default/system/folder-<?php echo $key;?>.png" width="50"></td></tr>
                          <tr><td align="center"><?php echo $value['title'];?></td> </tr>
                      </table>
                    </div>
                    <?php } ?>
                    
                    
</div>
            <div class="tip" id="tip-0" style="margin:0px;">
                <div class="alert alert-success" style="padding:5px 0;margin:0;">
                    <ul style="padding:5px 5px 5px 25px">
                        <li>继承 指继承上级文件夹设置的权限。</li>
                    </ul>
                </div>
            </div>
            <?php if(is_array($permarr)) foreach($permarr as $key => $value) { ?>            <div class="tip" id="tip-<?php echo $value['flag'];?>" style="margin:0px;display:none">
                <div class="alert alert-success" style="padding:10px;margin:0;">
                    <?php echo $value['tip'];?>
                </div>
            </div>
           <?php } ?>
            <?php } ?>
            
            <div  class="folder-name  " style="padding:10px 0">
                <input id="perm" name="perm" value="0" type="hidden" />
                <input type="text"  class="form-control focus" name="name"  autocomplete="off" onblur="javascript:if(''==this.value)this.value='<?php echo $foldername;?>';"  onfocus="this.focused=true;this.select();" onmouseup="if(this.focused){this.focused=false;return false;}"  value="<?php echo $foldername;?>" />
             </div>
       </div>     

    </div>
<div class="modal-footer" style="margin-top:0;border-top:1px solid #FFF;">		
<button type="submit" name="groupnewfoldersubmit_btn" id="groupnewfoldersubmit_btn" value="提交" class="btn btn-primary"  ><strong>提交</strong></button>&nbsp;&nbsp; <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>关闭</strong></button>

</div>
</form>
<script type="text/javascript" reload="1">
jQuery('.fwinmask .focus').focus();
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, values) {
var data= eval('(' + decodeURIComponent(values['data']) + ')');
_ico.createFolder(data);
hideWindow('<?php echo $_GET['handlekey'];?>');
};
var el=jQuery('.foldertype_item');
el.off('mouseenter').on('mouseenter',function(){
jQuery(this).addClass('hover');
});
el.off('mouseleave').on('mouseenter',function(){
jQuery(this).removeClass('hover');
});
el.off('click').on('click',function(){
el.removeClass('selected');
jQuery(this).addClass('selected');
jQuery('#fwin_newfolder .tip').hide();
jQuery('#'+jQuery(this).attr('tipid')).show();
document.getElementById('perm').value=jQuery(this).attr('val');
});
</script> 
<?php } elseif($do == 'newlink') { ?>
<style>
 @media (min-width: 768px){ 
 #fwin_newlink .modal-dialog{width:450px;}
}
</style>
<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    	<h4 class="modal-title" id="return_<?php echo $_GET['handlekey'];?>">添加网址</h4>
    </div>
<form id="newlinkform" name="newlinkform" class="form-horizontal" role="form" action="<?php echo DZZSCRIPT;?>?mod=system&op=ajax&do=newlink" method="post"  onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>','return_<?php echo $_GET['handlekey'];?>','',$('newlinksubmit_btn'));" style="margin:0">
<input type="hidden" name="refer" value="" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="newlinksubmit" value="true" />
<input type="hidden" name="pfid" value="<?php echo $pfid;?>" />

<?php if($_G['inajax']) { ?>
<input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" />
<?php } ?>
     <div class="m_c modal-body">
<input type="text"  class="form-control focus"  name="link" onchange="$('newlinksubmit_btn').value=true"  onblur="javascript:if(''==this.value)this.value='http://';" onfocus="this.focused=true;this.select();" onmouseup="if(this.focused){this.focused=false;return false;}" id="share_link" value="http://" style="maring:0"  autocomplete="off" />
</div>	
    <div class="modal-footer">
<button type="submit" name="newlinksubmit_btn" id="newlinksubmit_btn" value="提交" class="btn btn-primary"  ><strong>提交</strong></button>&nbsp;&nbsp; <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>关闭</strong></button>
</div>
</form>

<script type="text/javascript" reload="1">
jQuery('.fwinmask .focus').select();
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, values) {
var data= eval('(' + decodeURIComponent(values['data']) + ')');
_ico.createIco(data);
}
</script> 

<?php } elseif($do=='userdetail') { ?>	
<style>
.userdetail a{
color:#004080;
}
</style>
<div class="userdetail space_size_title">
<span style="float:left"><a title="空间信息查看" onclick="OpenWindow('space_info','<?php echo DZZSCRIPT;?>?mod=space&do=myspace&uid=<?php echo $space['uid'];?>','空间信息','','titlebutton=close|max|min,width=800,height=500');return false;" >空间信息</a></span><?php if($sysconfig['spacebuy'] && $space['uid']==$_G['uid']) { ?><a class="space_upgrade" title="增加空间大小" onclick="OpenWindow('space_buy','<?php echo DZZSCRIPT;?>?mod=space','购买空间','','titlebutton=close|max|min,width=700,height=500');return false;" ></a><?php } ?>
</div>
<div class="userdetail space_size_text"> 已使用: &nbsp;<?php echo $space['fusesize'];?> &nbsp;,&nbsp; 共&nbsp; <?php echo $space['fmaxspacesize'];?></div>
<div class="userdetail space_size_img"> 
<div class="space_size_back"><div class="space_size_per" style="width:<?php echo ceil(100*$space[usesize]/$space[maxspacesize]);?>%"></div></div>
</div>
<div class="userdetail">单文件大小限制:&nbsp;&nbsp;&nbsp; <?php echo $space['fmaxattachsize'];?></div>
<?php if($space['uid']==$_G['uid']) { ?><div class="userdetail ">我的用户组:&nbsp;&nbsp;&nbsp; <a title="用户组权限查看" onclick="OpenWindow('usergroup_privilege','<?php echo DZZSCRIPT;?>?mod=space&do=usergroup&uid=<?php echo $space['uid'];?>','用户组权限查看','','titlebutton=close|max|min,width=700,height=500');" ><?php echo $_G['usergroup']['grouptitle'];?></a></div>
<?php } else { ?>
<div class="userdetail "><a title="用户组权限查看" onclick="OpenWindow('usergroup_privilege','<?php echo DZZSCRIPT;?>?mod=space&do=usergroup&uid=<?php echo $space['uid'];?>','用户组权限查看','','titlebutton=close|max|min,width=700,height=500');" >用户组权限查看</a></div>
<?php } } elseif($do=='property') { ?>	
<style>
@media (min-width: 768px){
 #fwin_property .modal-dialog{width:500px;}
}
</style>		
<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    	<h4 class="modal-title" id="return_<?php echo $_GET['handlekey'];?>"><?php echo $info['name'];?> &nbsp;属性</h4>
    </div>

    <form id="propertyform" name="propertyform" class="form-horizontal" role="form" action="<?php echo DZZSCRIPT;?>?mod=system&op=ajax&do=<?php echo $do;?>" method="post" autocomplete="off" onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>');" style="margin:0">
        <input type="hidden" name="refer" value="" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <input type="hidden" name="propertysubmit" value="true" />
        <input type="hidden" name="icoid" value="<?php echo $icoid;?>" />
        <?php if($_G['inajax']) { ?>
        <input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" />
        <?php } ?> 
       <div class="m_c modal-body" style="padding:0;"> 
           <div class="c ctw">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr height="45"><td width="70" ><img class="icon_50_50" src="<?php echo $info['icon'];?>" /></td><td><input type="text"  class="form-control focus"  name="name"  value="<?php echo $icoarr['name'];?>" /></td></tr>
            </table>
            </div> 
         <?php if($ismoderator) { ?>
         <div class="c ctw">
            <div  class="foldertype  clearfix" >
                <div class=" foldertype_item <?php if($folder['perm']<1) { ?>selected<?php } ?>" val="0" tipid="tip-0" > 
                  <div class="icon_sel" ></div>
                  <table cellpadding="0" cellspacing="0" width="100%" height="100%">
                      <tr><td align="center">
                            <img src="dzz/images/default/system/folder-<?php echo $permtitle['flag'];?>.png" width="50">
                      </td></tr>
                      <tr><td align="center">继承(<?php echo $permtitle['title'];?>)</td></tr>
                    
                  </table>
                </div>
               <div class="" style="float:left;width:1px;margin:5px 20px 0;height:70px;border-style:solid;border-width:0 1px; border-color:#FFF #FFF #FFF #D2D2D2"></div>
               <?php if(is_array($permarr)) foreach($permarr as $key => $value) { ?>                <div class="foldertype_item <?php if($folder['perm']==$value['power']) { ?>selected<?php } ?>" val="<?php echo $value['power'];?>" tipid="tip-<?php echo $key;?>"> 
                  <div class="icon_sel" ></div>
                  <table cellpadding="0" cellspacing="0" width="100%" height="100%">
                      <tr><td align="center"><img src="dzz/images/default/system/folder-<?php echo $key;?>.png" width="50"></td></tr>
                      <tr><td align="center"><?php echo $value['title'];?></td> </tr>
                  </table>
                </div>
                <?php } ?>
                <input id="perm" name="perm" value="<?php echo $folder['perm'];?>" type="hidden" />
                
        	</div>
          </div>  
          <script type="text/javascript" reload="1">
var el=jQuery('.foldertype_item');
el.off('mouseenter').on('mouseenter',function(){
jQuery(this).addClass('hover');
});
el.off('mouseleave').on('mouseenter',function(){
jQuery(this).removeClass('hover');
});
el.off('click').on('click',function(){
el.removeClass('selected');
jQuery(this).addClass('selected');
jQuery(this).parent().find('#perm').val(jQuery(this).attr('val'));
});
</script> 
          
         <?php } ?>
           
          
           <div class="c ctw">
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr height="30"><td width="70">类  型：</td><td><?php echo $info['ftype'];?></td></tr>
                 <tr height="30"><td width="70">位  置：</td><td><div style="text-align:left;height:30px;overflow:hidden"><input type="text"  value="<?php echo $info['path'];?>" class="form-control input-sm" style="border:none;background:none;box-shadow:none;padding:0;margin:0;" /></div></td></tr>
                  
                </table>
          </div>	
          <div class="c ctw">
                <table cellpadding="0" cellspacing="0" border="0" >
                <tr><td width="70">大  小：</td><td><div style="text-align:left;height:30px;line-height:30px;overflow:hidden"><?php echo $info['size'];?></div></td></tr>
                 <?php if($info['contain']) { ?><tr><td width="70">包  含：</td><td><div style="text-align:left;height:30px;line-height:30px;overflow:hidden"><?php echo $info['contain'];?></div></td></tr><?php } ?>
                 <tr><td width="70">创建时间：</td><td><div style="text-align:left;height:30px;line-height:30px;overflow:hidden"><?php echo $info['fdateline'];?></div></td></tr>
                 <tr><td width="70">创 建 者：</td><td><div style="text-align:left;height:30px;line-height:30px;overflow:hidden"><?php echo $info['username'];?></div></td></tr>
                </table>
        </div>
      </div>  
       <div class="modal-footer" style="margin-top:0;border-top:1px solid #FFF;">
         <?php if($perm) { ?>
            <button type="submit" name="propertysubmit_btn" id="propertysubmit_btn" value="提交" class="btn btn-primary"  ><strong>提交</strong></button>&nbsp;&nbsp;
          <?php } ?>
          	 <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>关闭</strong></button>
        </div>
    </form>

<script type="text/javascript" reload="1">
jQuery('.fwinmask .focus').select();
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, values) {
hideWindow('<?php echo $_GET['handlekey'];?>');
if(values['msg']=='success') {
if(values['bz']=='') {
try{
top._config.sourcedata.icos[values['icoid']]=values;
top._ico.reCIco(values['icoid']);
}catch(e){}
}else{
try{
if(values['folderdata']) top._config.sourcedata.folder[values['folderdata']['fid']]=values['folderdata'];
top._config.sourcedata.icos[values['icoid']]=values;
 _ico.removeIcoid(values['oicoid']);
 _ico.appendIcoids([values['icoid']]);
}catch(e){}
}
}			
}
</script> 		
<?php } elseif($do=='chmod') { ?>	
<style>		
@media (min-width: 768px){
 #fwin_chmod .modal-dialog{width:500px;}
}
</style>
     <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    	<h4 class="modal-title" id="return_<?php echo $_GET['handlekey'];?>">更改权限 - <?php echo $meta['name'];?></h4>
    </div>

    <form id="chmodform" name="chmodform" class="form-horizontal" role="form" action="<?php echo DZZSCRIPT;?>?mod=system&op=ajax&do=chmod" method="post" autocomplete="off" onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>');" style="margin:0">
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <input type="hidden" name="chmodsubmit" value="true" />
         <input type="hidden" name="path" value="<?php echo $path;?>" />
        <input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" />
     <div class="m_c modal-body" style="padding:0;">
       		<div class="c ctw clearfix" style="padding:10px 0;" >
                <div class="col-xs-4" >
                	<p ><b>所有权</b></p>
                	<label class="checkbox" style="font-weight:normal"><input id="chmod_8" class="mod" type="checkbox" value="1" name="chmod[8]" onclick="changeMod()" <?php if($chmod['8']>0) { ?> checked="checked"<?php } ?>>读取</label>
                    <label class="checkbox" style="font-weight:normal"><input id="chmod_7" class="mod" type="checkbox" value="1" name="chmod[7]" onclick="changeMod()" <?php if($chmod['7']>0) { ?> checked="checked"<?php } ?>>写入</label>
                    <label class="checkbox" style="font-weight:normal"><input id="chmod_6" class="mod" type="checkbox" value="1" name="chmod[6]" onclick="changeMod()" <?php if($chmod['6']>0) { ?> checked="checked"<?php } ?>>执行</label>
                </div>
                <div class="col-xs-4" >
                	<p ><b>组</b></p>
                	<label class="checkbox" style="font-weight:normal"><input id="chmod_5" class="mod" type="checkbox" value="1" name="chmod[5]" onclick="changeMod()" <?php if($chmod['5']>0) { ?> checked="checked"<?php } ?>>读取</label>
                    <label class="checkbox" style="font-weight:normal"><input id="chmod_4" class="mod" type="checkbox" value="1" name="chmod[4]" onclick="changeMod()" <?php if($chmod['4']>0) { ?> checked="checked"<?php } ?>>写入</label>
                    <label class="checkbox" style="font-weight:normal"><input id="chmod_3" class="mod" type="checkbox" value="1" name="chmod[3]" onclick="changeMod()" <?php if($chmod['3']>0) { ?> checked="checked"<?php } ?>>执行</label>
                </div>
                <div class="col-xs-4" >
                	<p ><b>公共</b></p>
                	<label class="checkbox" style="font-weight:normal"><input id="chmod_2" class="mod" type="checkbox" value="1" name="chmod[2]" onclick="changeMod()" <?php if($chmod['2']>0) { ?> checked="checked"<?php } ?>>读取</label>
                    <label class="checkbox" style="font-weight:normal"><input id="chmod_1" class="mod" type="checkbox" value="1" name="chmod[1]" onclick="changeMod()" <?php if($chmod['1']>0) { ?> checked="checked"<?php } ?>>写入</label>
                    <label class="checkbox" style="font-weight:normal"><input id="chmod_0" class="mod" type="checkbox" value="1" name="chmod[0]" onclick="changeMod()" <?php if($chmod['0']>0) { ?> checked="checked"<?php } ?>>执行</label>
                </div>
            </div>
           <div class="c ctw clearfix" style="padding:10px;" >
                <div class="input-group pull-left" style="width:120px;padding-top:0px;margin-right:20px;">
                     <a href="javascript:;" class="input-group-addon">权限</a><input   id="chmod"  type="text" value="<?php echo $meta['mod'];?>" class="form-control focus" onkeyup="setMod(this.value);">
                 </div>
                 <label class="checkbox-inline"><input type="checkbox" name="son" value="1"  />应用更改到所有子文件夹和文件</label>
            </div>
      </div>
    <div class="modal-footer" style="margin-top:0;border-top:1px solid #FFF;">
     
        <button type="submit" name="chmodsubmit_btn" id="chmodsubmit_btn" value="提交" class="btn btn-primary "  ><strong>提交</strong></button>&nbsp;&nbsp; 
         <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>关闭</strong></button>
    </div>
        
    </form>


<script type="text/javascript" reload="1">
jQuery('.fwinmask .focus').select();
function changeMod(){
var modarr=[];
jQuery('.mod').each(function(){
if(jQuery(this).prop('checked')) modarr.push(1);
else modarr.push(0);
});
mod=(modarr[0]*4+modarr[1]*2+modarr[2]*1)+''+(modarr[3]*4+modarr[4]*2+modarr[5]*1)+''+(modarr[6]*4+modarr[7]*2+modarr[8]*1);
jQuery('#chmod').val(mod);
}
function setMod(mod){
var l=mod.length;
var arr=[mod[l-3],mod[l-2],mod[l-1]];
var modarr='';
for(var i in arr){
if(isNaN(parseInt(arr[i]))){
arr[i]=0;
}else{
arr[i]=parseInt(arr[i]);
if(arr[i]>7) arr[i]=7;
}
var temp=arr[i].toString(2);
if(temp.length<3){
for(var j=0;j<3-temp.length;j++){
temp='0'+temp;
}
}
modarr+=(''+temp);
}
for(var i=0;i<9;i++){
if(modarr[i]>0){
 jQuery('#chmod_'+(8-i)).prop('checked',true);
}
else jQuery('#chmod_'+(8-i)).removeAttr('checked');
}

}
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, values) {
hideWindow('<?php echo $_GET['handlekey'];?>');

}
</script> 
<?php } elseif($do == 'share') { ?>
<style>
.copy-success {
position: absolute;
left: -140px;
top: -30px;
padding: 8px;
z-index:100;
}
</style>
<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    	<h4 class="modal-title" id="return_<?php echo $_GET['handlekey'];?>">创建分享</h4>
    </div>
<form id="shareform" name="shareform" class="form-horizontal" role="form" action="<?php echo DZZSCRIPT;?>?mod=system&op=ajax&do=share" method="post"  onsubmit="return shareValidate(this);" style="margin:0">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="sharesubmit" value="true" />
<input type="hidden" name="share[path]" value="<?php echo $icoarr['path'];?>" />
<input type="hidden" name="share[size]" value="<?php echo $icoarr['size'];?>" />
            <input type="hidden" name="share[img]" value="<?php echo $icoarr['img'];?>" />
            <input type="hidden" name="share[ext]" value="<?php echo $icoarr['ext'];?>" />
            <input type="hidden" name="share[type]" value="<?php echo $icoarr['type'];?>" />
           <!-- <input type="hidden" name="share[count]" value="<?php echo $share['count'];?>" />-->
<input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" />
            <div class="m_c modal-body">
            	<div class="form-group" style="border:0">
                	<div class="form-control-static col-sm-2">分享标题:</div>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="share[title]"  value="<?php echo $share['title'];?>"  />
                    </div>
                </div> 
                <div class="form-group" style="border:0">
                	<div class="form-control-static col-sm-2">到期时间:</div>
                    <div class="col-sm-10">
                    <input type="text" class="form-control endtime" name="share[endtime]"  style="width:150px;display:inline-block" value="<?php echo $share['endtime'];?>"  placeholder="到期时间" />
                    <span class="help-inline ml10" style="display:inline-block">留空或0、不设置到期时间</span>
                    </div>
                </div>
                
                <div class="form-group" style="border:0">
                	<div class="form-control-static col-sm-2">分享次数:</div>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" autocomplete="off" name="share[times]" style="width:150px;display:inline-block" value="<?php echo $share['times'];?>" placeholder="分享限制次数" />
                    <span class="help-inline ml10" style="display:inline-block">留空或0表示不限制</span>
                    </div>
                </div>   
                <div class="form-group" style="border:0">
                	<div class="form-control-static col-sm-2">提取密码:</div>
                    <div class="col-sm-10">
                    <input type="text" autocomplete="off" class="form-control" name="share[password]" style="width:150px;display:inline-block" value="<?php echo $share['password'];?>" placeholder="分享密码" />
                    <span class="help-inline ml10" style="display:inline-block">留空、表示不设置密码</span>
                    </div>
                </div>
                <div  class="form-group shareurl <?php if(!$share['shareurl']) { ?>hide<?php } ?>" style="border:0">
                    <div class="form-control-static col-sm-2">分享地址:</div>
                    <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" class="form-control" style="cursor:default;background:#FFF"  spellingcheck="false" readonly="readonly" name="shareurl" id="shareurl" value='<?php echo $share['shareurl'];?>' onfocus="this.select()">
                          <span class="input-group-addon js_copy" data-clipboard-text="<?php echo $share['shareurl'];?>" style="position:relative">复制地址<span class="alert copy-success  alert-success hide ">复制成功,请粘帖到您需要的地方</span></span>
                          <span class="input-group-addon"> <a href="javascript:;" id="shareform_qrcode" class="qrcode glyphicon glyphicon-qrcode" title="扫描二维码,发送到手机"  data-container=".modal" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="<p class='text-center'><img src='<?php echo $share['qrcode'];?>'></p>"></a></span>
                        </div>
                        <?php if($share['status']<0) { ?><div class="mt10">状态：<span class="danger"><?php echo $share['stitle'];?></span></div><?php } ?>
                    </div>
                </div>         
            </div>	
            <div class="modal-footer">
                   <button type="submit" name="shareform_btn" id="shareform_btn" value="创建分享" class="btn btn-primary" data-loading-text="创建中..." ><strong>创建分享</strong></button> &nbsp;&nbsp; <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>关闭</strong></button>
            </div>
</form>

<script type="text/javascript" reload="1">
function shareValidate(form){
//判断分享标题不能为空
if(jQuery('#shareform input[name="share[title]"]').val()==''){
  showmessage('请填写分享标题','danger',3000,1);
  jQuery('#shareform input[name="share[title]"]').focus();
  return false;
}
 var endtime=jQuery('#shareform input[name="share[endtime]"]').val();
 if(endtime && endtime!='0'){
  var reg=/\d{4}-\d{2}-\d{2}$/;
  if(!reg.test(endtime)){
  showmessage('到期时间格式错误，请检查','danger',3000,1);
  jQuery('#shareform input[name="share[endtime]"]').focus();
  return false;
  }
  }
  jQuery('#shareform_btn').button('loading');
  jQuery.post(form.action,jQuery(form).serialize(),function(json){
  if(json.msg=='success'){
  //showmessage('创建成功','success',1000,1); 
  jQuery('#shareform .shareurl').removeClass('hide').find('.js_copy').attr('data-clipboard-text',json.shareurl);
  jQuery('#shareurl').val(json.shareurl).focus();
  jQuery('#shareform_qrcode').attr('data-content',"<p class='text-center'><img src='"+json.qrcode+"'></p>");
  jQuery('#shareform_qrcode').popover();
  jQuery('#shareform_btn').html('创建成功');
  window.setTimeout(function(){ jQuery('#shareform_btn').button('reset');},1000);
  }else{
  jQuery('#shareform_btn').html('创建失败');
  window.setTimeout(function(){ jQuery('#shareform_btn').button('reset');},3000);
  }
 
  },'json');
  return false;
 /* ajaxpost(form.id, 'return_<?php echo $_GET['handlekey'];?>','return_<?php echo $_GET['handlekey'];?>','',$('shareform_btn'),null,null,function(){
  window.setTimeout(function(){jQuery('#shareform_btn').button('reset');},3000);
  });*/
}
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, values) {
var data= eval('(' + decodeURIComponent(values['data']) + ')');
//_ico.createIco(data);
}
jcLoader().load({type:'css',ids:'css_datepicker',url:'./static/js/datepicker/datepicker.css?<?php echo VERHASH;?>'});

 	jcLoader().load({type:"js",ids:'js_ui_core,js_datepicker,js_ZeroClipboard',url:"static/js/jquery.ui.core.js?<?php echo VERHASH;?>,static/js/datepicker/jquery.ui.datepicker.min.js?<?php echo VERHASH;?>,static/js/ZeroClipboard/ZeroClipboard.min.js?<?php echo VERHASH;?>"},function(){


 jQuery('#shareform .endtime').datepicker({minDate:0});
  var client = new ZeroClipboard(jQuery('.js_copy'));
  client.on( "load", function( client ) {
  // alert( "ZeroClipboard SWF is ready!" );
  client.on( "complete", function( client,args ) {
  var self=this;
  jQuery(this).parent().find('.copy-success').removeClass('hide');
  window.setTimeout(function(){
jQuery(self).parent().find('.copy-success').addClass('hide');
  },1000);
  });
 });
}); 
jQuery('#shareform_qrcode').popover();
       
</script>
<?php } ?> 

<?php if(!$_G['inajax']) { ?> 
</div>
</div>

</div>
<?php } ?> <?php include template('common/footer_ajax'); ?>