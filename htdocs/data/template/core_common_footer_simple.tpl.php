<?php if(!defined('IN_DZZ')) exit('Access Denied'); updatesession();?><?php if(debuginfo()) { ?>
<script type="text/javascript">
try{
if(console && console.log){
console.log('Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries <?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if(C::memory()->type) { ?>, <?php echo ucwords(C::memory()->type); ?> On<?php } ?>.');
}
}catch(e){}
</script>
<?php } ?>		
<script type="text/javascript">
try{
jQuery(document).on('mousedown',function(){
try{if(top!=window) top.dfire('mousedown');}catch(e){}
});
if ("onfocusin" in document){//for IE 
document.onfocusin = function() {
top.CurrentActive = true;
};
document.onfocusout = function() {
top.CurrentActive = false;
};
} else {
window.onfocus = function() {
top.CurrentActive = true;
}
window.onblur = function() {
top.CurrentActive = false;
}
}

jQuery(document).ready(function(e) {
        try{api.showLoading('hide');}catch(e){}
    });
window.onbeforeunload=function(){
try{if(!BROWSER.ie || BROWSER.ie>10) return api.showLoading('show');}catch(e){}
if(typeof beforeunload =='function') return beforeunload();
}
}catch(e){}
</script>
<?php if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="misc.php?mod=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendwx'])) { ?>
<script src="misc.php?mod=sendwx&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } ?>
</body>
</html>
