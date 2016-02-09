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
input[type="text"]{
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
      	 <div class="main-header">
        	<ul class="nav nav-pills nav-pills-bottomguide" >
                <li <?php if(empty($_GET['edit']) && empty($_GET['run'])) { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&op=cron">计划任务</a></li>
                 <?php if(!empty($_GET['edit'])) { ?><li class="active"><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&op=cron&edit=<?php echo $_GET['edit'];?>">编辑计划任务</a></li><?php } ?>
                  <?php if(!empty($_GET['run'])) { ?><li class="active"><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&op=cron&run=<?php echo $_GET['run'];?>">运行计划任务</a></li><?php } ?>
            </ul>
        </div>
    	<div class="main-content" style="padding:15px;border-top:1px solid #FFF">
         <?php if($msg) { ?>
            <div class="well"> 
            	<p class="<?php echo $msg_type;?>"><?php echo $msg;?></p>
            	 <?php if($redirecturl) { ?>
                     <p class="text-info"><a href="<?php echo $redirecturl;?>" class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a></p>
                     <script type="text/JavaScript">setTimeout(function(){location.href='<?php echo $redirecturl;?>';}, 2000);</script>
                   <?php } ?>
            </div>
          <?php } else { ?>
          	<?php if($_GET['edit']>0) { ?>
            	<ul class="help-block">
                  <h4>提示信息</h4>
                    <li>您正在对系统内置的计划任务进行编辑，除非非常了解 Dzz! 结构，否则强烈建议不要修改默认设置。</li><li>请在修改之前记录原有设置，不当的设置将可能导致站点出现不可预期的错误。</li>
                </ul>
                 <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=cron&edit=<?php echo $cronid;?>" class="form-horizontal form-horizontal-left"   method="post" name="cpform">
                    <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                    <input type="hidden" value="true" name="editsubmit">
                    <dl>
                    	<dt>每周:</dt>
                        <dd class="clearfix">
                        	<select name="weekdaynew" class="form-control">
                            <option value="-1" selected="selected">*</option>
                            <?php echo $weekdayselect;?>
                            </select>
                            <span class="help-inline">设置星期几执行本任务，“*”为不限制，本设置会覆盖下面的“日”设定</span>
                        </dd>
                        
                   </dl>
                   <dl>
                    	<dt>每日:</dt>
                        <dd class="clearfix">
                        	<select name="daynew" class="form-control">
                            <option value="-1" selected="selected">*</option>
                            <?php echo $dayselect;?>
                            </select> 
                            <span class="help-inline">设置哪一日执行本任务，“*”为不限制</span>
                        </dd>
                        
                   </dl>
                    <dl>
                    	<dt>小时:</dt>
                        <dd class="clearfix">
                        	<select name="hournew" class="form-control">
                            <option value="-1" selected="selected">*</option>
                            <?php echo $hourselect;?>
                            </select>
                            <span class="help-inline">设置哪一小时执行本任务，“*”为不限制</span>
                        </dd>
                   </dl>
                   <dl>
                    	<dt>分钟:</dt>
                        <dd class="clearfix">
                        	<input name="minutenew" value="<?php echo implode(',',$cron[minute])?>" type="text" class="form-control">
                         	<span class="help-inline">设置哪些分钟执行本任务，至多可以设置 12 个分钟值，多个值之间用半角逗号 "," 隔开</span>
                        </dd>
                   </dl>
                   <dl>
                    	<dt>任务脚本:</dt>
                        <dd class="clearfix">
                        	<input name="filenamenew" value="<?php echo $cron['filename'];?>" type="text" class="form-control">
                            <span class="help-inline">设置本任务的执行程序文件名，请勿包含路径，系统计划任务位于 core/cron/ 目录中</span>
                        </dd>
                         
        			</dl>
                    <dl>
                    <dd class="clearfix">
                    	<button type="submit" class="btn btn-primary" name="exportsubmit" value="true" />提  交</button>
                    </dd>
                    </dd>
                  </form>
            <?php } elseif($_GET['run']) { ?>
            
            <?php } else { ?>
                <ul class="help-block">
                  <h5>提示信息</h5>
                    <li>计划任务是 Dzz! 提供的一项使系统在规定时间自动执行某些特定任务的功能，在需要的情况下，您也可以方便的将其用于站点功能的扩展。</li><li>计划任务是与系统核心紧密关联的功能特性，不当的设置可能造成站点功能的隐患，严重时可能导致站点无法正常运行，因此请务必仅在您对计划任务特性十分了解，并明确知道正在做什么、有什么样后果的时候才自行添加或修改任务项目。</li><li>此处和其他功能不同，本功能中完全按照站点系统默认时差对时间进行设定和显示，而不会依据某一用户或管理员的时差设定而改变显示或设置的时间值。</li>
                </ul>
                <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=cron" class="form-horizontal form-horizontal-left" style="margin:-15px -15px 0"  method="post" name="cpform">
                    <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                    <input type="hidden" value="true" name="cronssubmit">
                    <table class="table">
                    <thead><th></th><th>名称</th><th>可用</th><th>类型</th><th>时间</th><th>上次执行时间</th><th>下次执行时间</th><th></th></thead>
                    <?php if(is_array($crons)) foreach($crons as $cron) { ?>                        <tr>
                            <td><input type="checkbox" name="delete[]" value="<?php echo $cron['cronid'];?>" <?php if($cron['type'] == 'system') { ?>disabled<?php } ?>></td>
                            <td>
                            <p class="clearfix">
                             <input type="text"  name="namenew[<?php echo $cron['cronid'];?>]"  class="form-control" value="<?php echo $cron['name'];?>" ></p>
                             <strong><?php echo $cron['filename'];?></strong>
                             </td>
                            <td><label class="checkbox-inline"><input  type="checkbox" name="availablenew[<?php echo $cron['cronid'];?>]" value="1" <?php if($cron['available']>0) { ?>checked="checked"<?php } ?>> </td>
                            <td><?php if($cron['type'] == 'system') { ?>
                            		内置
                                <?php } elseif($cron['type'] == 'user') { ?>
                            		自定义
                                <?php } ?>
                             </td>
                            <td><?php echo $cron['time'];?></td>
                            <td><?php echo $cron['lastrun'];?></td>
                            <td><?php echo $cron['nextrun'];?></td>
                            
                            <td>
                                <a href="<?php echo BASESCRIPT;?>?mod=system&op=cron&edit=<?php echo $cron['cronid'];?>" >编辑</a>
                                <br />
                                <?php if($cron['run']) { ?>
                                	<a href="<?php echo BASESCRIPT;?>?mod=system&op=cron&run=<?php echo $cron['cronid'];?>" >执行</a>
                                <?php } else { ?>
                                	<a href="javascript:;" class="text-muted">执行</a>
                                <?php } ?>
                           </td>
                       </tr>
                      
                    <?php } ?>
                    <tr><td>新增</td><td colspan="10"><input type="text"  name="newname" value="" class="form-control" ></td></tr>
                    <tr ><td colspan="15"><label class="checkbox-inline ml20"><input type="checkbox" name="chkall" id="chkallspKI"  onclick="checkAll('prefix', this.form, 'delete')">删？</label>&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="exportsubmit" value="true" />提  交</button></td></tr>
                    </table>
            </form>
            <?php } ?>
        <?php } ?>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">  
jQuery('.left-drager').leftDrager_layout();
</script><?php include template('common/footer_simple'); ?>