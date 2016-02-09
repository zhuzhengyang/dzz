<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<script src="dzz/scripts/dzz.api.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript" >  
try{
var api=_api.init();
}catch(e){}
</script>
<script type="text/javascript">var DZZSCRIPT='<?php echo DZZSCRIPT;?>', STATICURL = 'static/', IMGDIR = '<?php echo $_G['setting']['imgdir'];?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', dzz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>',attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>',  REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>';</script><script src="dzz/scripts/_fun.js?<?php echo VERHASH;?>" type="text/javascript"></script>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" >
<div id="append_parent" style="z-index:9999;"></div>
<div id="ajaxwaitid" style="z-index:9999;"></div>
