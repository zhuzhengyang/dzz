<?php if(!defined('IN_DZZ')) exit('Access Denied'); include template('common/header_simple_start'); ?><link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">

  <style>
  .tips{
  display:none;
  position:fixed;
  z-index:10000;
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
  html,body{overflow:hidden}
 
 </style>
 <script src="dzz/scripts/dzz.api.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript" >  
try{
var api=_api.init();
}catch(e){}	
if('<?php echo $editable;?>'>0) var needsave=2;
else var needsave=0;
try{api.win.needsave=needsave;}catch(e){}

</script><?php include template('common/header_simple_end'); ?>  <div class="tips" id="tips"></div>   
 <div  style="position:relative;width:100%;text-align:center;height:35px;z-index:1000"> 

    <div class="btn-group pull-right">
            <button type="button" class="btn btn-default" onclick="showPrintDialog()">打印</button>
        <?php if($isadmin==1) { ?>
            <?php if(!$filelocked) { ?>
                <button type="button" class="btn btn-default" onclick="save()">保存</button>
                <button type="button" class="btn btn-default" onclick="saveAndClose()">保存并关闭</button>
            <?php } ?>
        <?php } ?>
            <button type="button" class="btn btn-default" onclick="FullScreen()">全   屏</button>
            <button type="button" class="btn btn-default" onclick="Close()">关闭</button>
    
    </div>
    <div id="tip_head" class="pull-left" style="padding-left:120px;height:35px;line-height:35px;background:url(./dzz/djoffice/images/djlogo.png) 5px center no-repeat;">
    <?php if($filelocked) { ?><span class="text-danger"><?php echo $lockuser['username'];?> 正在编辑，当前为只读模式</span>
    <?php } elseif($isadmin<1) { ?><span class="text-danger">您没有编辑权限，当前为只读模式</span>
    <?php } ?>
    </div>
</div>


<div id="weboffice_container" style="width:100%;height:100%;">
    	<!-- -----------------------------== 装载weboffice控件 ==--------------------------------- -->
     <script src="dzz/djoffice/LoadWebOffice.js" type="text/javascript"></script>
<!-- --------------------------------== 结束装载控件 ==----------------------------------- -->
</div>



<script type="text/javascript">
jQuery(document).ready(function(e) {
    
jQuery('#weboffice_container').css('height',jQuery('body').height()-35);
    setTimeout('checkActivex()',1000)
    weboffice_init();
    var fName = "<?php echo $fileurl;?>";
    var filename = "<?php echo $icoarr['name'];?>";
    var pfid = "<?php echo $path;?>";
    var webObj = document.getElementById("WebOffice1");
    webObj.LoadOriginalFile(fName, GetFileType('<?php echo $icoarr['ext'];?>'));
});
window.onresize=function(){
window.setTimeout(function(){
jQuery('#weboffice_container').css('height',jQuery('body').height()-35);
},50);
}
window.onbeforeunload=function(){
if(needsave){
unlock();
}
};
function autosave(){
if(needsave){
unlock();
}
}
    function GetFileType(ext) {
       
        ext.toLowerCase();
        if (ext == "doc" || ext == "docx") {
            return "doc";
        }else if(ext == "xls" || ext == "xlsx") {
            return "xls";
        }else if(ext == "ppt" || ext == "pptx" ) {
            return "ppt";
        }else if(ext == "et") {
            return "xls";
}else if(ext == "csv") {
            return "xls";
}else if(ext == "wps") {
            return "wps";
        }

    }
    function getEvent() {

        if (document.all) {
            return window.event;//如果是ie
        }

        func = getEvent.caller;

        while (func != null) {
            var arg0 = func.arguments[0];
            if (arg0) {

                if ((arg0.constructor == Event || arg0.constructor == MouseEvent)
                || (typeof (arg0) == "object" && arg0.preventDefault && arg0.stopPropagation)) {
                    return arg0;
                }
            }
            func = func.caller;
        }

        return null;
    }

   
    function weboffice_init() {
        try {
            document.getElementById("WebOffice1").ShowToolBar = 0;	// 隐藏工具栏 0为隐藏; 1为显示
            //document.getElementById("WebOffice1").HideMenuArea("hideall", "", "", "");		//隐藏开始菜单栏			
            document.getElementById("WebOffice1").SetTrackRevisions(0);					//不修订
            document.getElementById("WebOffice1").ShowRevisions(0);						//不显示修订
            document.getElementById("WebOffice1").SetToolBarButton2("Menu Bar", 1, 4)
            obj.GetDocumentObject().ActiveWindow.ActivePane.View.Zoom.Percentage = 100;  //设置显示模式
           // document.getElementById("WebOffice1").OptionFlag |= 0x0080;//显示进度条

        } catch (e) {
            //showTips("异常\r\nError:"+e+"\r\nError Code:"+e.number+"\r\nError Des:"+e.description);
        }

    }
  
    function httppost() {
        var url = "<?php echo $_G['siteurl'];?><?php echo DZZSCRIPT;?>?mod=djoffice&op=weboffice&do=save&path=<?php echo $_GET['path'];?>&uid=<?php echo $_G['uid'];?>"
        document.getElementById("WebOffice1").HttpInit(); //初始化HTTP引擎。
        document.getElementById("WebOffice1").HttpAddPostString("uname", "<?php echo $_G['uid'];?>"); //设置上传变量文件名。
        //document.getElementById("WebOffice1").HttpAddPostString("hz", "doc"); //设置上传变量文件名。
        document.getElementById("WebOffice1").HttpAddPostCurrFile("file", "");//设置上传当前文件,文件标识为FileBlod。 
        var ispost = document.getElementById("WebOffice1").HttpPost(url);//上传数据。　
        if (ispost.indexOf('succeed')>-1) {
            showTips("文档保存成功！");
           
            //dwr.engine.setAsync(false); //设置方法调用是否同步，false表示同步
            //DJDwr.updateFileExist(id, 1);
        } else {
            showTips("文档保存失败！" + ispost);
            //var thisUrl = url + "index.jsp";
            //location.replace(thisUrl);
        }
    }
    /****************************************************
*
*					全屏
*
/****************************************************/
    function FullScreen() {
        try {
            var webObj = document.getElementById("WebOffice1");
            webObj.FullScreen = true;
        } catch (e) {
            showTips("异常\r\nError:" + e + "\r\nError Code:" + e.number + "\r\nError Des:" + e.description);
        }
    }
    function Close() {
        //if (filelocked){
           unlock();
       // }
  
            try {
                api.win.Close();       //窗体关闭
            } catch (e) {window.close();}
       

    }
    function showTips(msg, time) {
        if (!time) time = 5000;
        
        var el = jQuery('#tips');
        el.html(msg).slideDown();
        el.css({ "margin-left": -el.width() / 2 });
        window.setTimeout(function () { el.slideUp(); }, time);
    }
    var retry = 0;
    function unlock() {
        retry++;
        jQuery.ajax({
            type:'post',
            async: false,
            url:'<?php echo DZZSCRIPT;?>?mod=djoffice&op=weboffice&do=unlock',
            data:{path:'<?php echo $dpath;?>'},
            dataType:"json",
            success:function(json){
                
                if(json.msg=='success'){
                    showTips('文档解锁成功!');
needsave=0;
                }else{
                    if(retry>10){
                        showTips('无法保存文档，请确认您的网络连接正常后再次打开！'); 
                    }else{
                        showTips(json.msg+'! 正在重试 retry '+retry+'...'); 
                    }
                    window.setTimeout(unlock,3000);
                }
            },
            error:function(){
                if(retry>10){
                    showTips('无法保存文档，请确认您的网络连接正常后再次打开！'); 
                }else{
                    showTips('保存失败! 正在重试 '+retry+'...'); 
                }
                window.setTimeout(unlock,3000);
            }
        });

    }
    function saveAndClose() {
      		 save();
            window.setTimeout("Close()",2000);
    }

    function save() {
        var wbofc = document.getElementById("WebOffice1");//得到weboffice控件
        var tempPath = wbofc.GetTempFilePath();//获取本地临时路径
        if (wbofc.SaveTo(tempPath) >= 0) {
         	wbofc.DeleteFile(tempPath);
        }
httppost();
    }

 
    function showPrintDialog() {
        try {
            var webObj = document.getElementById("WebOffice1");
            webObj.PrintDoc(1);
        } catch (e) {
            showTips("异常\r\nError:" + e + "\r\nError Code:" + e.number + "\r\nError Des:" + e.description);
        }
    }
    function checkActivex(){

        var Sys = {};

        var ua = navigator.userAgent.toLowerCase();

        var s;

        (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :

        (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :

        (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :

        (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :

        (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
        var curWwwPath=window.document.location.href;    
        //获取主机地址之后的目录，如： uimcardprj/share/meun.jsp   
        var pathName=window.document.location.pathname;    
        var pos=curWwwPath.indexOf(pathName);
        var mulu = pathName.substring(0,pathName.substr(1).indexOf('/')+1);
        var smart = pathName.substring(mulu.length+1,pathName.lastIndexOf("/"));
        //获取主机地址，如： http://localhost:8083  
        var localhostPath=curWwwPath.substring(0,pos);  
        var isInstalled = false;
        var version = null;
        if (Sys.firefox || Sys.chrome) {
            var mimetype = navigator.mimeTypes["application/x-itst-activex"];
            if(mimetype){
                var plugin = mimetype.enabledPlugin;
                if(plugin){
                    //the plugins has done
                    try{
                        if(smart=="weboffice"){
                            document.getElementById("WebOffice1").GetOcxVersion();
                        }
                        if(smart=="aip"){
                            document.getElementById("HWPostil1").IsLogin();
                        }


                    }catch(e){
                        var s = "";
                        s += "<div align='center'>"
                        s +="<table border='1' style='border:1px solid #cad9ea'> <tr> <td colspan='2' style='border:1px solid #cad9ea; padding:0 1em 0;color:red'>麻烦了，您的电脑缺少插件，无法继续演示了，" +
                                    "您可能需要安装以下控件。</td> </tr>";
                        s +="<tr><td style='border:1px solid #cad9ea; padding:0 1em 0' align='left'>webOffice,aip控件，确保安装兼容插件后请下载安装此控件，安装后记得重启浏览器哦</td><td style='border:1px solid #cad9ea; padding:0 1em 0'><a href= '"+SITEURL+"dzz/djoffice/Setup.exe'>点击下载吧</a></td></tr>";
                        s +="<div >"
                        document.writeln(s); 
                        document.close(); 
                    }
                }
            }else{	
                var s = "";
                s += "<div align='center'>"
                s +="<table border='1' style='border:1px solid #cad9ea'> <thead> <th colspan='2' style='border:1px solid #cad9ea; padding:0 1em 0;color:red'>麻烦了，您的电脑缺少插件，无法继续演示了，" +
                            "您可能需要安装以下控件。</th> </thead>";
                s +="<tr><td style='border:1px solid #cad9ea; padding:0 1em 0'>兼容火狐或者谷歌浏览器插件，这个是要先安装的。安装后请重启浏览器</td><td style='border:1px solid #cad9ea; padding:0 1em 0'><a href= '"+SITEURL+"dzz/djoffice/ffactivex-setup-r39.exe' >点击下载吧</a></td></tr>";
                s +="<tr><td style='border:1px solid #cad9ea; padding:0 1em 0'>webOffice,aip控件，确保安装兼容插件后请下载安装此控件，安装后记得重启浏览器哦</td><td style='border:1px solid #cad9ea; padding:0 1em 0'><a href= '"+SITEURL+"dzz/djoffice/Setup.exe'>点击下载吧</a></td></tr>";
                s +="</table>";
                s +="<div >"
                document.writeln(s); 
                document.close(); 
            }
        } 

    }

</script> 
</body>
</html>