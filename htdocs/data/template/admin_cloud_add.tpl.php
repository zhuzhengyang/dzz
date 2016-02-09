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
  <div class="bs-main-container  clearfix">
    <div class="main-header ">
      <ul class="nav nav-pills nav-pills-bottomguide">
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=add"> 添加云</a></li>
      </ul>
    </div>
    <div class="main-content" style="padding:15px;border-top:1px solid #FFF">
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=cloud&op=add"  class="form-horizontal form-horizontal-left"   method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="addcloudsubmit" name="true">
        <dl>
          <dt>名称:</dt>
          <dd class="clearfix">
            <input type="text"  name="name" class="form-control"  value="">
          </dd>
        </dl>
        <dl>
          <dt>标志符:</dt>
          <dd class="clearfix">
            <input type="text"  name="bz" value="" class="form-control">
            <ul class="help-block ">
              <li>标志符：此类的唯一标志，全站唯一,注意区分大小写</li>
              <li>相关的api内都会按此标志符来组织和建立</li>
              <li>详细的设置和说明可以参照相关的api开发文档</li>
            </ul>
          </dd>
        </dl>
        <dl>
          <dt>类型:</dt>
          <dd class="clearfix">
            <label class="radio radio-inline">
              <input type="radio"  name="type"  value="storage" checked="checked" onclick="$('area_pan').style.display='none'">
              云存储</label>
            <label class="radio radio-inline">
              <input type="radio"  name="type"  value="pan" onclick="$('area_pan').style.display=''">
              网盘</label>
            <label class="radio radio-inline">
              <input type="radio"  name="type"  value="ftp" onclick="$('area_pan').style.display='none'">
              FTP</label>
          </dd>
        </dl>
        <div id="area_pan" style="display:none">
          <dl>
            <dt>根目录:</dt>
            <dd class="clearfix">
              <input type="text" class="form-control"  name="root" value="" >
              <ul class="help-block ">
                <li>设置根目录，对于某些网盘需要设置根目录。注意：目录名要区分大小写</li>
                <li>比如百度网盘只能访问apps/合作网站名称/下的文件</li>
                >li>比如：/apps/dzzoffice,结尾不加/
                </li>
                <li>详细的设置和说明可以参照相关的api开发文档</li>
              </ul>
            </dd>
          </dl>
          <dl>
            <dt>API Key:</dt>
            <dd class="clearfix">
              <input type="text" class="form-control"  name="key" value="" >
              <ul class="help-block ">
                <li>在API官网申请的开发者API KEY</li>
                <li>如：百度网盘、需要在http://open.baidu.com 中申请开通合作站点，通过后就可以获得该应用的API Key和Secret Key</li>
              </ul>
            </dd>
          </dl>
          <dl>
            <dt>Secret Key</dt>
            <dd class="clearfix">
              <input type="text" class="form-control" name="secret" value="" class="span4">
              <ul class="help-block ">
                <li>在API官网申请的开发者Secret Key</li>
                <li>如：百度网盘、需要在http://open.baidu.com 中申请开通合作站点，通过后就可以获得该应用的API Key和Secret Key</li>
              </ul>
            </dd>
          </dl>
        </div>
        <input class="btn btn-primary"  name="addcloudsubmit" value="添加" type="submit" >
      </form>
    </div>
  </div>
</div>
 <script type="text/javascript">
 jQuery('.left-drager').leftDrager_layout();
 </script><?php include template('common/footer_simple'); ?> 
