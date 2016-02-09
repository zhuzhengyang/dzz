<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
html, body {
overflow: hidden;
background: #FBFBFB;
}
.table td {
vertical-align: middle;
}
</style><?php include template('common/header_simple_end'); ?><nav class="navbar navbar-default bs-navbar-default navbar-fixed-top" role="navigation" style="margin:0;padding:0 10px;"> 
  <ul class="nav nav-pills tag-container nav-pills-bottomguide clearfix" >
      <li <?php if(!$tagid) { ?>class="active"<?php } ?>><a href="<?php echo DZZSCRIPT;?>?mod=market">全部</a>
      </li>
      <?php if(is_array($tags)) foreach($tags as $value) { ?> 
      <li <?php if($tagid==$value['tagid']) { ?>class="active"<?php } ?>><a href="<?php echo DZZSCRIPT;?>?mod=market&tagid=<?php echo $value['tagid'];?>"><?php echo $value['tagname'];?></a>
      </li>
      <?php } ?>
      <li class="pull-right " style="margin:4px 0;">
        <form name="search" action="<?php echo DZZSCRIPT;?>" method="get">
          <input type="hidden" name="mod" value="market" />
          <div class="input-group" style="width:180px">
            <input name="keyword"  type="text" class="form-control input-sm" value="<?php echo $keyword;?>"  placeholder="应用名称或供应商">
            <a class="input-group-addon" herf="javascript:;" onclick="this.parentNode.parentNode.submit()"><i class="glyphicon glyphicon-search"></i></a> </div>
        </form>
      </li>
    </ul>
  </div>
</nav>
<div class="bs-container clearfix" >
  <div class="bs-main-container">
  <div class="main-content clearfix">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>应用名称</th>
          <th>供应商</th>
          <th>标签</th>
          <th>编辑</th>
        </tr>
      </thead>
      <?php if(is_array($list)) foreach($list as $value) { ?>      <tr>
        <td><a href="<?php echo $value['url'];?>" target="_blank" isinstall="<?php echo $value['isinstall'];?>" onclick="return Preview('<?php echo $value['appid'];?>');" title="预览"><img src="<?php echo $value['appico'];?>" /><?php echo $value['appname'];?></a></td>
        <td><?php echo $value['vendor'];?></td>
        <td><?php if(is_array($value['tags'])) foreach($value['tags'] as $key => $value1) { ?> 
          <a href="<?php echo DZZSCRIPT;?>?mod=market&tagid=<?php echo $value1['tagid'];?>"><?php echo $value1['tagname'];?></a> 
          <?php } ?></td>
        <td><?php if($value['isinstall']) { ?> 
          <span>已安装</span> 
          <?php } else { ?> 
          <a id="app_<?php echo $value['appid'];?>" href="javascript:;" isinstall="<?php echo $value['isinstall'];?>"  onclick="Install('<?php echo $value['appid'];?>')"><span>安装</span></a> 
          <?php } ?></td>
      </tr>
      <?php } ?>
      <?php if($multi) { ?>
      <tr>
      	<td colspan="20"> <?php echo $multi;?></td>
      </tr>
       <?php } ?>
    </table>
  </div>
</div>
</div>
<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();
var appdata=<?php echo $jsondata;?>;
function Preview(appid){
try{
if(appdata[appid]) parent._config.sourcedata.app[appid]=appdata[appid];
parent.OpenApp(appid);
return false
}catch(e){
return true;
}
}
function Install(appid){
try{
if(appdata[appid]) parent._config.sourcedata.app[appid]=appdata[appid];
else return;
parent.showmessage('正在安装"'+appdata[appid].appname+'"，请稍候','info',0,1,'right-bottom');
jQuery.getJSON('<?php echo DZZSCRIPT;?>?mod=market&do=install&appid='+appid,function(json){
if(json.msg=='success'){
parent._config.appList.push(appid);
parent._start.refreshlist();
jQuery('#app_'+appid).find('span').html('已安装').unwrap();
parent.showmessage(appdata[appid].appname+'已安装到开始菜单','success',3,1,'right-bottom');
parent._start.setStartTip(1);
}else if(json.error){
parent.showmessage(json.error,'info',3,1,'right-bottom');
}
});
}catch(e){
alert('请在桌面内使用');
}
}

</script> <?php include template('common/footer_simple'); ?> 
