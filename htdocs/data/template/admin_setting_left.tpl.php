<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<ul class="nav nav-pills nav-stacked nav-pills-leftguide" style="margin:10px 0;">
          <li <?php if($operation=='basic') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=basic">基本设置</a>
          </li>
          
          <li <?php if($operation=='datetime') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=datetime">时间设置</a>
          </li>
          <li <?php if($operation=='access') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=access">注册和访问</a>
          </li>
          
          <li <?php if($operation=='sec') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=sec">验证码设置</a>
          </li>
       	 
          
            <li <?php if($operation=='mail' || $op=='mailcheck') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=mail">邮件设置</a>
          </li>
           <li <?php if($operation=='at') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=at">@部门设置</a>
          	</li> 
           <li <?php if($operation=='upload') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=upload">上传设置</a>
          	</li> 
            <li <?php if($operation=='smiley' || $op=='smiley') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=smiley">表情管理</a>
          	</li> 
            <li <?php if($operation=='censor') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=censor">敏感词管理</a>
          	</li>
            
             <li <?php if($operation=='desktop') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=desktop">桌面设置</a>
          	</li> 
            <li <?php if($operation=='loginset') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=loginset">登录页设置</a>
          	</li>
            <li <?php if($operation=='qywechat' || $op=='assistant' || $op=='wxsyn') { ?>class="active"<?php } ?>>
                <a href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&operation=qywechat">微信企业号</a>
          	</li>
    </ul>