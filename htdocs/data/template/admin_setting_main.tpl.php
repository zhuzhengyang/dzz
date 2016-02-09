<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/icheck/skins/minimal/blue.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/select2/select2.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/select2/select2-bootstrap.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script src="admin/scripts/admin.js?<?php echo VERHASH;?>" type="text/javascript"></script>
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
.form-horizontal-left .radio-inline{
padding: 5px 20px;
margin:0;
}

</style><?php include template('common/header_simple_end'); ?><div class="bs-container clearfix">
  <div class="bs-left-container  clearfix">
    <?php include template('left'); ?> 
  </div>
  <div class="left-drager">
     <div class="left-drager-op"><div class="left-drager-sub"></div></div>
  </div>
      
  <div class="bs-main-container  clearfix" > 
    <?php if($operation=='mail') { ?>
    <div class="main-header">
      <ul class="nav nav-pills nav-pills-bottomguide">
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=setting&operation=mail">设置</a></li>
        <li ><a href="<?php echo BASESCRIPT;?>?mod=setting&op=mailcheck">检测</a></li>
      </ul>
    </div>
    <?php } elseif($operation=='smiley') { ?>
    <div class="main-header">
      <ul  class="nav nav-pills nav-pills-bottomguide">
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=setting&operation=smiley">表情设置</a></li>
        <li ><a href="<?php echo BASESCRIPT;?>?mod=setting&op=smiley">表情分类</a></li>
      </ul>
    </div>
    <?php } elseif($operation=='qywechat') { ?>
    <div class="main-header">
      <ul  class="nav nav-pills nav-pills-bottomguide">
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=setting&operation=qiyeweixin">企业号绑定</a></li>
        <?php if($setting['CorpID'] && $setting['CorpSecret']) { ?>
        <li><a href="<?php echo BASESCRIPT;?>?mod=setting&op=assistant">企业小助手</a></li>
        <li><a href="<?php echo BASESCRIPT;?>?mod=setting&op=wxsyn">数据同步</a></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>
    <div class="main-content" style="padding:20px 20px 10px"> 
      <?php if($operation=='basic') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="basic" name="operation">
        <dl>
          <dt>平台名称:</dt>
          <dd class="clearfix">
            <input type="text" id="sitename" name="settingnew[sitename]" class="form-control"   value="<?php echo $setting['sitename'];?>">
            <span class="help-inline text-muted" >平台名称，将显示在浏览器窗口标题等位置 </span> </dd>
        </dl>
        <dl>
          <dt>用户默认加入部门:</dt>
          <dd class="clearfix">
              <div class="dropdown">
                  <input id="sel_defaultdepartment"  type="hidden" name="settingnew[defaultdepartment]"  value="<?php echo $setting['defaultdepartment'];?>" />
                  <button type="button" id="defaultdepartment_Menu" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <?php echo $defaultdepartment;?> <span class="caret"></span>
                  </button>
                  <div id="defaultdepartment_dropdown_menu" class="dropdown-menu org-sel-box" role="menu" aria-labelledby="defaultdepartment_Menu">
                       <iframe name="orgids_iframe" class="org-sel-box-iframe" src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=defaultdepartment&amp;nouser=1" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" ></iframe>
                  </div>
            </div>
               
          		
           </dd> 
           <dd class="clearfix"> <span class="help-block text-muted">选择新注册用户默认加入的部门,不选择默认不加入部门</span> </dd>
        </dl>
        <dl>
          <dt>文件分享:</dt>
          <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[allowshare]" value="0"<?php if(!$setting['allowshare']) { ?>checked<?php } ?>>启用</label>
            <label class="radio radio-inline"><input type="radio" name="settingnew[allowshare]" value="1"<?php if($setting['allowshare']) { ?>checked<?php } ?>>禁用</label>
          </dd>
          <span class="help-block"> 禁用分享，文件属性页中不再出现分享和下载链接，Dzz文档，网址和网络视频类除外</span>
        </dl>
        <dl>
          <dt>平台版权:</dt>
          <dd class="clearfix">
            <textarea type="textarea" class="form-control" id="sitecopyright" name="settingnew[sitecopyright]" row="6" ><?php echo $setting['sitecopyright'];?></textarea>
            <span class="help-inline text-muted">支持html代码,面板可视区域大小为263*235</span> </dd>
        </dl>
        <dl>
          <dt>平台关键词:</dt>
          <dd class="clearfix">
            <textarea type="textarea" class="form-control"  id="metakeywords" name="settingnew[metakeywords]" row="6" ><?php echo $setting['metakeywords'];?></textarea>
            <span class="help-inline text-muted"> 平台SEO关键词</span> </dd>
        </dl>
        <dl>
          <dt>平台描述:</dt>
          <dd class="clearfix">
            <textarea type="textarea" class="form-control"  id="metadescription" name="settingnew[metadescription]" row="6" ><?php echo $setting['metadescription'];?></textarea>
            <span class="help-inline text-muted"> 平台SEO描述</span> </dd>
        </dl>
        
        <dl>
          <dt>统计代码:</dt>
          <dd class="clearfix">
            <textarea type="textarea" class="form-control" id="statcode" name="settingnew[statcode]" row="6" ><?php echo $setting['statcode'];?></textarea>
            <span class="help-inline text-muted">支持html代码</span> </dd>
        </dl>
        <!-- <dl>
           		  <dt>网站备案信息代码:</dt>
                  <dd class="clearfix">
                  	 <input type="text" id="icp" name="settingnew[icp]"  value="<?php echo $setting['icp'];?>">
                 	 <span class="help-inline">	页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入您的授权码，它将显示在页面底部，如果没有请留空</span>
                  </dd>
            </dl>--> 
        <!--<dl>
           		<dt>显示授权信息链接:</dt>
                 <dd class="clearfix">
                    <label class="radio-inline "><input type="radio" name="settingnew[boardlicensed]" value="1"<?php if($setting['boardlicensed']) { ?>checked<?php } ?>>是
        </label>
        <label class="radio radio-inline"><input type="radio" name="settingnew[boardlicensed]" value="0"<?php if(!$setting['boardlicensed']) { ?>checked<?php } ?>>否</label>
        </dd>
        <span class="help-block"> 选择“是”将在页脚显示商业授权用户链接，链接将指向 Dzz! 官方网站，用户可通过此链接验证其所使用的 Dzz! 是否经过商业授权</span>
        </dl>
        -->
        <dl>
          <dt>提示离开平台:</dt>
          <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[leavealert]" value="1"<?php if($setting['leavealert']) { ?>checked<?php } ?>>是</label>
            <label class="radio radio-inline"><input type="radio" name="settingnew[leavealert]" value="0"<?php if(!$setting['leavealert']) { ?>checked<?php } ?>>否</label>
          </dd>
          <span class="help-block"> 是否提示离开平台开关，设置否时，刷新页面将不会出现离开的提示信息</span>
        </dl>
        <dl>
          <dt>关闭平台:</dt>
          <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[bbclosed]" value="1"<?php if($setting['bbclosed']) { ?>checked<?php } ?> onclick="$('bbclosedreason').style.display='block'">是</label>
            <label class="radio radio-inline"><input type="radio" name="settingnew[bbclosed]" value="0"<?php if(!$setting['bbclosed']) { ?>checked<?php } ?> onclick="$('bbclosedreason').style.display='none'">否</label>
          </dd>
          <dd class="clearfix"><span class="help-block">暂时将平台关闭，其他人无法访问，但不影响管理员访问</span></dd>
          <dd class="clearfix">
            <dl id="bbclosedreason" style=" <?php if(!$setting['bbclosed']) { ?>display:none;<?php } ?> ">
              <dt>关闭平台的原因:</dt>
              <dd class="clearfix">
                <textarea type="textarea" class="form-control" id="closedreason" name="settingnew[closedreason]" row="6" ><?php echo $setting['closedreason'];?></textarea>
                <span class="help-inline text-muted"> 平台关闭时出现的提示信息</span></dd>
            </dl>
          </dd>
        </dl>
        <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit" value="保存更改" type="submit" >
      </form>
      <script type="text/javascript">
  	var selorg={};

//添加
selorg.add=function(ctrlid,vals){

if(vals[0].orgid=='other') vals[0].path='不加入机构或部门';
jQuery('#'+ctrlid+'_Menu').html(vals[0].path+' <span class="caret"></span>');
jQuery('#sel_'+ctrlid).val(vals[0].orgid);
}


  </script>
  <?php } elseif($operation=='at') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="upload" name="operation">
         <dl>
                  <dt>@部门范围设置:</dt>
                  <?php if(is_array($usergroups)) foreach($usergroups as $value) { ?>                  <dd class="clearfix">
                    <dl>
                        <dt><?php echo $value['grouptitle'];?></dt>
                        <dd class="clearfix">
                      	<label class="radio-inline ml10"><input type="radio" name="settingnew[at_range][<?php echo $value['groupid'];?>]" <?php if($setting['at_range'][$value['groupid']]==3) { ?>checked="checked"<?php } ?> value="3">所有机构部门</label>
                        <label class="radio radio-inline"><input type="radio"  name="settingnew[at_range][<?php echo $value['groupid'];?>]" <?php if($setting['at_range'][$value['groupid']]==2) { ?>checked="checked"<?php } ?> value="2">本机构部门</label>
                        <label class="radio radio-inline"><input type="radio"  name="settingnew[at_range][<?php echo $value['groupid'];?>]" <?php if($setting['at_range'][$value['groupid']]==1) { ?>checked="checked"<?php } ?> value="1">本部门</label>
                        <label class="radio radio-inline"><input type="radio"  name="settingnew[at_range][<?php echo $value['groupid'];?>]" <?php if($setting['at_range'][$value['groupid']]==0) { ?>checked="checked"<?php } ?> value="0">不能@部门</label>
                        </dd>
                    </dl>
                       
                   </dd>
                   <?php } ?>
                </dl>
         <dl><dd><input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit" value="保存更改" type="submit" ></dd> </dl>
      </form>
   <?php } elseif($operation=='upload') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="upload" name="operation">
        <dl>
          <dt>禁止运行的文件后缀:</dt>
          <dd class="clearfix">
            <input type="text"  name="settingnew[unRunExts]" class="form-control" style="width:300px;"   value="<?php echo $setting['unRunExts'];?>">
            <ul class="help-block text-muted" >
            	<li>设置禁止运行的文件后缀，多个用半角逗号隔开。</li>
                <li>出于安全考虑，通常php,asp,jsp等可以被利用后缀名都需要在此处设置来禁止运行。</li>
                <li>此处设置的后缀文件，系统将通过特殊处理，防止其运行，提高系统的安全性。</li>
             </ul>
           </dd>
        </dl>
        <dl><dt>缩略图生成方式</dt>
        	<dd class="clearfix">
            		<label class="radio-inline"><input type="radio" name="settingnew[thumb_active]" <?php if($setting['thumb_active']) { ?>checked="checked"<?php } ?> value="1"> 主动模式</label>
                    <label class="radio-inline"><input type="radio" name="settingnew[thumb_active]" <?php if(!$setting['thumb_active']) { ?>checked="checked"<?php } ?> value="0"> 被动模式</label>   
                <ul class="help-block">
               		 <li>主动模式时，上传图片的同时生成256X256的缩略图。上传速度会变慢，但用户浏览速度比较快</li>
                     <li>被动模式时，只有用户浏览时才生成缩略图。上传速度比较快，用户浏览时生成缩略图，图片加载稍慢，打开很多图片的文件夹时，服务压力较大</li>
                     <li>两种模式根据实际需要选择使用，此设置对于云端图片不适用，云端（如ftp，云存储）图片始终采用被动模式</li>
                </ul>
            </dd>
        </dl>
        <dl><dt>上传分块大小</dt>
        	<dd class="clearfix">
            	<div class="input-group" style="width:120px;float:left">
                    <input type="text" class="form-control" style="width:100px;"  name="settingnew[maxChunkSize]"  value="<?php echo $setting['maxChunkSize'];?>">
                    <span class="input-group-addon">M</span> 
                </div>
                <ul class="help-block">
               		 <li>此处设置分块时每块的大小，当上传文件大于此值时 上传程序会分块来上传</li>
                     <li>分块太大或太小都会影响上传的性能,请根据服务器设置来调整此参数</li>
                     <li><span style="color:#843534">分块大小必须小于php.ini中设置的post_max_size和upload_max_filesize的大小</span></li>
                </ul>
            </dd>
        </dl>
        <dl>
          <dt>上传权限设置</dt>
           <p class="text-danger ml20">
               注： 用户私有云(我的云中用户添加的云)不做限制，所以此处的设置对用户私有云不起作用。
             </p>
          <?php if(is_array($usergroups)) foreach($usergroups as $value) { ?>          <dd class="clearfix">
          		<dl>
                	<dt><?php echo $value['grouptitle'];?></dt>
                    <dd class="clearfix">
                        <span class="pull-left mr20" style="padding:6px;">默认空间</span>
                        <div class="input-group" style="width:120px;float:left">
                           	<input type="text" class="form-control" style="width:100px;" name="group[<?php echo $value['groupid'];?>][maxspacesize]"  value="<?php echo $value['maxspacesize'];?>">
                         	<span class="input-group-addon">M</span> 
                         </div>
                        
                         <span class="help-inline">用户的默认空间大小，单位M。0或不填 不限制； -1: 无空间</span>
                 	 </dd>
                      <dd class="clearfix mt10">
                        <span class="pull-left mr20" style="padding:6px;">文件大小</span>
                        <div class="input-group" style="width:120px;float:left">
                           	<input type="text" class="form-control" style="width:100px;" name="group[<?php echo $value['groupid'];?>][maxattachsize]"  value="<?php echo $value['maxattachsize'];?>">
                         	<span class="input-group-addon">M</span> 
                         </div>
                        
                         <span class="help-inline">允许上传的最大文件大小，单位M。0或不填 不限制；</span>
                 	 </dd>
                     <dd class="clearfix mt10">
                        <span class="pull-left mr20" style="padding:6px;">文件类型</span>
                         <input type="text" class="form-control" style="width:250px;"  name="group[<?php echo $value['groupid'];?>][attachextensions]"  value="<?php echo $value['attachextensions'];?>">
                         <span class="help-inline">允许上传的文件后缀，多个使用半角逗号隔开，留空不限制</span>
                           
                 	 </dd>
            	</dl>
               
           </dd>
           <?php } ?>
        </dl>
       <dl><dd><input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit" value="保存更改" type="submit" ></dd> </dl>
      </form>
  <?php } elseif($operation=='desktop') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="desktop" name="operation">
        <dl>
          <dt>任务栏位置：</dt>
           <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][taskbar]" value="left" <?php if($setting['desktop_default']['taskbar']=='left') { ?>checked<?php } ?>>左侧</label>
            <label class="radio radio-inline"><input type="radio" name="settingnew[desktop_default][taskbar]" value="right" <?php if($setting['desktop_default']['taskbar']=='right') { ?>checked<?php } ?>>右侧</label>
            <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][taskbar]" value="top" <?php if($setting['desktop_default']['taskbar']=='top') { ?>checked<?php } ?>>顶部</label>
            <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][taskbar]" value="bottom" <?php if($setting['desktop_default']['taskbar']=='bottom') { ?>checked<?php } ?>>底部</label>
          </dd>
          <dd class="clearfix">
          		<span class="help-inline">默认的任务栏位置。（用户设置后，以用户设置为准）</span>
          </dd>
        </dl>
        <dl><dt>桌面图标大小：</dt>
        	<dd class="clearfix">
            	<select name="settingnew[desktop_default][iconview]" class="form-control">
                   <?php if(is_array($iconview)) foreach($iconview as $value) { ?>                   <option value="<?php echo $value['id'];?>" <?php if($value['id']==$setting['desktop_default']['iconview']) { ?>selected="selected"<?php } ?>><?php echo $value['name'];?></option>
                   
                   <?php } ?>
                </select>
            </dd>
            <dd class="clearfix">
                    <span class="help-inline">默认的桌面图标大小。（用户设置后，以用户设置为准）</span>
             </dd>
        </dl>
        <dl>
          <dt>图标排列位置：</dt>
           <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][iconposition]" value="0" <?php if($setting['desktop_default']['iconposition']=='0') { ?>checked<?php } ?>>左上角</label>
            <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][iconposition]" value="1" <?php if($setting['desktop_default']['iconposition']=='1') { ?>checked<?php } ?>>右上角</label>
             <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][iconposition]" value="2" <?php if($setting['desktop_default']['iconposition']=='2') { ?>checked<?php } ?>>右下角</label>
              <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][iconposition]" value="3" <?php if($setting['desktop_default']['iconposition']=='3') { ?>checked<?php } ?>>左下角</label>
               <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][iconposition]" value="4" <?php if($setting['desktop_default']['iconposition']=='4') { ?>checked<?php } ?>>居中</label>
           
          </dd>
             <dd class="clearfix">
                    <span class="help-inline">默认的桌面图标排列起始位置。（用户设置后，以用户设置为准）</span>
             </dd>
        </dl>
         <dl>
          <dt>图标排列方向：</dt>
           <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][direction]" value="0" <?php if($setting['desktop_default']['direction']=='0') { ?>checked<?php } ?>>纵向排列</label>
            <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][direction]" value="1" <?php if($setting['desktop_default']['direction']=='1') { ?>checked<?php } ?>>横向排列</label>
           
          </dd>
          <dd class="clearfix">
                    <span class="help-inline">默认的桌面图标排列方向。（用户设置后，以用户设置为准）</span>
             </dd>
        </dl>
        
       <dl><dd><input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit" value="保存更改" type="submit" ></dd> </dl>
      </form>  
 <?php } elseif($operation=='loginset') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="loginset" name="operation">
        <dl>
          <dt>启用独立登录页：</dt>
           <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[loginset][available]" value="0" <?php if(!$setting['loginset']['available']) { ?>checked<?php } ?>>不启用</label>
            <label class="radio-inline "><input type="radio" name="settingnew[loginset][available]" value="1" <?php if($setting['loginset']['available']==1) { ?>checked<?php } ?>>启用</label>
          </dd>
          <dd class="clearfix">
          		<span class="help-inline">启用独立登录页后，未登录用户默认首页为此登录页。</span>
          </dd>
        </dl>
        <dl><dt>页面主标题：</dt>
        	<dd class="clearfix">
            	<input type="text" class="form-control" name="settingnew[loginset][title]" value="<?php echo $setting['loginset']['title'];?>" />
            </dd>
            <dd class="clearfix">
                    <span class="help-inline">独立登录页左侧大标题。</span>
             </dd>
        </dl>
         <dl><dt>页面副标题：</dt>
        	<dd class="clearfix">
            	<input type="text" class="form-control" name="settingnew[loginset][subtitle]" value="<?php echo $setting['loginset']['subtitle'];?>" />
            </dd>
            <dd class="clearfix">
                    <span class="help-inline">独立登录页左侧副标题。</span>
             </dd>
        </dl>
         <dl><dt>页面背景：</dt>
        	<dd class="clearfix">
            	<input type="text" class="form-control" name="settingnew[loginset][background]" value="<?php echo $setting['loginset']['background'];?>" />
            </dd>
            <dd class="clearfix">
                    <span class="help-inline">可以为颜色(如:#FFF);图片(以.jpeg,.jpg,.png结尾)或网址。</span>
             </dd>
        </dl>
       <dl><dd><input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit" value="保存更改" type="submit" ></dd> </dl>
      </form>    
  <?php } elseif($operation=='mail') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="mail" name="operation">
        <dl>
          <dt>管理员邮箱:</dt>
          <dd class="clearfix">
            <input type="text" class="form-control" id="adminemail" name="settingnew[adminemail]"  value="<?php echo $setting['adminemail'];?>">
            <span class="help-block text-muted"> 管理员 E-mail，将作为系统发邮件的时候的发件人地址</span></dd>
        </dl>
        <dl>
          <dt>邮件发送方式:</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailsend]" value="1" <?php if($setting['mail']['mailsend']=='1') { ?>checked<?php } ?> onclick="$('hidden1').style.display='none';$('hidden2').style.display='none';"> 通过 PHP 函数的 sendmail 发送(推荐此方式)</label>
          </dd>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailsend]" value="2" <?php if($setting['mail']['mailsend']=='2') { ?>checked<?php } ?> onclick="$('hidden1').style.display='table';$('hidden2').style.display='none';">  通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)</label>
          </dd>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailsend]" value="3" <?php if($setting['mail']['mailsend']=='3') { ?>checked<?php } ?> onclick="$('hidden2').style.display='table';$('hidden1').style.display='none';">  通过 PHP 函数 SMTP 发送 Email(仅 Windows 主机下有效，不支持 ESMTP 验证)</label>
          </dd>
          <dd class="clearfix">
            <table id="hidden1" class="table text-center" style="margin-bottom:0; <?php if($setting['mail']['mailsend']!=2) { ?>display:none<?php } ?>">
              <thead>
                <tr>
                  <th>删除</th>
                  <th>SMTP 服务器</th>
                  <th>端口</th>
                  <th>验证</th>
                  <th>发信人邮件地址</th>
                  <th>SMTP 身份验证用户名</th>
                  <th>SMTP 身份验证密码</th>
                </tr>
              </thead>
              <?php if(is_array($smtps)) foreach($smtps as $id => $smtp) { ?>              <tr>
                <td ><label>
                    <input  type="checkbox" name="settingnew[mail][esmtp][delete][]" value="<?php echo $id;?>" />
                  </label></td>
                <td><input class="form-control" style="width:120px;" type="text" name="settingnew[mail][esmtp][<?php echo $id;?>][server]" value="<?php echo $smtp['server'];?>" /></td>
                <td width="40"><input class="form-control" style="width:30px" type="text" name="settingnew[mail][esmtp][<?php echo $id;?>][port]" value="<?php echo $smtp['port'];?>" /></td>
                <td width="40"><label>
                    <input type="checkbox" name="settingnew[mail][esmtp][<?php echo $id;?>][auth]" value="1" <?php echo $smtp['authcheck'];?> />
                  </label></td>
                <td><input class="form-control" style="width:120px;" type="text" name="settingnew[mail][esmtp][<?php echo $id;?>][from]" value="<?php echo $smtp['from'];?>" /></td>
                <td><input class="form-control" style="width:100px;" type="text" name="settingnew[mail][esmtp][<?php echo $id;?>][auth_username]" value="<?php echo $smtp['auth_username'];?>" /></td>
                <td><input class="form-control" style="width:100px;" type="text" name="settingnew[mail][esmtp][<?php echo $id;?>][auth_password]" value="<?php echo $smtp['auth_password'];?>" /></td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="7" align="left"><a href="javascript:;" onclick="addSMTP(this,1)"><i class="glyphicon glyphicon-plus"></i>添加新SMTP服务器</a></td>
              </tr>
            </table>
            <table id="hidden2" class="table" style="margin-bottom:0; <?php if($setting['mail']['mailsend']!=3) { ?>display:none<?php } ?>">
              <thead>
              
                <th>删除</th>
                <th>SMTP 服务器</th>
                <th>端口</th>
                  </thead>
                <?php if(is_array($smtps)) foreach($smtps as $id => $smtp) { ?>              <tr>
                <td><label>
                    <input type="checkbox" name="settingnew[mail][smtp][delete][]" value="<?php echo $id;?>" />
                  </label></td>
                <td><input class="form-control"  type="text" name="settingnew[mail][smtp][<?php echo $id;?>][server]" value="<?php echo $smtp['server'];?>" /></td>
                <td width="60"><input class="form-control"  style="width:50px" type="text" name="settingnew[mail][smtp][<?php echo $id;?>][port]" value="<?php echo $smtp['port'];?>" /></td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="7" align="left"><a href="javascript:;" onclick="addSMTP(this,0)"><i class="glyphicon glyphicon-plus"></i>添加新SMTP服务器</a></td>
              </tr>
            </table>
          </dd>
        </dl>
        <dl>
          <dt>邮件头的分隔符:</dt>
          <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[mail][maildelimiter]" value="1"<?php if($setting['mail']['maildelimiter']=='1') { ?>checked<?php } ?>>  使用 CRLF 作为分隔符(通常为 Windows 主机)</label>
          </dd>
          <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[mail][maildelimiter]" value="0"<?php if($setting['mail']['maildelimiter']=='0') { ?>checked<?php } ?>>  使用 LF 作为分隔符(通常为 Unix/Linux 主机)</label>
          </dd>
          <dd class="clearfix">
            <label class="radio-inline "><input type="radio" name="settingnew[mail][maildelimiter]" value="2"<?php if($setting['mail']['maildelimiter']=='2') { ?>checked<?php } ?>> 使用 CR 作为分隔符(通常为 Mac 主机)</label>
          </dd>
          <dd class="clearfix"><span class="help-block "> 请根据您邮件服务器的设置调整此参数</span></dd>
        </dl>
        <dl>
          <dt>收件人地址中包含用户名:</dt>
          <dd class="clearfix">
            <label class="radio-inline ">
              <input type="radio" name="settingnew[mail][mailusername]" value="1" checked >
              是</label>
            &nbsp;&nbsp;
            <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailusername]" value="0"<?php if(!$setting['mail']['mailusername']) { ?>checked<?php } ?>> 否</label>
          </dd>
        </dl>
        <dl>
          <dt>屏蔽邮件发送中的全部错误提示:</dt>
          <dd class="clearfix">
            <label class="radio-inline ">
              <input type="radio" name="settingnew[mail][sendmail_silent]" value="1" checked >
              是</label>
            &nbsp;&nbsp;
            <label class="radio-inline "><input type="radio" name="settingnew[mail][sendmail_silent]" value="0"<?php if(!$setting['mail']['sendmail_silent']) { ?>checked<?php } ?>> 否</label>
          </dd>
        </dl>
        <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit" value="保存更改" type="submit" >
      </form>
      <script>
function addSMTP(obj,p){
var html='';
html+='<tr>';
 html+=' <td>&nbsp;</td>';
 html+=' <td><input class="form-control" style="width:120px;" type="text"  name="newsmtp[server][]" class="txt"></td>';
 html+='<td><input class="form-control" style="width:30px" type="text" value="25" name="newsmtp[port][]" class="txt"></td>';
if(p>0){
 html+=' <td><label><input type="checkbox" value="1" name="newsmtp[auth][]"></label></td>';
 html+=' <td><input class="form-control" style="width:120px;" type="text"  name="newsmtp[from][]" class="txt"></td>';
 html+=' <td ><input class="form-control" style="width:100px;" type="text"  name="newsmtp[auth_username][]" class="txt"></td>';
 html+=' <td><input class="form-control" style="width:100px;" type="text"  name="newsmtp[auth_password][]" class="txt"></td>';
}
html+='</tr>';
jQuery(obj).parent().parent().before(html);
}

</script> 
      <?php } elseif($operation=='access') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="access" name="operation">
        <dl>
          <dt>允许新用户注册:</dt>
          <dd class="clearfix">
            <label class="checkbox-inline"> <input type="checkbox"  name="settingnew[regstatus]"  value="1" <?php if($setting['regstatus']>0) { ?>checked="checked"<?php } ?>>开放注册</label>
            <span class="help-inline" >设置是否允许游客注册成为平台会员，您可以根据平台需求选择注册方式</span> </dd>
        </dl>
        <dl>
          <dt>注册链接文字:</dt>
          <dd class="clearfix">
            <input type="text" class="form-control"  name="settingnew[reglinkname]"  value="<?php echo $setting['reglinkname'];?>" >
            <span class="help-inline text-muted" >设置平台注册页的链接文字，默认为“立即注册”</span> </dd>
        </dl>
        <dl>
          <dt>密码最小长度:</dt>
          <dd class="clearfix">
            <input type="text" class="form-control" name="settingnew[pwlength]"  value="<?php echo $setting['pwlength'];?>" >
            <span class="help-inline text-muted" >新用户注册时密码最小长度，0或不填为不限制</span> </dd>
        </dl>
        <dl>
          <dt>强制密码复杂度:</dt>
          <dd class="clearfix">
            <label class="checkbox-inline" ><input type="checkbox" name="settingnew[strongpw][]" value="1" <?php if(in_array(1,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />数字</label>
          </dd>
          <dd class="clearfix">
            <label class="checkbox-inline"><input type="checkbox" name="settingnew[strongpw][]" value="2" <?php if(in_array(2,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />小写字母</label>
          </dd>
          <dd class="clearfix">
            <label class="checkbox-inline"><input type="checkbox" name="settingnew[strongpw][]" value="3" <?php if(in_array(3,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />大写字母</label>
          </dd>
          <dd class="clearfix">
            <label class="checkbox-inline"><input type="checkbox" name="settingnew[strongpw][]" value="4" <?php if(in_array(4,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />符号</label>
          </dd>
          <dd class="clearfix"><span class="help-block" >新用户注册时密码中必须存在所选字符类型，不选则为无限制</span></dd>
        </dl>
        <dl>
          <dt>新用户注册验证:</dt>
          <dd class="clearfix">
            <label class="radio radio-inline" >
              <input type="radio" name="settingnew[regverify]" value="0" checked="checked" />
              无</label>
          </dd>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio" name="settingnew[regverify]" value="1"  <?php if($setting['regverify']==1) { ?>checked<?php } ?> />Email验证</label>
          </dd>
          <!--<dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="settingnew[regverify]" value="2"  <?php if($setting['regverify']==2) { ?>checked<?php } ?> />人工审核
          </label>
          </dd>
          -->
          <dd class="clearfix"><span class="help-block">选择“无”用户可直接注册成功；选择“Email 验证”将向用户注册 Email 发送一封验证邮件以确认邮箱的有效性，用户点击邮件中的链接完成激活；<!--选择“人工审核”将由管理员人工逐个确定是否允许新用户注册--></span></dd>
        </dl>
        <!--<dl>
           		<dt>发送欢迎信息:</dt>
                <dd ><label class="checkbox inline" ><input type="checkbox" name="settingnew[welcomemsg][]" value="1" <?php if(in_array(1,$welcomemsg)) { ?>checked<?php } ?> /> 发送欢迎信息
        </label>
        </dd>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" name="settingnew[welcomemsg][]" value="2" <?php if(in_array(2,$welcomemsg)) { ?>checked<?php } ?> /> 发送欢迎 Email</label>
        </dd>
        <dd class="clearfix"><span class="help-block" > 系统发送的欢迎信息的标题，不支持 HTML，不超过 75 字节</span></dd>
        </dl>
        <dl>
          <dt>欢迎信息内容:</dt>
          <dd class="clearfix">
            <textarea class="form-control"  type="texterea" name="settingnew[welcomemsgtxt]" rows="5"><?php echo $setting['welcomemsgtxt'];?></textarea>
            <ul class="help-block" >
              <li>系统发送的欢迎信息的内容。标题内容均支持变量替换，可以使用如下变量:</li>
              <li>{username} : 用户名</li>
              <li>{time} : 发送时间</li>
              <li>{sitename} : 网站名称（显示在页面底部的联系方式处的名称）</li>
              <li>{bbname} : 平台名称（显示在浏览器窗口标题等位置的名称）</li>
              <li> {adminemail} : 管理员 Email</li>
            </ul>
          </dd>
        </dl>
        -->
        <dl>
          <dt>显示网站服务条款:</dt>
          <dd >
            <label class="radio radio-inline" ><input type="radio" name="settingnew[bbrules]" value="1" <?php if($setting['bbrules']>0) { ?>checked<?php } ?> onclick="jQuery('#bbrules_more').show()" />是</label>
            <label class="radio radio-inline" ><input type="radio" name="settingnew[bbrules]" value="0" <?php if($setting['bbrules']<1) { ?>checked<?php } ?> onclick="jQuery('#bbrules_more').hide()" />否</label>
            <span class="help-block" >新用户注册时显示网站服务条款</span>
            <dl id="bbrules_more" style="<?php if($setting['bbrules']>0) { ?>display:block<?php } else { ?>display:none<?php } ?>">
              <dt>是否强制显示网站服务条款：</dt>
              <dd class="clearfix">
                <label class="radio radio-inline" ><input type="radio" name="settingnew[bbrulesforce]" value="1" <?php if($setting['bbrulesforce']>0) { ?>checked<?php } ?> />是</label>
                <label class="radio radio-inline" ><input type="radio" name="settingnew[bbrulesforce]" value="0" <?php if($setting['bbrulesforce']<1) { ?>checked<?php } ?> />否</label>
              </dd>
              </dl>
              <dl>
                <dt>服务条款内容：</dt>
                <dd class="clearfix">
                  <textarea class="form-control" type="texterea" name="settingnew[bbrulestxt]" rows="5"><?php echo $setting['bbrulestxt'];?></textarea>
                  <span class="help-inline">网站服务条款的详细内容</span> </dd>
              </dl>
            </dl>
          </dd>
        </dl>
        <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit" value="保存更改" type="submit" >
      </form>
      <?php } elseif($operation=='smiley') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting"  class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="smiley" name="operation">
        <dl>
          <dt>表情图片的宽高:</dt>
          <dd class="clearfix">
            <input type="text" class="form-control"  name="settingnew[smthumb]"  value="<?php echo $setting['smthumb'];?>" >
            <span class="help-inline text-muted" >允许范围在 20～40 之间，图片实际尺寸超出设置值时将自动缩略显示</span> </dd>
        </dl>
        <dl>
          <dt>表情列数:</dt>
          <dd class="clearfix">
            <input type="text"  class="form-control"  name="settingnew[smcols]"  value="<?php echo $setting['smcols'];?>" >
            <span class="help-inline text-muted" >表情显示的列数，允许范围在 8～12之间</span> </dd>
        </dl>
        <dl>
          <dt>表情行数:</dt>
          <dd class="clearfix">
            <input type="text"  class="form-control"   name="settingnew[smrows]"  value="<?php echo $setting['smrows'];?>" >
            <span class="help-inline text-muted" >表情显示的行数</span> </dd>
        </dl>
        <input class="btn btn-primary"  name="settingsubmit" value="保存更改" type="submit" >
      </form>
      
      <?php } elseif($operation=='datetime') { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left"  method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="datetime" name="operation">
        <dl>
          <dt>默认日期格式:</dt>
          <dd class="clearfix">
            <input type="text"  name="settingnew[dateformat]" class="form-control"  value="<?php echo $setting['dateformat'];?>" >
            <span class="help-inline text-muted" >使用 yyyy(yy) 表示年，mm 表示月，dd 表示天。如 yyyy-mm-dd 表示 2000-1-1</span> </dd>
        </dl>
        <dl>
          <dt>默认时间格式:</dt>
          <dd class="clearfix">
            <label class="radio radio-inline" >
              <input type="radio" name="settingnew[timeformat]" value="24" <?php echo $checktimeformat['24'];?> />
              24 小时制 </label>
            <label class="radio radio-inline">
              <input type="radio" name="settingnew[timeformat]" value="12" <?php echo $checktimeformat['12'];?> />
              12 小时制 </label>
          </dd>
        </dl>
        <dl>
          <dt>人性化时间格式:</dt>
          <dd class="clearfix">
            <label class="radio radio-inline" ><input type="radio" name="settingnew[dateconvert]" value="1" <?php if($setting['dateconvert']>0) { ?>checked<?php } ?> /> 是 </label>
            <label class="radio radio-inline"><input type="radio" name="settingnew[dateconvert]" value="0" <?php if($setting['dateconvert']<1) { ?>checked<?php } ?> /> 否 </label>
          </dd>
          </dd>
          <dd class="clearfix"><span class="help-block">选择“是”，平台中的时间将显示以“n分钟前”、“昨天”、“n天前”等形式显示</span>
        </dl>
        <dl>
          <dt>默认时差:</dt>
          <dd class="clearfix" >
            <select onchange="if(this.value !== '')$('settingnew[timeoffset]').value=this.value;" style="width:350px" name="global_timeoffset" class="form-control">
              <?php if(is_array($timezones)) foreach($timezones as $key => $value) { ?> 
              <option value="<?php echo $key;?>" <?php if($key==$setting['timeoffset']) { ?>selected="selected"<?php } ?>><?php echo cutstr($value, 40, '..')?>              </option>
              <?php } ?>
            </select>
          </dd>
          <dd class="clearfix" style="margin-top:10px;">
            <input type="text" name="settingnew[timeoffset]" class="form-control" value="<?php echo $setting['timeoffset'];?>" style="width:350px" id="settingnew[timeoffset]">
          </dd>
          <dd class="clearfix"><span class="help-block" >当地时间与 GMT 的时差。遇夏制时的情况也可以手动输入，如：-7.5</span></dd>
        </dl>
        <input class="btn btn-primary"  name="settingsubmit" value="保存更改" type="submit" >
      </form>
      <?php } elseif($operation=='sec') { ?>
      <dl class="clearfix">
          <dt>提示信息</dt>
          <ul class="help-block">
            <li>使用图片作为验证码文字，图片必须包含字符“2346789BCEFGHJKMPQRTVWXY”24 个字符，且必须为 GIF 透明图片、背景透明、前景黑色，黑色为图片的第一个索引色。图片大小不限制，但建议宽度不大于验证码宽度的 1/4，高度不大于验证码高度。制作完毕后在 static/image/seccode/gif/ 下创建一个新的子目录，目录名任意，把制作完毕的 24 个 GIF 图片上传到新子目录下</li>
            <li>使用图片作为验证码的背景，把制作好的 JPG 图片上传到 static/image/seccode/background/ 目录下，平台将随机使用里面的图片作为验证码的背景</li>
            <li>使用 TTF 字体作为验证码文字，把下载的 TTF 英文字体文件上传到 static/image/seccode/font/en/ 目录下，平台将随机使用里面的字体文件作为验证码的文字</li>
            <li>使用中文图片验证码前，需要把包含完整中文汉字的 TTF 中文字体文件上传到 static/image/seccode/font/ch/ 目录下，平台将随机使用里面的字体文件作为验证码的文字</li>
            <li>系统验证码位于 core/class/seccode/ 目录中。</li>
          </ul>
      </dl>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="sec" name="operation">
        <dl>
          <dt>启用验证码:</dt>
          <dd class="clearfix">
            <label class="checkbox-inline"><input  type="checkbox" value="1" name="settingnew[seccodestatus][1]" <?php if($seccodestatus['1']>0) { ?>checked<?php } ?>> 新用户注册</label>
          </dd>
          <dd class="clearfix">
            <label class="checkbox-inline"><input  type="checkbox" value="1" name="settingnew[seccodestatus][2]" <?php if($seccodestatus['2']>0) { ?>checked<?php } ?>> 用户登录</label>
          </dd>
          <dd class="clearfix">
            <label class="checkbox-inline"><input  type="checkbox" value="1" name="settingnew[seccodestatus][3]" <?php if($seccodestatus['3']>0) { ?>checked<?php } ?>> 修改密码</label>
          </dd>
          <dd class="clearfix"><span class="help-block">验证码可以避免恶意注册及登录，请选择需要打开验证码的操作。注意: 启用验证码会使得部分操作变得繁琐，建议仅在必需时打开</span></dd>
        </dl>
        <dl>
          <dt>验证码类型:</dt>
          <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" onclick="$('seccodeimageext').style.display = '';$('seccodeimagewh').style.display = '';" <?php if($setting['seccodedata']['type']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][type]"> 英文图片验证码 </label></dd>
          <dd class="clearfix"><label class="radio radio-inline" ><input  type="radio" onclick="$('seccodeimageext').style.display = '';$('seccodeimagewh').style.display = '';" <?php if($setting['seccodedata']['type']==1) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][type]"> 中文图片验证码 </label></dd>
          <dd class="clearfix"><label class="radio radio-inline" ><input  type="radio" onclick="$('seccodeimageext').style.display = 'none';$('seccodeimagewh').style.display = '';" <?php if($setting['seccodedata']['type']==2) { ?>checked<?php } ?> value="2" name="settingnew[seccodedata][type]">  Flash 验证码 </label></dd>
          <dd class="clearfix"><label class="radio radio-inline" ><input  type="radio" onclick="$('seccodeimageext').style.display = 'none';$('seccodeimagewh').style.display = 'none';" <?php if($setting['seccodedata']['type']==3) { ?>checked<?php } ?> value="3" name="settingnew[seccodedata][type]"> 语音验证码 </label></dd>
          <dd class="clearfix"><label class="radio radio-inline" ><input  type="radio" onclick="$('seccodeimageext').style.display = 'none';$('seccodeimagewh').style.display = 'none';" <?php if($setting['seccodedata']['type']==99) { ?>checked<?php } ?> value="99" name="settingnew[seccodedata][type]">  位图验证码 </label></dd>
           <dd class="clearfix"> <span class="help-block">设置验证码的类型。中文图片验证码需要您的主机支持 FreeType 库。要显示 Flash 验证码，建议您的主机支持 Ming 库以提高安全性</span></dd>
           <dd class="clearfix">
           	   <dl>
             	 <dt>验证码预览 </dt>
                <dd class="clearfix">
                  <?php include template('common/seccheck'); ?> 
                </dd>
              </dl>
          </dd>
          <dd  id="seccodeimagewh" <?php if($setting['seccodedata']['type']<3) { ?>style="display:block"<?php } else { ?>style="display:none"<?php } ?>>
          <dl>
            <dt>验证码图片宽度</dt>
            <dd class="clearfix">
              <input type="text" class="form-control" value="<?php echo $setting['seccodedata']['width'];?>" name="settingnew[seccodedata][width]">
              <span class="help-inline">验证码图片的宽度，范围在 100～200 之间</span>
          </dl>
          <dl>
            <dt>验证码图片高度</dt>
            <dd class="clearfix">
              <input type="text" class="form-control" value="<?php echo $setting['seccodedata']['height'];?>" name="settingnew[seccodedata][height]">
              <span class="help-inline">验证码图片的高度，范围在 30～80 之间</span>
          </dl>
          </dd>
          <dd  id="seccodeimageext" <?php if($setting['seccodedata']['type']<2) { ?>style="display:block"<?php } else { ?>style="display:none"<?php } ?>>
          <dl>
            <dt>图片打散</dt>
            <dd class="clearfix">
              <input type="text" class="form-control" value="<?php echo $setting['seccodedata']['scatter'];?>" name="settingnew[seccodedata][scatter]">
              <span class="help-inline">打散生成的验证码图片，输入打散的级别，0 为不打散</span>
          </dl>
          <dl>
            <dt>随机图片背景</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['background']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][background]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['background']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][background]"> 否 </label>
              <span class="help-block">选择“是”将随机使用 static/image/seccode/background/ 目录下的 JPG 图片作为验证码的背景图片，选择“否”将使用随机的背景色</span>
          </dl>
          <dl>
            <dt>随机背景图形</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['adulterate']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][adulterate]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['adulterate']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][adulterate]"> 否 </label>
              <span class="help-block">选择“是”将给验证码背景增加随机的图形</span>
          </dl>
          <dl>
            <dt>随机 TTF 字体</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['ttf']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][ttf]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['ttf']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][ttf]"> 否 </label>
              <ul class="help-block">
                <li>选择“是”将随机使用 static/image/seccode/font/en/ 目录下的 TTF 字体文件生成验证码文字</li>
                <li>选择“否”将随机使用 static/image/seccode/gif/ 目录中的 GIF 图片生成验证码文字</li>
                <li>中文图片验证码将随机使用 static/image/seccode/font/ch/ 目录下的 TTF 字体文件，无需进行此设置</li>
              </ul>
          </dl>
          <dl>
            <dt>随机倾斜度</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['angle']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][angle]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['angle']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][angle]"> 否 </label>
              <span class="help-block">选择“是”将给验证码文字增加随机的倾斜度，本设置只针对 TTF 字体的验证码</span>
          </dl>
          <dl>
            <dt>随机扭曲</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['warping']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][warping]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['warping']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][warping]"> 否 </label>
              <span class="help-block">选择“是”将给验证码文字增加随机的扭曲，本设置只针对 TTF 字体的验证码</span>
          </dl>
          <dl>
            <dt>随机颜色</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['color']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][color]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['color']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][color]"> 否 </label>
              <span class="help-block">选择“是”将给验证码的背景图形和文字增加随机的颜色</span>
          </dl>
          <dl>
            <dt>随机大小</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['size']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][size]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['size']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][size]"> 否 </label>
              <span class="help-block">选择“是”验证码文字的大小随机显示</span>
          </dl>
          <dl>
            <dt>文字阴影</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['shadow']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][shadow]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['shadow']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][shadow]"> 否 </label>
              <span class="help-block">选择“是”将给验证码文字增加阴影</span>
          </dl>
          <dl>
            <dt>GIF 动画</dt>
            <dd class="clearfix">
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['animator']>0) { ?>checked<?php } ?> value="1" name="settingnew[seccodedata][animator]"> 是 </label>
              <label class="radio radio-inline" ><input  type="radio" <?php if($setting['seccodedata']['animator']<1) { ?>checked<?php } ?> value="0" name="settingnew[seccodedata][animator]"> 否 </label>
              <span class="help-block">选择“是”验证码将显示成 GIF 动画方式，选择“否”验证码将显示成静态图片方式</span>
          </dl>
          </dd>
        </dl>
        <input class="btn btn-primary"  name="settingsubmit" value="保存更改" type="submit" >
      </form>
      <?php } elseif($operation=='censor') { ?>
     
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="censor" name="operation">
        <dl>
          <dt>敏感词替换为:</dt>
          <dd class="clearfix">
            <input type="text" class="form-control" name="replace" value="<?php echo $replace;?>" /> 
            <span class="help-inline">敏感词将会被替换为此处设置的字符</span>
          </dd>
         
        </dl>
        <dl>
          <dt>需要替换的敏感词:</dt>
          <dd class="clearfix">
            <textarea  class="form-control" name="badwords" rows="10" style="width:100%" /><?php echo $badwords;?></textarea>
            <span class="help-block">多个词请使用半角的逗号隔开</span>
          </dd>
         
        </dl>
        
        <input class="btn btn-primary"  name="settingsubmit" value="保存更改" type="submit" >
      </form>
      <?php } elseif($operation=='qywechat') { ?>
     
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post" name="cpform" onsubmit="return validate(this);">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="true" name="settingsubmit">
        <input type="hidden" value="qywechat" name="operation">
        <dl>
          <dt>CorpID:</dt>
          <dd class="clearfix">
            <input type="text" id="CorpID" class="form-control" name="settingnew[CorpID]" value="<?php echo $setting['CorpID'];?>" required="true" /> 
            <span class="help-block">此项是开发者凭据，您需登录［微信企业号平台］，去[设置]-［权限管理］-[管理]-[选择需要与DzzOffice平台绑定的管理组]，下拉至底部复制CorpID的值</span>
          </dd>
         
        </dl>
        <dl>
          <dt>CorpSecret:</dt>
          <dd class="clearfix">
            <input type="text" id="CorpSecret"  class="form-control" name="settingnew[CorpSecret]" value="<?php echo $setting['CorpSecret'];?>" required="true" />
            <span class="help-block">此项是开发者凭据，您需登录［微信企业号平台］，去[设置]-［权限管理］-[管理]-[选择需要与DzzOffice平台绑定的管理组]，下拉至底部复制Secret的值</span>
          </dd>
         
        </dl>
         <dl>
          <dt>同步范围:</dt>
        	<dd class="clearfix">
            	<div class="dropdown">
                          <input id="sel_syndepartment"  type="hidden" name="settingnew[synorgid]"  value="<?php echo $setting['synorgid'];?>" />
                          <button type="button" id="syndepartment_Menu" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?php echo $syndepartment;?> <span class="caret"></span>
                          </button>
                          <div id="syndepartment_dropdown_menu" class="dropdown-menu org-sel-box" role="menu" aria-labelledby="syndepartment_Menu">
                               <iframe name="orgids_iframe" class="org-sel-box-iframe" src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=syndepartment&amp;nouser=1" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" ></iframe>
                          </div>
                    </div>
            </dd>
             <ul class="help-block" style="line-height:2">
                <li>只有同步范围内的用户才会同步到微信</li>
                <li>不在同步范围内的用户如果已经在微信里，将会被禁用</li>
                <li>如果微信企业号用户上限够用，请尽量设置全部</li>
                
            </ul>
         </dl>
        <dl>
            <dd>
            <input type="hidden" id="fbind" name="fbind" value="bind" />
            <button class="btn btn-success btn-width" onclick="document.getElementById('cpform').onsubmit();" >绑定</button>
            &nbsp;&nbsp;<button class="btn btn-danger btn-width" onclick="document.getElementById('fbind').value='unbind';document.getElementById('cpform').onsubmit();">解绑</button>
            
            </dd>
        </dl> 
        
      </form>
      <script type="text/javascript">
  	var selorg={};

//添加
selorg.add=function(ctrlid,vals){
if(vals.length>0){
if(vals[0].orgid=='other') vals[0].path='无机构用户';
jQuery('#'+ctrlid+'_Menu').html(vals[0].path+' <span class="caret"></span>');
jQuery('#sel_'+ctrlid).val(vals[0].orgid);
}else{
jQuery('#'+ctrlid+'_Menu').html('全部用户 <span class="caret"></span>');
jQuery('#sel_'+ctrlid).val(0);
}
}

   function validate(form){
   if(document.getElementById('CorpID').value==''){
   document.getElementById('CorpID').focus();
   return false;
   }
    if(document.getElementById('CorpSecret').value==''){
   document.getElementById('CorpSecret').focus();
   return false;
   }
   form.submit();
   }
  </script>  
      <?php } ?> 
    </div>
  </div>
</div>
<script type="text/javascript">  
jQuery('.left-drager').leftDrager_layout();	
jQuery(document).ready(function(e) {
    jQuery('input').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue',
});
jQuery('input').on('ifChecked',function(e){
jQuery(this).trigger('click');
});
jQuery('select').select2({
createSearchChoicePosition:function(){}
});
jQuery('input[required]').on('blur',function(){
 if(this.value==''){jQuery(this).addClass('input-error')}else{jQuery(this).removeClass('input-error');}
 });
 jQuery('input[required]').on('change',function(){
 if(this.value==''){jQuery(this).addClass('input-error')}else{jQuery(this).removeClass('input-error');}
 });
});


</script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="static/icheck/icheck.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="static/select2/select2.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="static/select2/select2_locale_zh-CN.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php include template('common/footer_simple'); ?> 