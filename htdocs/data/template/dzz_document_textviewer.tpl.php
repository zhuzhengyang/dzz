<?php if(!defined('IN_DZZ')) exit('Access Denied'); ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $icoarr['name'];?></title>
    <link rel="stylesheet" href="dzz/document/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="dzz/document/codemirror/addon/hint/show-hint.css">
<script src="dzz/scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="dzz/scripts/jquery.json-2.4.min.js" type="text/javascript"></script>
    <script src="dzz/document/codemirror/lib/codemirror.js" type="text/javascript"></script>
<script src="dzz/document/codemirror/addon/mode/loadmode.js" type="text/javascript"></script>
    <script src="dzz/document/codemirror/mode/javascript/javascript.js" type="text/javascript"></script>
    <?php if($isadmin>0) { ?>
    <link rel="stylesheet" href="dzz/document/codemirror/addon/dialog/dialog.css">
    <script src="dzz/document/codemirror/addon/dialog/dialog.js" type="text/javascript"></script>
    <script src="dzz/document/codemirror/addon/search/searchcursor.js" type="text/javascript"></script>
    <script src="dzz/document/codemirror/addon/search/search.js" type="text/javascript"></script>
    <?php } ?>
    <script src="dzz/scripts/dzz.api.js" type="text/javascript"></script>
   
  </head>
  <body>
  <style>
  .tips{
  display:none;
  position:fixed;
  z-index:10;
  background:RGBA(0,0,0,0.5);
   background:#000\0;
  filter:Alpha(opacity=50);
  left:50%;
  color:yellow;
  height:35px;
  line-height:35px;
  font-weight:bold;
  padding:0 20px;
  border-radius:0px 0px 10px 10px;
  }
  html,body{height:100%;margin:0;font-size:14px;}
  
  </style>
  <div class="tips" id="tips"></div>
    <form style="height:100%"><textarea id="code" name="code" ><?php echo $str;?></textarea></form>  
   <!-- <p><input type="text" value="<?php echo $mode;?>" id="mode" > <button type=button onclick="change()">change mode</button></p>-->


<script type="text/javascript">
try{
var api=_api.init();
var win=api.win;
}catch(e){}
var code='<?php echo $code;?>';

</script>
<script>
var mode='<?php echo $mode;?>';
CodeMirror.modeURL = "dzz/document/codemirror/mode/%N/%N.js";
     /* CodeMirror.commands.autocomplete = function(cm) {
        CodeMirror.showHint(cm, CodeMirror.javascriptHint);
      }*/
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
lineWrapping:true,
readOnly:parseInt('<?php echo $isadmin;?>')?false:true,
viewportMargin: Infinity
       // extraKeys: {"Ctrl-Space": "autocomplete"}
      });
 
/*var modeInput = document.getElementById("mode");
CodeMirror.on(modeInput, "keypress", function(e) {
  if (e.keyCode == 13) change();
});
function change() {
   editor.setOption("mode", modeInput.value);
   CodeMirror.autoLoadMode(editor, modeInput.value);
}*/
if(mode){
editor.setOption("mode", mode);
   CodeMirror.autoLoadMode(editor,mode);
}
var saveTimer=null;
var saveTime=10000;
var retry=0;
editor.on("change", function() {
win.needsave=2;
if(saveTimer) {
window.clearTimeout(saveTimer);
}
saveTimer=window.setTimeout(codesave,saveTime);

//console.log("saveTimer="+saveTimer+'===='+win.needsave);
});
function showTips(msg,time){
if(!time) time=5000;
var el=	jQuery('#tips');
el.html(msg).slideDown();
el.css({"margin-left":-el.width()/2});
window.setTimeout(function(){el.slideUp();},time);
}
function codesave(){
retry++;
jQuery.ajax({
 type:'post',
 async: false,
 url:'<?php echo DZZSCRIPT;?>?mod=document&op=textviewer&do=autosave&t='+new Date().getTime(),
 data:{code:'<?php echo $code;?>',path:'<?php echo $dpath;?>',message:editor.getValue()},
 dataType:"json",
 success:function(json){
 if(json.msg=='success'){
showTips('文档自动保存成功!');
win.needsave=0;
retry=0;
var ico=json.icodata;
parent._config.sourcedata.icos[ico.icoid]=ico;
 }else{
 if(retry>10){
  showTips('无法保存文档，请确认您的网络连接正常后再次打开！'); 
 }else{
 	showTips(json.msg+'! 正在重试 retry '+retry+'...'); 
 }
 window.setTimeout(codesave,3000);
 }
 },
 error:function(){
 if(retry>10){
  showTips('无法保存文档，请确认您的网络连接正常后再次打开！'); 
 }else{
  showTips('保存失败! 正在重试 '+retry+'...'); 
 }
 window.setTimeout(codesave,3000);
 }
 });
}
function autosave(){
codesave();
}
window.onbeforeunload=function(){
if(win.needsave>0) codesave();
}
    </script>
  
  </body>
</html>