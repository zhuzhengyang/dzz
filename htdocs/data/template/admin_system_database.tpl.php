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
        <div class="main-header">
        	<ul class="nav nav-pills nav-pills-bottomguide">
                <li <?php if($operation=='export') { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&op=database&operation=export">导出</a></li>
                 <li <?php if($operation=='import') { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&op=database&operation=import">恢复</a></li>
                  <li <?php if($operation=='runquery') { ?>class="active"<?php } ?>><a hidefocus="true" href="<?php echo BASESCRIPT;?>?mod=<?php echo $mod;?>&op=database&operation=runquery">升级</a></li>
            </ul>
        </div>
        <?php if($operation=='export') { ?>
        <ul class="help-block mt20">
            <h5>提示信息</h5>
             <li>数据备份功能根据您的选择备份全部Dzz!数据，导出的数据文件可用“数据恢复”功能或 phpMyAdmin 导入。</li><li>全部备份均不包含模板文件和附件文件。模板、附件的备份只需通过 FTP 等下载 template/、data/attachment/ 目录即可，Dzz! 不提供单独备份。</li><li>MySQL Dump 的速度比 Dzz! 分卷备份快很多，但需要服务器支持相关的 Shell 权限，同时由于 MySQL 本身的兼容性问题，通常进行备份和恢复的服务器应当具有相同或相近的版本号才能顺利进行。因此 MySQL Dump 是有风险的：一旦进行备份或恢复操作的服务器其中之一禁止了 Shell，或由于版本兼容性问题导致导入失败，您将无法使用 MySQL Dump 备份或由备份数据恢复；Dzz! 分卷备份没有此限制。</li><li>数据备份选项中的设置，仅供高级用户的特殊用途使用，当您尚未对数据库做全面细致的了解之前，请使用默认参数备份，否则将导致备份数据错误等严重问题。</li><li>十六进制方式可以保证备份数据的完整性，但是备份文件会占用更多的空间。</li><li>压缩备份文件可以让您的备份文件占用更小的空间。</li>
         </ul>
   		<div class="main-content" style="padding:15px">
         <?php if(!$submit) { ?>
             
         <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=database&operation=export&setup=1" class="form-horizontal form-horizontal-left"   method="post" name="cpform">
            <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
            <input type="hidden" value="true" name="exportsubmit">
             <dl>
           		<dt>数据备份类型:</dt>
                <dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="type" value="dzz" checked="" onclick="$('showtables').style.display = 'none';">所有数据表</label></dd>
                 <dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="type" value="custom"  onclick="$('showtables').style.display = '';">自定义备份</label></dd>
                <dd id="showtables" class="clearfix" style="display:none;border:1px solid #D2D2D2">
                	<h4 class="clearfix ml20"> <label class="checkbox-inline" for ="chkalltables"><input  name="chkall" onclick="checkAll('prefix', this.form, 'customtables', 'chkall', true)" checked="checked" type="checkbox" id="chkalltables">全选 - 所有数据表</label></h4>
                    <ul class="list-unstyled">
                        <?php if(is_array($dztables)) foreach($dztables as $value) { ?>                        	<li class="col-xs-4"><label class="checkbox-inline"><input type="checkbox" name="customtables[]" value="<?php echo $value;?>"  checked="checked"><?php echo $value;?></label></li>
                        <?php } ?>
                      </ul>
                </dd>
             </dl>
             <div id="advanceoption" style="display:none">
             	
                    <dl>
                        <dt>数据备份方式:</dt>
                        <dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="method" value="shell" onclick="if('0') {if(this.form.sqlcompat[2].checked==true) this.form.sqlcompat[0].checked=true; this.form.sqlcompat[2].disabled=true; this.form.sizelimit.disabled=true;} else {this.form.sqlcharset[0].checked=true; for(var i=1; i&lt;=5; i++) {if(this.form.sqlcharset[i]) this.form.sqlcharset[i].disabled=true;}}" id="method_shell"> 系统 MySQL Dump (Shell) 备份</label></dd>
                         <dd class="clearfix"><label class="radio radio-inline"><input  type="radio" name="method" value="multivol" checked="checked" onclick="this.form.sqlcompat[2].disabled=false; this.form.sizelimit.disabled=false; for(var i=1; i<=5; i++) {if(this.form.sqlcharset[i]) this.form.sqlcharset[i].disabled=false;}" id="method_multivol"> Dzz! 分卷备份 - 文件长度限制(单位：KB)</label>
                         <input type="text" class="input-sm form-control" style="width:50px;" name="sizelimit" value="2048" >
                         </dd>
                     </dl>
                     <dl>
                        <dt>使用扩展插入(Extended Insert)方式:</dt>
                        <dd class="clearfix"><label class="radio radio-inline"><input  type="radio" name="extendins" value="1">是</label><label class="radio radio-inline"><input  type="radio" name="extendins" value="0" checked="checked">否</label></dd>
                     </dl>
                     <dl>
                        <dt>建表语句格式:</dt>
                        <dd class="clearfix"><label class="radio radio-inline"><input  type="radio" name="sqlcompat" value="" checked="">默认</label></dd>
                        <dd class="clearfix"><label class="radio radio-inline"><input  type="radio" name="sqlcompat" value="MYSQL40"> MySQL 3.23/4.0.x</label></dd>
                        <dd class="clearfix"><label class="radio radio-inline"><input  type="radio" name="sqlcompat" value="MYSQL41" disabled="">  MySQL 4.1.x/5.x</label></dd>
                     </dl>
                     <dl>
                        <dt>强制字符集:</dt>
                        <dd class="clearfix"><label class="radio radio-inline"><input  type="radio" name="sqlcharset" value="">默认</label>
                        <label class="radio radio-inline"><input  type="radio" name="sqlcharset" value="utf8">  UTF8</label></dd>
                     </dl>
                     <dl>
                        <dt>十六进制方式:</dt>
                        <dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="usehex" value="1" checked="checked">是</label>
                        <label class="radio radio-inline"><input type="radio" name="usehex" value="0" >否</label></dd>
                     </dl>
                     <dl>
                        <dt>压缩备份文件:</dt>
                        <dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="usezip" value="1">多分卷压缩成一个文件</label></dd>
                        <dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="usezip" value="2">每个分卷压缩成单独文件</label></dd>
                         <dd class="clearfix"><label class="radio radio-inline"><input type="radio" name="usezip" value="0" checked>不压缩</label></dd>
                     </dl>
                     <dl>
                     	<dt>备份文件名:</dt>
                        <dd class="clearfix"><input type="text" class="form-control"  name="filename" value="<?php echo $defaultfilename;?>"></dd>
                      </dl>
             </div>
             <dl>
           		<dd class="clearfix"><button type="submit" class="btn btn-primary" name="exportsubmit" value="true" />提  交</button>
                &nbsp; &nbsp;<label class="checkbox inline"><input  type="checkbox" value="1" onclick="$('advanceoption').style.display = $('advanceoption').style.display == 'none' ? '' : 'none'; this.value = this.value == 1 ? 0 : 1; this.checked = this.value == 1 ? false : true" id="btn_more">更多选项</label></dd>
            </dl>
        </form>
         <?php } else { ?>
             <div class="well">
                   <?php if($msg) { ?>
                     <p class="<?php echo $msg_type;?>"><?php echo $msg;?></p>
                   <?php } ?>
                   <?php if($redirecturl) { ?>
                     <p class="text-info"><a href="<?php echo $redirecturl;?>" class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a></p>
                     <script type="text/JavaScript">setTimeout(function(){location.href='<?php echo $redirecturl;?>';}, 2000);</script>
                   <?php } ?>
              </div>
         <?php } ?>
       </div>
       <?php } elseif($operation=='import') { ?>
         <div class="main-content" style="padding:15px 0;border:1px solid #FFF">
          <?php if($msg) { ?>
            <div class="well"> 
            	<p class="<?php echo $msg_type;?>"><?php echo $msg;?></p>
            	 <?php if($redirecturl) { ?>
                     <p class="text-info"><a href="<?php echo $redirecturl;?>" class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a></p>
                     <script type="text/JavaScript">setTimeout(function(){location.href='<?php echo $redirecturl;?>';}, 2000);</script>
                   <?php } ?>
            </div>
          <?php } else { ?>
          	 
             <ul class="help-block">
             <h5>提示信息</h5>
                 <li>本功能在恢复备份数据的同时，将全部覆盖原有数据，请确定恢复前已将程序关闭，恢复全部完成后可以将程序重新开放。</li><li>恢复数据前请在 Dzz!  安装文件目录下tool文件夹内找到 restore.php 文件，然后将 restore.php 文件上传到程序文件夹data目录下。<b>为了您站点的安全，成功恢复数据后请务必及时删除 restore.php 文件。</b></li><li>您可以在数据备份记录处查看站点的备份文件的详细信息，删除过期的备份,并导入需要的备份。</li>
             </ul>
            <?php echo $do_import_option;?> 
             <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=database&operation=import" class="form-horizontal form-horizontal-left "   method="post" name="cpform">
                <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                <input type="hidden" value="true" name="deletesubmit">
                <table class="table table-hover" style="border-top:1px solid #DDD">
                <thead><th></th><th>文件名</th><th>版本</th><th>时间</th><th>类型</th><th>大小</th><th>方式</th><th>卷数</th><th></th></thead>
                <?php if(is_array($list)) foreach($list as $key => $val) { ?>                    <tr>
                    	<td><input type="checkbox" name="delete[]" value="<?php echo $key;?>"></td>
                        <td>
                        	<?php if($val['list']) { ?>
                        		<a href="javascript:;" onclick="jQuery('#exportlog_<?php echo $key;?>').toggle()"><?php echo $key;?></a>
                            <?php } else { ?>    
                            	<a href="<?php echo $val['filename'];?>"><?php echo $key;?></a>
                            <?php } ?>
                         </td>
                        <td><?php echo $val['version'];?></td>
                        <td><?php echo $val['dateline'];?></td>
                        <td><?php echo $val['ftype'];?></td>
                        <td><?php echo $val['size'];?></td>
                        <td><?php echo $val['method'];?></td>
                        <td><?php echo $val['volume'];?></td>
                       	<td>
                       		<?php if($val['list']) { ?>
                            <a href="<?php echo $datasiteurl;?>restore.php?operation=import&from=server&datafile_server=<?php echo $val['datafile_server'];?>&importsubmit=yes" <?php if($info['version'] != $_G['setting']['version']) { ?> onclick="return confirm('导入和当前 Dzz! 版本不一致的数据极有可能产生无法解决的故障，您确定继续吗？');" <?php } else { ?>  onclick="return confirm('您确定导入该备份吗？');"<?php } ?>   target="_blank">导入</a>
                            <?php } else { ?>  
                             <a href="<?php echo $datasiteurl;?>restore.php?operation=importzip&datafile_server=<?php echo $info['datafile_server'];?>&importsubmit=yes"  onclick="return confirm('您确定解压该备份吗？');"  target="_blank">解压缩</a>
                            <?php } ?>  
                       </td>
                   </tr>
                   <thead id="exportlog_<?php echo $key;?>" style="display:none;">
                   <?php if(is_array($val['list'])) foreach($val['list'] as $key1 => $val1) { ?>                   		<tr>
                        <td></td>
                        <td>
                        	 <a href="<?php echo $val1['filename'];?>"><?php echo $val1['filename'];?></a>
                         </td>
                        <td><?php echo $val1['version'];?></td>
                        <td><?php echo $val1['dateline'];?></td>
                        <td></td>
                        <td><?php echo $val1['size'];?></td>
                        <td></td>
                        <td><?php echo $val1['volume'];?></td>
                       	<td></td>
                        </tr>
                    <?php } ?>
                    </thead>
                <?php } ?>
                <thead ><tr><td colspan="15"><input type="checkbox" name="chkall" id="chkallspKI"  onclick="checkAll('prefix', this.form, 'delete')">删？&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="exportsubmit" value="true" />提  交</button></td></tr></thead>
                </table>
        </form>
        <?php } ?>
        </div>
      <?php } elseif($operation=='runquery') { ?>
         <div class="main-content" style="padding:15px">
             
             <ul class="help-block">
             	<h4>提示信息</h4>
                 <li>如果您想自己随意书写 SQL 升级语句，需要将 core/config/config.php 当中的 '_config[admincp][runquery]' 设置修改为 1。</li>
             </ul>
          <?php if($msg) { ?>
            <div class="well"> 
            	<p class="<?php echo $msg_type;?>"><?php echo $msg;?></p>
            	 <?php if($redirecturl) { ?>
                     <p class="text-info"><a href="<?php echo $redirecturl;?>" class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a></p>
                     <script type="text/JavaScript">setTimeout(function(){location.href='<?php echo $redirecturl;?>';}, 5000);</script>
                   <?php } ?>
            </div>
          <?php } else { ?>
          	
             <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=system&op=database&operation=runquery"   method="post" name="cpform">
                <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
                <input type="hidden" value="true" name="sqlsubmit">
                <dl>
                	<dt>Dzz! 数据库升级 - 请将数据库升级语句粘贴在下面</dt>
                    <dd class="clearfix"><textarea cols="85" rows="10" name="queries" style="width:500px;"></textarea></dd>
                    <dd class="clearfix mt10"><label class="checkbox-inline"><input name="createcompatible" type="checkbox" value="1" checked="checked" />转换建表语句格式和字符集</label></dd>
                </dl>
                <dl>
                	<dd class="clearfix"><button type="submit" class="btn btn-primary">提  交</button></dd>
                </dl>
            </form>
            <?php } ?>
         </div>
     <?php } ?>
    </div>
</div>
<script type="text/javascript">  
jQuery('.left-drager').leftDrager_layout();
</script><?php include template('common/footer_simple'); ?>