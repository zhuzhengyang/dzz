<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<ul class="nav nav-pills  nav-pills-bottomguide">
    <li <?php if($_GET['op']=='edit') { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>"> 设置</a></li>
    <li <?php if($_GET['op']=='space') { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=space">空间管理</a></li>
     <li <?php if($_GET['op']=='router') { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=router">路由管理</a></li>
    
     <?php if($_GET['op']=='routeredit') { ?>
    	<?php if($routerid) { ?>
         <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=routeredit&routerid=<?php echo $routerid;?>">编辑路由</a></li>
        <?php } else { ?>
         <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=routeredit">添加路由</a></li>
        <?php } ?>
      <?php } ?>
      <li <?php if($_GET['op']=='movetool') { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=movetool">迁移工具</a></li>
  </ul>