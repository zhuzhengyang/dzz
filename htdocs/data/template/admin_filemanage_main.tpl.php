<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="admin/scripts/admin.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
html, body {
overflow: hidden;
background: #FBFBFB;
}
</style><?php include template('common/header_simple_end'); ?><nav class="navbar navbar-default bs-navbar-default navbar-fixed-top" role="navigation" style="margin:0"> 
  <ul class="nav nav-pills clearfix" style="padding:0 10px;">
        <strong class="pull-left" style="padding-left:0px;">筛选：</strong>
        <li class="dropdown"> <a href="<?php echo BASESCRIPT;?>?mod=app&group=<?php echo $group;?>" data-toggle="dropdown" role="button" id="drop-group" class="dropdown-toggle"><?php if($type) { ?><?php echo $typearr[$type];?><?php } else { ?>全部<?php } ?><b class="caret"></b></a>
          <ul aria-labelledby="drop-group" role="menu" class="dropdown-menu" id="drop-group-menu">
            <li role="presentation"><a href="<?php echo BASESCRIPT;?>?mod=filemanage" tabindex="-1" role="menuitem" >全部</a></li>
            <?php if(is_array($typearr)) foreach($typearr as $type => $value) { ?>            <li role="presentation"><a href="<?php echo BASESCRIPT;?>?mod=filemanage&type=<?php echo $type;?>" tabindex="-1" role="menuitem" ><?php echo $value;?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li class="pull-right" style="padding-top:3px;">
          <form name="search" action="<?php echo BASESCRIPT;?>" method="get">
            <input type="hidden" name="mod" value="filemanage" />
            <div class="input-group group-sm" style="width:180px;">
              <input name="keyword"  type="text" value="<?php echo $keyword;?>" class="form-control "  placeholder="文件名称">
              <a href="javascript:;" class="input-group-addon" onclick="this.parentNode.parentNode.submit();return false;"><i class="glyphicon glyphicon-search"></i></a> </div>
          </form>
        </li>
      </ul>
</nav>
<div class="bs-container clearfix" >
  <div class="bs-main-container">
    
    <div class="main-content clearfix" style="border-top:1px solid #FFF" >
      <form id="appform" name="appform" class="form-horizontal " action="<?php echo BASESCRIPT;?>?mod=filemanage" method="post" >
        <input type="hidden" name="delsubmit" value="true" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
         <input type="hidden" name="refer" value="<?php echo $refer;?>" />
        <table class="table table-hover" style="border-bottom:1px solid #DDD">
          <thead><th></th><th>文件名称</th><th>文件大小</th><th>文件类型</th><th>文件位置</th><th>所有者</th><th>添加时间</th><th>删除</th></thead>
          <?php if(is_array($list)) foreach($list as $value) { ?>          <tr>
            <td width="40"><input  type="checkbox"  name="del[]" value="<?php echo $value['icoid'];?>" style="width:20px;" /></td>
            <td><a href="<?php echo ADMINSCRIPT;?>?mod=filemanage&op=preview&icoid=<?php echo $value['icoid'];?>" title="预览" target="hideframe">
            	<img class="<?php echo $value['type'];?>" src="<?php echo $value['img'];?>" /><?php echo $value['name'];?></a></td>
             <td><?php echo $value['size'];?></td>
             <td><?php echo $value['ftype'];?></td>
             <td><?php echo $value['path'];?></td>
            <td><a href="user.php?uid=<?php echo $value['uid'];?>" onclick=""><?php echo $value['username'];?></a></td>
           
            <td><?php echo $value['dateline'];?></td>
            <td></a> <a class="btn btn-link" href="<?php echo BASESCRIPT;?>?mod=filemanage&do=delete&icoid=<?php echo $value['icoid'];?>&refer=<?php echo urlencode($refer);?>" title="删除" style="color:#fa8734" onclick="if(confirm('确定要彻底删除（此操作不可恢复）此文件吗？')){return true}else{return false}"><i class="glyphicon glyphicon-remove"></i></a></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="20"><label for="chkall" class="checkbox-inline"><input type="checkbox" name="chkall" id="chkall"  onclick="checkAll('prefix', this.form, 'del')">全选</label>&nbsp;&nbsp; &nbsp;<input type="submit" class="btn btn-primary" value="删除" onclick="if(confirm('确定要彻底删除（此操作不可恢复）所有选择的文件吗？')){return true}else{return false}" /> <?php echo $multi;?> </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>
<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();
</script> 
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" type="text/javascript"></script> <?php include template('common/footer_simple'); ?> 