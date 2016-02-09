<?php if(!defined('IN_DZZ')) exit('Access Denied'); hookscriptoutput('space');?><?php include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
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

</style><?php include template('common/header_simple_end'); ?><div class="bs-container clearfix">
  <div class="bs-left-container  clearfix">
    <?php include template('left'); ?> 
  </div>
  <div class="left-drager">
     <div class="left-drager-op"><div class="left-drager-sub"></div></div>
  </div>
  <div class="bs-main-container  clearfix" style="min-width:660px;">
    <div class="main-header ">
      <?php include template('right_header'); ?>    </div>
    <div class="main-content clearfix" >
      <form id="appform" name="appform" class="form-horizontal form-horizontal-left" action="<?php echo BASESCRIPT;?>?mod=cloud&op=space" method="post" >
        <input type="hidden" name="cloudsubmit" value="true" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30">排序</th>
              <th width="150">存储位置</th>
              <th  width="50">默认</th>
              <th >已用 / 剩余</th>
              <th width="50">&nbsp;</th>
            </tr>
          </thead>
          
          <?php if(is_array($list)) foreach($list as $value) { ?>            <tr><td width="40"> <input type="text" class="form-control" name="disp[<?php echo $value['remoteid'];?>]" value="<?php echo $value['disp'];?>" style="width:45px;"  /></td>
            <td width="150"><input type="text" class="form-control"   name="name[<?php echo $value['remoteid'];?>]" value="<?php echo $value['name'];?>"  /></td>
            <td><label class="checkbox-inline"><input type="radio" name="isdefault" value="<?php echo $value['remoteid'];?>" <?php if($value['isdefault']>0) { ?>checked<?php } ?> ></label></td>
            <td>
            	<div id="spaceinfo_<?php echo $value['remoteid'];?>">
                    <span class="spacesize" style="padding:0 5px"><?php echo $value['fusesize'];?>&nbsp;/&nbsp;<?php echo $value['ftotalsize'];?></span>
                    <span class="spacecheck" style="padding:0 5px"><a href="javascript:;" title="重新获取" onclick="checkspace(this,'<?php echo $value['remoteid'];?>')"><i class="glyphicon glyphicon-refresh"></i></a></span>
                   <?php if($value['available']<1) { ?>
                    <span class="text-danger">云"<?php echo $value['bz'];?>"被停用，此存储位置暂时失效</span>
                    <?php } ?>
                 </div>
            </td>
            <td>
              <a id="delete_<?php echo $value['remoteid'];?>" <?php if($value['bz']=='dzz' || $value['usesize']>0) { ?>style="display:none"<?php } ?> class="text-danger" href="<?php echo BASESCRIPT;?>?mod=cloud&op=space&do=delete&remoteid=<?php echo $value['remoteid'];?>" onclick="if(confirm('真的要删除此存储吗？')){return true;}else{return false}" >删除</a> 
              </td>
          </tr>
          <?php } ?>
          <thead>
          
            <th valign="middle" colspan="7"><input  type="submit" class="btn btn-primary" value="保存设置" />
              &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo BASESCRIPT;?>?mod=cloud&op=spaceadd"  class="btn">添加存储位置</a>
              </thead>
        </table>
      </form>
      <div class="tip" style="margin:10px;">
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5>提示信息</h5>
                <ul>
                    <li>云被停用后，相关的存储位置也会失效，新的文件不会使用此存储位置，已有文件可以正常访问</li>
                    <li>排序：值越大越靠后,未设置默认情况下会优先使用排序靠前的存储。</li>
                    <li>已用：仅表示本系统当前使用的存储空间的大小（并不能表示存储位置的全部使用情况）；剩余：表示可以使用的剩余空间大小。</li>
                    <li>系统先通过路由规则来选择存储位置,没有匹配的路由时，才使用此处的默认位置</li>
                    <li>系统在上传到选择的目标存储位置失败时，将默认使用服务器磁盘。</li>
                    <li>服务器磁盘为默认基础存储，不能删除。其他只有已用数据为0时，才可以删除。</li>
                    <li>数据可以使用迁移工具在不同的存储位置间迁移</li>
                </ul>
            </div>
       </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();

 function checkspace(obj,remoteid){
 jQuery(obj).html('<img src="admin/images/loadding.gif">');
 jQuery.getJSON('<?php echo ADMINSCRIPT;?>?mod=cloud&op=space&do=checkspace&remoteid='+remoteid,function(json){
 if(json.error){
 jQuery(this).html('<i class="glyphicon glyphicon-refresh"></i><span class="text-danger">'+json.error+'</span>');
 }else{
jQuery('#spaceinfo_'+remoteid+' .spacecheck a').html('<span class="text-success" >已更新</span>');
 	jQuery('#spaceinfo_'+remoteid+' .spacesize').html(json.fusesize+'&nbsp;/&nbsp;'+json.ftotalsize).hide().fadeIn('slow');
if(json.usesize<1){
jQuery('delete_'+remoteid).show();
}else{
jQuery('delete_'+remoteid).hide();
}

window.setTimeout(function(){
jQuery('#spaceinfo_'+remoteid+' .spacecheck a').html('<i class="glyphicon glyphicon-refresh"></i>');
},5000);
 }
 });
 }
</script>

<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php include template('common/footer_simple'); ?> 
