<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if(!empty($_G['setting']['sitename'])) { ?> <?php echo $_G['setting']['sitename'];?> - <?php } ?> Powered by DzzOffice</title>
<meta name="keywords" content="<?php if(!empty($_G['setting']['metakeywords'])) { echo htmlspecialchars($_G['setting']['metakeywords']); } ?> " />
<meta name="description" content="<?php if(!empty($_G['setting']['metadescription'])) { echo htmlspecialchars($_G['setting']['metadescription']); ?> <?php } ?>" />
<meta name="generator" content="DzzOffice" />
    <meta name="author" content="DzzOffice" />
    <meta name="copyright" content="2011-2014 www.dzzoffice.com" />
    <meta name="MSSmartTagsPreventParsing" content="True" />
    <meta http-equiv="MSThemeCompatible" content="Yes" />
    <meta name="renderer" content="webkit">
<base href="<?php echo $_G['siteurl'];?>" />
     <link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css?<?php echo VERHASH;?>">
<script src="dzz/scripts/jquery-1.10.2.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/jquery.json-2.4.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">var DZZSCRIPT='<?php echo DZZSCRIPT;?>',STYLEID = '1', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo $_G['setting']['imgdir'];?>', VERHASH = '<?php echo $_G['setting']['verhash'];?>', charset = '<?php echo CHARSET;?>', dzz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>',   SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>',disallowfloat=''</script>
 <script src="dzz/scripts/_fun.js?<?php echo VERHASH;?>" type="text/javascript"></script>
 <!--[if lt IE 9]><script src="./dzz/scripts/html5.js" type="text/javascript" type="text/javascript" xmlns="http://www.w3.org/1999/xhtml"></script><![endif]-->
    </head>
    <body id="nv_dzz">
<div id="append_parent" style="z-index:99999;"></div><div id="ajaxwaitid" style="z-index:99999;"></div>