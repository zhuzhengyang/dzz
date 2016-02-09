<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?> -<?php } ?><?php echo $_G['setting']['sitename'];?> <?php if(!$ismobile) { ?>- Powered by DzzOffice<?php } ?></title>
<meta name="keywords" content="<?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); ?> <?php } ?>" />
<meta name="generator" content="DzzOffice" />
<meta name="author" content="DzzOffice" />
<meta name="copyright" content="2011-2015 www.dzzoffice.com" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<meta name="renderer" content="webkit">
<base href="<?php echo $_G['siteurl'];?>" />
<link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css?<?php echo VERHASH;?>">
<script src="dzz/scripts/jquery-1.10.2.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="dzz/scripts/jquery.json-2.4.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<!--[if lt IE 9]>
  <script src="static/bootstrap/js/html5shiv.min.js" type="text/javascript"></script>
  <script src="static/bootstrap/js/respond.min.js" type="text/javascript"></script>
<![endif]-->
