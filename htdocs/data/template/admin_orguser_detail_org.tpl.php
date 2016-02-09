<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<div class="main-header" style="line-height:39px;padding:0 15px;">
<b><?php if($org['forgid']<1) { ?>机构<?php } else { ?>部门<?php } ?>名称：<?php echo $org['orgname'];?> </b>
    <?php if($_G['adminid']==1) { ?><a href="<?php echo ADMINSCRIPT;?>?mod=orguser&op=export&orgid=<?php echo $orgid;?>" class="btn btn-link pull-right" title="导出此部门的所有用户到excl文件" target="_blank">导出用户</a><?php } ?>
</div>
<div class="main-body" style="padding:15px 15px 15px 22px;">
    <?php if($folder_available) { ?>
    <dl>
    	<dt>共享目录设置:</dt>
        <dd class="clearfix">
        	<label class="radio-inline"><input type="radio" id="folder_available_1" name="fid" value="1" <?php if($org['available']>0) { ?>checked="checked"<?php } ?>      onclick="folder_available(1,'<?php echo $orgid;?>');"  />启用</label>
            <label class="radio-inline ml20"><input type="radio" id="folder_available_0" name="fid"  value="0" <?php if($org['available']<1) { ?>checked="checked"<?php } ?> onclick="folder_available(0,'<?php echo $orgid;?>');" />不启用</label>
           <?php if($org['forgid']<1) { ?> 
           		<span class="help-inline ml20">如不启用，下级所有部门中将不能使用共享目录；启用后，企业盘才会显示共享目录。</span>
           <?php } else { ?>
          	 <span class="help-inline ml20">启用后，企业盘机构下才会显示此部门的共享目录。</span>
           <?php } ?>
        </dd>
    </dl>
    <dl id="indesk" <?php if($org['available']<1) { ?>style="display:none"<?php } ?>>
    	<dt>共享目录桌面快捷方式:</dt>
        <dd class="clearfix">
        	<label class="radio-inline"><input type="radio" id="folder_indesk_1" onclick="folder_indesk(1,'<?php echo $orgid;?>');" name="indesk" value="1" <?php if($org['indesk']>0) { ?>checked="checked"<?php } ?> />创建</label>
            <label class="radio-inline"><input type="radio" id="folder_indesk_0" onclick="folder_indesk(0,'<?php echo $orgid;?>');" name="indesk" value="0" <?php if($org['indesk']<1) { ?>checked="checked"<?php } ?> />不创建</label>
            <span class="help-inline ml20">创建快捷方式后，所属成员桌面默认都会有相应快捷方式。</span>
        </dd>
    </dl> 
    <?php } ?>
    <dl>
    	<dt>职位管理:</dt>
        <dd class="clearfix jobs">
        <?php if(is_array($jobs)) foreach($jobs as $value) { ?>            <div id="job_<?php echo $value['jobid'];?>" orgid="<?php echo $value['orgid'];?>" class="job-item-edit pull-left mb10">
                <button onclick="job_show_editor('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>', this)"  class="btn btn-simple job-name mr20"><?php echo $value['name'];?></button>
                <div class="edit hide" style="min-width:250px">
                    <div class="job-edit-control pull-left" >
                    <input type="text" class="form-control" value="<?php echo $value['name'];?>" style="width:100px" onkeyup="if(event.keyCode==13){job_save('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>');return false;}">
                    </div>
                    <button onclick="job_save('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>')" data-loading-text="保存" class="btn btn-success job-save">保存 </button>
                    <button class="btn btn-link todo-del" onclick="job_del('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>')"> 删除 </button>
                </div> 
        	</div>
            <?php } ?>
        	<div  class="new-job pull-left" style="padding:0 10px;"> 
                	<a href="javascript:;" onclick="job_show_add_editor('<?php echo $orgid;?>',this)" class="btn btn-simple "> 添加职位 </a>
                  <div class="new-job-control hide" style="min-width:250px">
                    <div class="pull-left">
                      <input type="text" class="new-job-text form-control" style="width:100px" onkeyup="if(event.keyCode==13){job_add('<?php echo $orgid;?>');return false;}" placeholder="职位名称">
                    </div>
                    <button class="btn btn-success" data-loading-text="添加" onclick="job_add('<?php echo $orgid;?>')">添加 </button>
                    <button class="btn btn-link job-del" onclick="job_cancel_add_editor('<?php echo $orgid;?>')"> 取消 </button>
                  </div>
                 
                </div>
        </dd>
        
    </dl>
    
    <dl>
    	<dt><?php if($org['forgid']<1) { ?>机构<?php } else { ?>部门<?php } ?>管理员</dt>
        <dd class="clearfix">
        	<ul id="moderators_container_<?php echo $orgid;?>" class="moderators-container list-unstyled clearfix">
            <?php if($pmoderator) { ?>
            	<li  class="moderators-acceptor pull-left" orgid="<?php echo $orgid;?>" style=""> 
                   <div class="avatar-cover"></div>
                    <div class="user-item-avatar"> 
                    	<div class="avatar-face">
                    		<img src="avatar.php?uid=0&amp;size=middle"> 
                        </div>
                    </div>
               </li>
               <?php } ?>
            <?php if(is_array($moderators)) foreach($moderators as $value) { ?>                <li  class="user-item pull-left" uid="<?php echo $value['uid'];?>"> 
                    <?php if($pmoderator) { ?> <div class="delete" onclick="moderator_del('<?php echo $value['id'];?>','<?php echo $orgid;?>',this);" ><i style="color:#d2322d;font-size:16px" class="glyphicon glyphicon-remove-sign">&nbsp;</i></div><?php } ?>
                    <div class="avatar-cover"></div>
                    <div class="user-item-avatar"> 
                    	<div class="avatar-face">
                    		<img src="avatar.php?uid=<?php echo $value['uid'];?>&amp;size=middle"> 
                        </div>
                    </div>
                    <p class="text-center" style="height:20px;margin:5px 0;line-height:25px;overflow:hidden;"> <?php echo $value['username'];?></p>
               </li>
                <?php } ?>
            
            </ul>
        </dd>
        <dd class="clearfix">
        	
         	<ul class="help-block " style="line-height:2">
            	<strong class="pull-left" style="margin-left:-45px;">注：</strong>
            	<li>机构管理员权限：设置本机构下所有部门管理员，管理本机构中所有人员，管理本机构所有共享目录。</li>
                <li>部门管理员权限：设置本部门下所有子部门管理员，管理本部门中所有人员，管理本部门所有共享目录。</li>
            </ul>
        </dd>
    </dl>
   
</div>
