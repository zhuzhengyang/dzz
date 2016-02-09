<?php if(!defined('IN_DZZ')) exit('Access Denied'); hookscriptoutput('edit');?><?php include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="admin/scripts/admin.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
html, body {
overflow: hidden;
background: #FBFBFB;
}
.bs-left-container {
width: 120px;
}
.bs-main-container {
margin-left: 120px;
overflow: auto;
}
</style><?php include template('common/header_simple_end'); ?><div class="bs-container clearfix">
<div class="bs-left-container  clearfix"> 
  <?php include template('left'); ?> 
</div>
<div class="left-drager">
   <div class="left-drager-op"><div class="left-drager-sub"></div></div>
</div>
<div class="bs-main-container  clearfix" > 
  
  <?php if($cloud['type']=='local') { ?>
  <div class="main-header "> 
    <?php include template('right_header'); ?> 
  </div>
  <div class="main-content" style="padding:15px;border-top:1px solid #FFF">
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>" class="form-horizontal form-horizontal-left" method="post" name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="editsubmit" name="true">
      <dl>
        <dt>名称:</dt>
        <dd class="clearfix">
          <input type="text"  name="name"  class="form-control"  value="<?php echo $cloud['name'];?>">
        </dd>
      </dl>
      <dl>
        <dt>标志符:</dt>
        <dd class="clearfix">
          <input type="text"  name="" class="form-control" value="<?php echo $cloud['bz'];?>"  disabled="disabled">
        </dd>
        <dd class="clearfix">
          <ul class="help-block ">
            <li>标志符：此类的唯一标志，全站唯一,注意区分大小写</li>
            <li>相关的api内都会按此标志符来组织和建立</li>
            <li>详细的设置和说明可以参照相关的api开发文档</li>
          </ul>
        </dd>
      </dl>
      <input class="btn btn-primary"  name="editsubmit" value="保存更改" type="submit" >
    </form>
  </div>
  <?php } elseif($cloud['type']=='pan') { ?>
  <div class="main-header clearfix" >
    <ul class="nav nav-pills nav-pills-bottomguide">
      <li <?php if(empty($_GET['do'])) { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>"> 设置</a>
      </li>
      <?php if($cloud['available']>0) { ?> 
      <li <?php if($_GET['do']=='usercloud') { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>&do=usercloud">使用用户</a>
      </li>
      <?php } ?>
    </ul>
  </div>
  <div class="main-content clearfix" style="padding:15px;border-top:1px solid #FFF"> 
    <?php if($_GET['do']=='usercloud') { ?>
    <form id="appform" name="appform" class="form-horizontal form-horizontal-left" style="margin:-15px -15px 0;" action="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&do=usercloud" method="post" >
      <input type="hidden" name="cloudsubmit" value="true" />
      <input type="hidden" name="bz" value="<?php echo $bz;?>" />
      <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
      <table class="table table-hover">
        <thead>
          <tr>
            <th width="30"></th>
            <th>名称</th>
            <th>用户名</th>
            <th>添加时间</th>
          </tr>
        </thead>
        
        <?php if(is_array($list)) foreach($list as $value) { ?>        <tr>
          <td width="40"><input type="checkbox"  name="delete[]" value="<?php echo $value['id'];?>" /></td>
          <td ><img src="<?php echo $value['img'];?>" /><?php echo $value['cloudname'];?></td>
          <td><?php echo $value['username'];?></td>
          <td> <?php echo $value['dateline'];?> </td>
        </tr>
        <?php } ?>
        <thead>
        <td  colspan="5"><input type="checkbox" name="chkall" id="chkall"  onclick="checkAll('prefix', this.form, 'del')">
            &nbsp;删？
            &nbsp;&nbsp;&nbsp;
            <input type="submit" class="btn btn-primary" value="提交" />
            <?php echo $multi;?></td>
            </thead>
      </table>
    </form>
    <?php } else { ?>
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>" class="form-horizontal form-horizontal-left"   method="post" name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="editsubmit" name="true">
      <dl>
        <dt>名称:</dt>
        <dd class="clearfix">
          <input type="text"  name="name" class="form-control"  value="<?php echo $cloud['name'];?>">
        </dd>
      </dl>
      <dl>
        <dt>是否允许用户添加:</dt>
        <dd class="clearfix"><?php if($cloud['available']>0) { ?>
          <label class="radio radio-inline"> <input type="radio"  name="available"  value="2" <?php if($cloud['available']>1) { ?>checked="checked"<?php } ?>>是</label>
          <label class="radio radio-inline"> <input type="radio"  name="available"  value="1" <?php if($cloud['available']<2) { ?>checked="checked"<?php } ?>>否</label>
          <?php } else { ?>
          <input type="hidden"  name="available"  value="<?php echo $cloud['available'];?>" />
          <?php } ?>
          <ul class="help-block">
            <?php if($cloud['warning']) { ?>
            <li><span class=" text-danger"><?php echo $cloud['warning'];?></span></li>
            <?php } ?> 
            <?php if($cloud['available']<1) { ?>
            <li><span class=" text-danger">先启用 “<?php echo $cloud['name'];?>” 后才能设置此项</span></li>
            <?php } else { ?>
            <li>设置为“否”,用户在”我的云“里”添加云“时将不出现此云</li>
            <?php } ?>
            
          </ul>
        </dd>
        </dd>
      </dl>
      <dl>
        <dt>标志符:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="bz" value="<?php echo $cloud['bz'];?>"  disabled="disabled">
        </dd>
      </dl>
      <dl>
        <dt>根目录:</dt>
        <dd class="clearfix">
          <input type="text"  name="root" class="form-control" value="<?php echo $cloud['root'];?>" >
          <ul class="help-block ">
            <li>设置根目录，对于某些网盘需要设置根目录。注意：目录名要区分大小写</li>
            <li>比如百度网盘只能访问apps/合作网站名称/下的文件</li>
            <li>比如：/apps/dzzoffice,结尾不加/</li>
            <li>详细的设置和说明可以参照相关的api开发文档</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>API Key:</dt>
        <dd class="clearfix">
          <input type="text"  name="key" class="form-control"  value="<?php echo $cloud['key'];?>" >
          <ul class="help-block ">
            <li>在API官网申请的开发者API KEY</li>
            <li>如：百度网盘、需要在http://open.baidu.com 中申请开通合作站点，通过后就可以获得该应用的API Key和Secret Key</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>Secret Key</dt>
        <dd class="clearfix">
          <input type="text"  name="secret" class="form-control" value="<?php echo $cloud['secret'];?>" class="span4">
          <ul class="help-block ">
            <li>在API官网申请的开发者Secret Key</li>
            <li>如：百度网盘、需要在http://open.baidu.com 中申请开通合作站点，通过后就可以获得该应用的API Key和Secret Key</li>
          </ul>
        </dd>
      </dl>
      <input class="btn btn-primary"  name="editsubmit" value="保存更改" type="submit" >
    </form>
    <?php } ?> 
    <?php } else { ?>
    <div class="main-header ">
      <ul class="nav nav-pills nav-pills-bottomguide">
        <li <?php if(empty($_GET['do'])) { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>"> 设置</a>
        </li>
        <?php if($cloud['available']>0) { ?> 
        <li <?php if($_GET['do']=='usercloud') { ?>class="active"<?php } ?>><a href="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>&do=usercloud">使用用户</a>
        </li>
        <?php } ?>
      </ul>
    </div>
    <div class="main-content" style="padding:15px;border-top:1px solid #FFF"> 
      <?php if($_GET['do']=='usercloud') { ?>
      <form id="appform" name="appform" class="form-horizontal form-horizontal-left" style="margin:-15px -15px 0;" action="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&do=usercloud" method="post" >
        <input type="hidden" name="cloudsubmit" value="true" />
        <input type="hidden" name="bz" value="<?php echo $bz;?>" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30"></th>
              <th>名称</th>
              <th>用户名</th>
              <th>添加时间</th>
            </tr>
          </thead>
          
          <?php if(is_array($list)) foreach($list as $value) { ?>          <tr>
            <td width="40"><input type="checkbox"  name="delete[]" value="<?php echo $value['id'];?>" /></td>
            <td ><img src="<?php echo $value['img'];?>" /><?php echo $value['cloudname'];?></td>
            <td><?php echo $value['username'];?></td>
            <td> <?php echo $value['dateline'];?> </td>
          </tr>
          <?php } ?>
          <thead>
          <td  colspan="5"><input type="checkbox" name="chkall" id="chkall"  onclick="checkAll('prefix', this.form, 'del')">
              &nbsp;删&nbsp;&nbsp;&nbsp;
              <input type="submit" class="btn btn-primary" value="提交" />
              <?php echo $multi;?></td>
              </thead>
        </table>
      </form>
      <?php } else { ?>
      <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=cloud&op=edit&bz=<?php echo $bz;?>" class="form-horizontal form-horizontal-left" method="post" name="cpform">
        <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
        <input type="hidden" value="editsubmit" name="true">
        <dl>
          <dt>名称:</dt>
          <dd class="clearfix">
            <input type="text" class="form-control" name="name"  value="<?php echo $cloud['name'];?>">
            <span class="help-inline text-muted" >名称 </span> </dd>
        </dl>
        <dl>
          <dt>是否允许用户添加:</dt>
          <dd class="clearfix"><?php if($cloud['available']>0) { ?>
            <label class="radio radio-inline"> <input type="radio"  name="available"  value="2" <?php if($cloud['available']>1) { ?>checked="checked"<?php } ?>>是</label>
            <label class="radio radio-inline"> <input type="radio"  name="available"  value="1" <?php if($cloud['available']<2) { ?>checked="checked"<?php } ?>>否</label>
            <?php } else { ?>
            <input type="hidden"  name="available"  value="<?php echo $cloud['available'];?>" />
            <?php } ?>
            <ul class="help-block">
              <?php if($cloud['warning']) { ?>
              <li><span class=" text-danger"><?php echo $cloud['warning'];?></span></li>
              <?php } ?> 
              <?php if($cloud['available']<1) { ?>
              <li><span class=" text-danger">先启用 “<?php echo $cloud['name'];?>” 后才能设置此项</span></li>
              <?php } else { ?>
              <li>设置为“否”,用户在”我的云“里”添加云“时将不出现此云</li>
              <?php } ?>
              
            </ul>
          </dd>
        </dl>
        <dl>
          <dt>标志符:</dt>
          <dd class="clearfix">
            <input type="text"  name="bz" class="form-control" value="<?php echo $cloud['bz'];?>"  disabled="disabled">
            <ul class="help-block ">
              <li>标志符：此类的唯一标志，全站唯一,注意区分大小写</li>
              <li>相关的api内都会按此标志符来组织和建立</li>
              <li>详细的设置和说明可以参照相关的api开发文档</li>
            </ul>
          </dd>
        </dl>
        <input class="btn btn-primary"  name="editsubmit" value="保存更改" type="submit" >
      </form>
      <?php } ?> 
    </div>
  </div>
  <?php } ?> 
</div>
<script type="text/javascript">  
jQuery('.left-drager').leftDrager_layout();
</script> <?php include template('common/footer_simple'); ?> 