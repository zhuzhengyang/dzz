<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit">
   <?php if($_G['config']['output']['iecompatible']) { ?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE<?php echo $_G['config']['output']['iecompatible'];?>" /><?php } ?>
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if(!empty($_G['setting']['sitename'])) { ?> <?php echo $_G['setting']['sitename'];?> - <?php } ?> Powered by DzzOffice</title>
<meta name="keywords" content="<?php if(!empty($_G['setting']['metakeywords'])) { echo htmlspecialchars($_G['setting']['metakeywords']); } ?> " />
<meta name="description" content="<?php if(!empty($_G['setting']['metadescription'])) { echo htmlspecialchars($_G['setting']['metadescription']); ?> <?php } ?>" />
<meta name="generator" content="DzzOffice <?php echo CORE_VERSION;?>" />
<meta name="author" content="DzzOffice" />
<meta name="copyright" content="2011-2014 Dzz.cc.Inc" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<meta http-equiv="X-Frame-Options" content="SAMEORIGIN ">
<base href="<?php echo $_G['siteurl'];?>" />
     <link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css?<?php echo VERHASH;?>">
 <?php if(defined('CURMODULE') && CURMODULE == 'dzzindex' ) { ?> 
    <!--基础css-->
    <link rel="stylesheet" type="text/css" href="static/css/common.css?<?php echo VERHASH;?>">
    <link rel="stylesheet" type="text/css" href="dzz/styles/index.css?<?php echo VERHASH;?>">
    <!--showwindow 提示窗体-->
    <link id="css_showwindow" href="dzz/styles/showwindow/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
   
    <?php if(is_array($space['thame']['modules'])) foreach($space['thame']['modules'] as $key => $value) { ?>        <link id="css_<?php echo $key;?>" href="dzz/styles/<?php echo $key;?>/<?php echo $value;?>/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
    <?php } ?>
    <?php if($space['thame']['color']) { ?>
        <link id="css_color" href="<?php echo DZZSCRIPT;?>?mod=system&op=ajax&do=getColorCss&color=<?php echo rawurlencode($space[thame][color])?>&css=<?php echo $space['thame']['folder'];?>" rel="stylesheet" type="text/css">
    <?php } ?>
    <!--主题自定义样式，如果定义将覆盖上述相关样式-->
    <link id="css_thame" href="dzz/styles/thame/<?php echo $space['thame']['folder'];?>/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
         <!-- the jQuery lib script -->
<script src="dzz/scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="dzz/scripts/jquery.ui.touch.js" type="text/javascript"></script>
<script src="dzz/scripts/jquery.json-2.4.min.js" type="text/javascript"></script>
<script src="dzz/scripts/jquery.mousewheel.js" type="text/javascript"></script>
        <?php if(defined('CURMODULE') && CURMODULE == 'dzzindex' ) { ?> 
 <script src="dzz/language/zh_CN.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
 <?php } ?>
<script type="text/javascript">var DZZSCRIPT='<?php echo DZZSCRIPT;?>', STATICURL = 'static/', IMGDIR = '<?php echo $_G['setting']['imgdir'];?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', dzz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>',attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>',  REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>';</script>
 <script src="dzz/scripts/_fun.js?<?php echo VERHASH;?>" type="text/javascript"></script>
 <script src="dzz/scripts/_config.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
     <!--[if lt IE 9]>
      <script src="static/bootstrap/js/html5shiv.min.js" type="text/javascript"></script>
      <script src="static/bootstrap/js/respond.min.js" type="text/javascript"></script>
    <![endif]-->
    </head>
    <body id="nv_dzz" >
<div id="append_parent" ></div><div id="ajaxwaitid" ></div>