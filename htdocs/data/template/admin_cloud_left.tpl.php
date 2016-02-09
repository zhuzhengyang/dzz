<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
  <?php $bz=$bz?$bz:'dzz';?> 
  <?php $clouds=DB::fetch_all("select * from ".DB::table('connect')." where 1 order by disp");?>    <ul class="nav nav-pills nav-stacked nav-pills-leftguide" style="margin:10px 0;">
      <li <?php if($operation=='setting') { ?>class="active"<?php } ?>> <a href="<?php echo BASESCRIPT;?>?mod=cloud&operation=setting">云设置</a>
      </li>
      <?php if(is_array($clouds)) foreach($clouds as $value) { ?> 
      <li <?php if($operation!='setting' && $bz==$value['bz']) { ?>class="active"<?php } ?>> <a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $value['bz'];?>"><?php echo $value['name'];?></a>
      </li>
      <?php } ?>
    </ul>
