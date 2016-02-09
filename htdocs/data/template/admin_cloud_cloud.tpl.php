<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
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
  <div class="bs-main-container  clearfix" > 
    <div class="main-content clearfix" >
      <form id="appform" name="appform" class="form-horizontal form-horizontal-left" action="<?php echo BASESCRIPT;?>?mod=cloud" method="post" >
        <input type="hidden" name="cloudsubmit" value="true" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="40">排序</th>
              <th width="150">名称</th>
              <th width="90">标志符</th>
              <th width="100">类型</th>
              <th >可用</th>
              <th width="100"></th>
            </tr>
          </thead>
          
          <?php if(is_array($list)) foreach($list as $value) { ?>          <tr>
            <td width="40">
            <?php if($value['bz']=='dzz') { ?>
              <input type="hidden" name="disp[<?php echo $value['bz'];?>]" value="<?php echo $value['disp'];?>" />
              <?php } else { ?>
              <input type="text" name="disp[<?php echo $value['bz'];?>]"  class="form-control"  value="<?php echo $value['disp'];?>" style="width:45px;"  />
              <?php } ?>
            </td>
            <td width="150"><input type="text" class="form-control"   name="name[<?php echo $value['bz'];?>]" value="<?php echo $value['name'];?>"  /></td>
            <td><strong><?php echo $value['bz'];?></strong></td>
            <td><?php echo lang('message','cloud_type_'.$value['type']); ?></td>
            <td ><?php if($value['bz']=='dzz') { ?>
              
              <input type="hidden" name="available[<?php echo $value['bz'];?>]" value="2"  />
              
              <?php } else { ?>
              
              <input type="checkbox" name="available[<?php echo $value['bz'];?>]" value="<?php echo ($value[available]?$value[available]:1)?>" <?php if($value['available']>0) { ?>checked<?php } ?> >
              <span class="pull-left text-danger" style="padding-top:5px"><?php echo $value['warning'];?></span>
              
              <?php } ?></td>
            <td><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $value['bz'];?>" >设置</a> 
              <?php if($value['warning']) { ?> 
              <br /><a class="text-danger" href="<?php echo BASESCRIPT;?>?mod=cloud&operation=delete&bz=<?php echo $value['bz'];?>" >删除</a> 
              <?php } ?></td>
          </tr>
          <?php } ?>
          <thead>
          
            <th valign="middle" colspan="7"><input  type="submit" class="btn btn-primary" value="保存设置" />
              &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo BASESCRIPT;?>?mod=cloud&op=add"  class="btn btn-success">添加云</a>
              </thead>
        </table>
      </form>
      <div class="tip" style="margin:0 15px;">
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5>提示信息</h5>
                <ul>
                    <li>排序：值越大越靠后。</li>
                    <li>此处的云设置是全站基础设置，需要有相应的api文件支持才能起作用。</li>
                    <li><span class="text-danger">云停用后，与此云相关的添加服务（如添加云中不会出现此云图标，企业盘内相关的存储位置、路由规则会失效）将会暂停，但已经添加的文件和用户云盘会继续使用。</span></li>
                    <li>建议由开发者添加，且添加后不可删除（从未启用过的除外)。</li>
                </ul>
            </div>
        </div>
    </div>
   
  </div>
</div>
<script type="text/javascript">  
jQuery('.left-drager').leftDrager_layout();
</script><?php include template('common/footer_simple'); ?> 
