

var Sys = {};

var ua = navigator.userAgent.toLowerCase();

var s;

(s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :

(s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :

(s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :

(s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :

(s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;


if (Sys.ie) {

	var s = ""
s += "<object id=WebOffice1 height='100%' width='100%' style='LEFT: 0px; TOP: 0pxz-index:1;position:relative'   classid='clsid:E77E049B-23FC-4DB8-B756-60529A35FAD5' codebase='dzz/djoffice/WebOffice.cab#Version=7,0,1,0'>"
s +="<param name='_ExtentX' value='6350'><param name='_ExtentY' value='6350'><param name='wmode' value='transparent'>"
s +="</OBJECT>"
document.write(s)
   
}

if (Sys.firefox || Sys.chrome) {

    var s = ""
    s += "<object id=WebOffice1 TYPE='application/x-itst-activex'  clsid='{E77E049B-23FC-4DB8-B756-60529A35FAD5}' event_NotifyCtrlReady='NotifyCtrlReady' progid='' height='100%' width='100%' style='LEFT: 0px; TOP: 0px;z-index:1;position:relative' codeBase='dzz/djoffice/Weboffice.cab#version=7,0,1,0' >"
    s += "<param name='_ExtentX' value='6350'><param name='_ExtentY' value='6350'><param name='wmode' value='transparent'>"
    s += "</OBJECT>"
    document.write(s);
}
