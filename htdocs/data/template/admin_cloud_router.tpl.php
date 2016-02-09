<?php if(!defined('IN_DZZ')) exit('Access Denied'); hookscriptoutput('router');?><?php include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
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
  <div class="bs-main-container  clearfix" style="min-width:680px;">
    <div class="main-header ">
      <?php include template('right_header'); ?>    </div>
    <div class="main-content clearfix" style="border-top:1px solid #FFF">
      <form id="appform" name="appform" class="form-horizontal form-horizontal-left" action="<?php echo BASESCRIPT;?>?mod=cloud&op=router" method="post" >
        <input type="hidden" name="routersubmit" value="true" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <table class="table table-hover">
          <thead>
             <th width="20">&nbsp;</th>
              <th width="80">优先级</th>
              <th width="150">名称</th>
              <th width="100">使用存储</th>
              <th >路由规则</th>
              <th width="60">启用</th>
              <th width="60">编辑</th>
          </thead>
          <?php if(is_array($list)) foreach($list as $value) { ?>            <tr>
            <td width="20"> <input type="checkbox" name="delete[]" value="<?php echo $value['routerid'];?>" style="width:20px;"  /></td>
            <td width="80"> <input type="text" class="form-control"  name="priority[<?php echo $value['routerid'];?>]" value="<?php echo $value['priority'];?>" style="width:45px;"  /></td>
            <td width="150"><input type="text" class="form-control"   name="name[<?php echo $value['routerid'];?>]" value="<?php echo $value['name'];?>"  /></td>
            <td width="100"><?php echo $value['position'];?> 
             <?php if($value['bz_available']<1) { ?>
                <span class="text-danger">云"<?php echo $value['bz'];?>"被停用，此路由暂时失效</span>
                <?php } ?>
            </td>
            <td style="word-break:break-all"><?php echo $value['drouter'];?></td>
            <td width="60"><input type="checkbox" name="available[<?php echo $value['routerid'];?>]" value="1" <?php if($value['available']>0) { ?>checked<?php } ?> ></td>
            <td width="60">
              <a  href="<?php echo BASESCRIPT;?>?mod=cloud&op=routeredit&routerid=<?php echo $value['routerid'];?>" class="glyphicon glyphicon-edit " title="编辑">&nbsp;</a> 
             </td>
          </tr>
          <?php } ?>
          <thead>
            <td valign="middle" colspan="7"><input type="checkbox" name="chkall" id="chkall"  onclick="checkAll('prefix', this.form, 'delete')">&nbsp;删？&nbsp;&nbsp;&nbsp;<input  type="submit" class="btn btn-primary" value="保存设置" />
              &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo BASESCRIPT;?>?mod=cloud&op=routeredit"  class="btn btn-success">添加路由</a></td>
              </thead>
        </table>
      </form>
      <div class="tip" style="margin:10px;">
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5>提示信息</h5>
                <ul>
                    <li>云被停用后，相关的路由也会失效。生效前，将忽略此路由</li>
                    <li>优先级：值越大越靠前,系统在选择存储时会按优先级从高到低来选择，一旦条件满足，将不再查询低优先级的路由。</li>
                    <li>添加路由时要注意把优先起作用的路由优先级提高,路由条件限定范围小的路由优先级提高</li>
                    <li>没有添加路由时，系统将直接使用“空间管理”里默认的存储位置</li>
                   
                </ul>
            </div>
       </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();
 function checkspace(obj,routerid){
 jQuery(obj).html('<img src="admin/images/loadding.gif">');
 jQuery.getJSON('<?php echo ADMINSCRIPT;?>?mod=cloud&op=space&do=checkspace&routerid='+routerid,function(json){
 if(json.error){
 jQuery(this).html('<i class="icon-refresh"></i><span class="text-danger">'+json.error+'</span>');
 }else{
jQuery('#spaceinfo_'+routerid+' .spacecheck a').html('<span class="text-success" >已更新</span>');
 	jQuery('#spaceinfo_'+routerid+' .spacesize').html(json.fusesize+'&nbsp;/&nbsp;'+json.ftotalsize).hide().fadeIn('slow');
if(json.usesize<1){
jQuery('delete_'+routerid).show();
}else{
jQuery('delete_'+routerid).hide();
}

window.setTimeout(function(){
jQuery('#spaceinfo_'+routerid+' .spacecheck a').html('<i class="icon-refresh"></i>');
},5000);
 	
 }
 });
 }
</script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php include template('common/footer_simple'); ?> 
