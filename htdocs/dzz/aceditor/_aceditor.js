/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

function _aceditor(id,data)
{
	this.id=this.name=id;
	this.string="_aceditor.cons."+this.id;
	this.data=data;
	_aceditor.cons[id]=this;
};
_aceditor.cons={};
_aceditor.tab={};
_aceditor.needsave=[];
_aceditor.ceditorid=null;
_aceditor.current=0;
_aceditor.cpurl='index.php?mod=aceditor&op=cp';
_aceditor.setting={fontSize:'12px',theme:'ace/theme/tomorrow',autoComplete:'1',wrapMode:'1',BehavioursEnabled:'0',printMargin:'1',indentGuide:'1',showGutter:'1',showInvisible:'0'};
_aceditor.tab.scrollspeed=40;
_aceditor.tab.scrolldelay=50;
_aceditor.tab.scrolltimer=0;

_aceditor.init=function(setting){

	_aceditor.setting=jQuery.extend(_aceditor.setting,setting);
	if(getcookie('aceditor_setting_'+dzz_uid)){//如果有设置的cookie;
		var cs=getcookie('aceditor_setting_'+dzz_uid);
		var csarr=cs.split('|');
	
		var index=0;
		for(var i in _aceditor.setting){
			if(csarr[index]) _aceditor.setting[i]=csarr[index];
			index++;
		}
	}
	//初始化工具栏
	_aceditor.toolbar.init(_aceditor.setting);
	//绑定tab滚动
	jQuery('.hscroll button').on('mousedown',_aceditor.tab.scrollHandler);
};
_aceditor.setSettingCookie=function(){
	var csarr=[];
	for(var i in _aceditor.setting){
		csarr.push(_aceditor.setting[i]);
	}
	setcookie('aceditor_setting_'+dzz_uid,csarr.join('|'),60*60*24*365);
}
_aceditor.setNeedsave=function(eid,val){
	var index=jQuery.inArray(eid,_aceditor.needsave);
	if(val>0){
		if(index>-1) return;
		else{
			_aceditor.needsave.push(eid);
			jQuery('#tab_'+eid).addClass('aceditor-changed');
		}
	}else{
		if(index>-1){
			_aceditor.needsave.splice(index,1);
			jQuery('#tab_'+eid).removeClass('aceditor-changed');
		}else{
			return;
		}
	}
	
	var needsave=0
	if(_aceditor.needsave.length){
		needsave=1;
		jQuery('.aceditor-save,.aceditor-saveall').removeClass('disabled');
	}else{
		jQuery('.aceditor-save,.aceditor-saveall').addClass('disabled');
	}
	try{
		api.win.needsave=needsave;
		api.win.url='';
	}catch(e){}
}
_aceditor.New=function(filename){ //创建新的空文档，后缀名需要指定
	if(!filename) filename='new.txt';
	
		var obj=new _aceditor('aceditor_'+(++_aceditor.current),{path:'',filename:filename,code:'UTF-8','readOnly':top._config?false:true});
			obj.create('');
}
_aceditor.Open=function(path){
	if(!path) return false;
	//查找已经存在此路径的
	for(var i in _aceditor.cons){
		if(_aceditor.cons[i].data['dpath']==path){
			_aceditor.cons[i].tabactive();
			return;
		}
	}
	showmessage('<img src="static/image/common/loading.gif">正在打开，请稍候...','success',0,1);
	jQuery.getJSON(_aceditor.cpurl+'&do=getDataByPath',{path:path},function(json){
		if(json.error){
			showmessage(json.error,'danger',3000,1);
			return;
		}
		showmessage('<img src="static/image/common/loading.gif">正在打开，请稍候...','success',1,1);
		var obj=new _aceditor('aceditor_'+(++_aceditor.current),{'path':json.path,'filename':json.filename,'code':json.code,'readOnly':json.readOnly,'tree':json.tree,'dpath':path});
		obj.create(json.str);
	});
	
}
_aceditor.tabactive=function(id){
	jQuery('#tab_'+id).tab('show');
	jQuery('.tab-pane').removeClass('active');
	jQuery('#'+id).addClass('active');
}
_aceditor.prototype.tabactive=function(){
	
	jQuery('#tab_'+this.id).tab('show');
	jQuery('.tab-pane').removeClass('active');
	jQuery('#'+this.id).addClass('active');
	//活动的标签不被挡住；
	_aceditor.ceditorid=this.id
	 this.editor.focus();
	_aceditor.tab.setVisible(this.id);
}
_aceditor.prototype.Close=function(){
	
	_aceditor.setNeedsave(this.id,-1);
	this.editor.destroy();
	jQuery('#tab_'+this.id).remove();
	jQuery('#'+this.id).remove();
	
	for(var key in this){
		delete[key];
	}
	delete _aceditor.cons[this.id];
	
	//激活新的标签
	var newtab='';
	for(var i in _aceditor.cons){
		newtab=i;
	}
	if(newtab) _aceditor.cons[newtab].tabactive();
	else{
		 _aceditor.New();
	}
	_aceditor.tab.init();
}
_aceditor.prototype.create=function(str){
	var me=this;
	jQuery('<div id="'+this.id+'" class="tab-pane aceditor-content"></div>').appendTo('#aceditor_tab_content');
	jQuery('<li id="tab_'+this.id+'" role="presentation" ><a href="#'+this.id+'" role="tab"  data-toggle="tab" data-eid="'+this.id+'" title="'+this.data['tree']+'">'+this.data['filename']+'</a><span  class="tabclose"></span></li>').appendTo('#aceditor_tab');
   this.editor = ace.edit(this.id); 
   this.editor.session.getUndoManager().reset();
   this.editor.setValue(str,-1);
  
   this.editor.navigateLineEnd();
  
   
    this.editor.setTheme(_aceditor.setting.theme);
	if(this.data['readOnly']) this.editor.setReadOnly(true);
	if(_aceditor.setting.BehavioursEnabled>0) this.editor.setBehavioursEnabled(true);
	if(_aceditor.setting.wrapMode>0) this.editor.session.setUseWrapMode(true);
	this.editor.setFontSize(_aceditor.setting.fontSize);
    // enable autocompletion and snippets
	(function () {
        var modelist = ace.require("ace/ext/modelist");
        var filePath = me.data['filename'];
        var mode = modelist.getModeForPath(filePath).mode;
        me.editor.session.setMode(mode);
    }());
    this.editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: (_aceditor.setting.autoComplete>0?true:false),
		showGutter: (_aceditor.setting.showGutter>0?true:false)
    });
	//{fontSize:'12px',theme:'ace/theme/tomorrow',autoComplete:'1',wrapMode:'1',BehavioursEnabled:'0',printMargin:'1',indentGuide:'1',showGutter:'1',showInvisible:'0'}
	this.editor.setDisplayIndentGuides(_aceditor.setting.indentGuide>0?true:false);
	this.editor.setShowPrintMargin(_aceditor.setting.printMargin>0?true:false);
	this.editor.setBehavioursEnabled(_aceditor.setting.BehavioursEnabled>0?true:false);
	this.editor.setShowInvisibles(_aceditor.setting.showInvisible>0?true:false);
	this.editor.commands.addCommands([
		{
			name: "showSettingsMenu",
			bindKey: {win: "Ctrl-q", mac: "Command-q"},
			exec: function(editor) {
				ace.config.loadModule("ace/ext/settings_menu", function(module) {
					module.init(editor);
					editor.showSettingsMenu();
				})
			},
			readOnly: true
		},
		{
			name: "showKeyboardShortcuts",
			bindKey: {win: "Ctrl-Alt-h", mac: "Command-Alt-h"},
			exec: function(editor) {
				ace.config.loadModule("ace/ext/keybinding_menu", function(module) {
					module.init(editor);
					editor.showKeyboardShortcuts()
				})
			},
			readOnly: true
		},
		{
			name: "editor_save",
			bindKey: {win: "Ctrl-S", mac: "Command-S"},
			exec: function(editor) {
				_aceditor.save(editor.container.id);
			},
			readOnly: true
		},
		{
			name: "editor_save_all",
			bindKey: {win: "Ctrl-Alt-S", mac: "Command-Alt-S"},
			exec: function(editor) {
				_aceditor.saveall();
			},
			readOnly: true
		}
	]);
	
	this.editor.on("change", function() {
		_aceditor.setNeedsave(me.id,1);
	});
	this.editor.on("focus", function(){
		me.tabactive();
	});
	
	this.tabactive();
	_aceditor.setHeight();
	_aceditor.tab.init();
	jQuery('#tab_'+this.id).on('shown.bs.tab', function (e) {
		_aceditor.ceditorid=me.id
	   _aceditor.tab.setVisible(me.id);
	});
	jQuery('#tab_'+this.id+' .tabclose').on('click',function(){
		_aceditor.Close(me.id);
	});
	//绑定标签页的滚动事件
	_aceditor.tab.sortHandler(this.id);
	
}
_aceditor.Close=function(editorid){//保存文件
	if(jQuery('#tab_'+editorid).hasClass('aceditor-changed')){
		showDialog('文件尚未保存，是否保存？', 'confirm', '警告'
		, function(){
			_aceditor.save(editorid,function(){
				_aceditor.cons[editorid].Close();
			});
		}, 1
		, function(){
			_aceditor.cons[editorid].Close();
		}, '', '保存', '不保存', 0, 0);
	}else{
		_aceditor.cons[editorid].Close();
	}
}
_aceditor.save=function(editorid,callback){//保存文件
	if(jQuery('#tab_'+editorid).hasClass('aceditor-changed') && _aceditor.cons[editorid]){
		var data=_aceditor.cons[editorid].data;
		if(!data.path){
			top.OpenFile('saveto','保存文件',_aceditor.saveexts,{bz:'all',name:data.filename},function(ret){//只打开本地盘
				if(ret.icodata && ret.icodata.dpath){
					jQuery.post(_aceditor.cpurl+'&do=save',{fileContent:_aceditor.cons[editorid].editor.getValue(),path:ret.icodata.dpath,code:ret.filecode,filename:ret.name,isnew:1},function(json){
						if(json.error){
							showmessage(json.error,'danger',3000,1);
							if(typeof callback =='function') callback();
						}else if(json.msg=='success'){
							showmessage('保存成功','success',1000,1);
							_aceditor.cons[editorid].data=json.data;
							jQuery('#tab_'+editorid).attr('title',json.data.tree).html(json.data.filename);
							jQuery('#tab_'+editorid).removeClass('aceditor-changed');
							_aceditor.setNeedsave(editorid,-1);
							if(typeof callback =='function') callback();
						}
					},'json');
				}else{
					jQuery.post(_aceditor.cpurl+'&do=saveto',{fileContent:_aceditor.cons[editorid].editor.getValue(),path:ret.position,code:ret.filecode,filename:ret.name},function(json){
						if(json.error){
							showmessage(json.error,'danger',3000,1);
							if(typeof callback =='function') callback();
						}else if(json.msg=='success'){
							showmessage('保存成功','success',1000,1);
							_aceditor.cons[editorid].data=json.data;
							jQuery('#tab_'+editorid+' a').attr('title',json.data.tree).html(json.data.filename);
							jQuery('#tab_'+editorid).removeClass('aceditor-changed');
							if(json.icoarr){
								try{
									top._ico.createIco(json.icoarr);
									}catch(e){};
							}
							_aceditor.setNeedsave(editorid,-1);
							if(typeof callback =='function') callback();
						}
					},'json');
				}
			});
		}else{
			jQuery.post(_aceditor.cpurl+'&do=save',{fileContent:_aceditor.cons[editorid].editor.getValue(),path:data.dpath,code:data.code,filename:data.filename},function(json){
				if(json.error){
					showmessage(json.error,'danger',3000,1);
					if(typeof callback =='function') callback();
				}else if(json.msg=='success'){
					showmessage('保存成功','success',1000,1);
					jQuery('#tab_'+editorid).removeClass('aceditor-changed');
					_aceditor.setNeedsave(editorid,-1);
					if(typeof callback =='function') callback();
				}
			},'json');
		}
	}else{
		return false;
	}
}
_aceditor.saveall=function(){//保存全部
	if(jQuery('#aceditor_tab li.aceditor-changed a:first').length){
		var editorid=jQuery('#aceditor_tab li.aceditor-changed a:first').data('eid');
		_aceditor.save(editorid,function(){
			_aceditor.saveall();
		});
	}
}

_aceditor.OpenFile=function(){//打开文件；
	top.OpenFile('open','打开文件',_aceditor.openexts,{bz:'all',multiple:true},function(data){//只打开本地盘
				var datas=[];
				if(data.params.multiple){
					datas=data.icodata
				}else{
					datas=[data.icodata];
				}
				for(var i in datas){
				   _aceditor.Open(datas[i].dpath);
			   }
	});
	
};
_aceditor.setHeight=function(){
	var clientHeight=document.documentElement.clientHeight;
	jQuery('#intro').css('top',jQuery('.aceditor-toolbarbox').outerHeight(true));
	jQuery('#aceditor_tab_content').css('top',jQuery('#editor_main').offset().top+jQuery('#aceditor_tab').outerHeight(true));
}

_aceditor.setTheme=function(theme,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.setTheme(theme);
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.setTheme(theme);
		}
	}
}
_aceditor.setFontSize=function(font,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.setFontSize(parseInt(font));
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.setFontSize(parseInt(font));
		}
	}
	
}
_aceditor.setWrapMode=function(flag,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.session.setUseWrapMode(flag?true:false);
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.session.setUseWrapMode(flag?true:false);
		}
	}
}

_aceditor.setDisplayIndentGuides=function(flag,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.setDisplayIndentGuides(flag?true:false);
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.setDisplayIndentGuides(flag?true:false);
		}
	}
}
_aceditor.setShowPrintMargin=function(flag,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.setShowPrintMargin(flag?true:false);
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.setShowPrintMargin(flag?true:false);
		}
	}
}
_aceditor.setBehavioursEnabled=function(flag,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.setBehavioursEnabled(flag?true:false);
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.setBehavioursEnabled(flag?true:false);
		}
	}
}
_aceditor.setShowInvisibles=function(flag,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.setShowInvisibles(flag?true:false);
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.setShowInvisibles(flag?true:false);
		}
	}
}
_aceditor.setOptions=function(obj,editorid){
	if(editorid){
		_aceditor.cons[editorid].editor.setOptions(obj);
	}else{
		for(var i in _aceditor.cons){
			_aceditor.cons[i].editor.setOptions(obj);
		}
	}
}
_aceditor.toolbar={};

_aceditor.toolbar.init=function(setting){
	if(!top._config){
		jQuery('.aceditor-button.aceditor-open,.aceditor-button.aceditor-new').addClass('disabled');
	}
	for(key in setting){//{fontSize:'12px',theme:'ace/theme/tomorrow',autoComplete:1,wrapMode:1,BehavioursEnabled:0,printMargin:1,indentGuide:1,showGutter:1}
		switch(key){
			case 'fontSize':
				jQuery('#dropdownMenu_fontSize').html(setting[key]+'<span class="caret"></span>');
				break;
			case 'theme':
				var el=jQuery('#dropdownMenu_codeStyle');
				var themetitle=el.parent().find('li a[data-theme="'+setting[key]+'"]').html();
				jQuery('#dropdownMenu_codeStyle').html(themetitle+'<span class="caret"></span>');
				break;
			case 'showGutter':
				if(setting[key]>0) jQuery('.aceditor-showGutter').addClass('checked');
				break;
			case 'wrapMode':
				if(setting[key]>0) jQuery('.aceditor-wrapMode').addClass('checked');
				break;
			case 'indentGuide':
				if(setting[key]>0) jQuery('.aceditor-indentGuide').addClass('checked');
				break;
			case 'printMargin':
				if(setting[key]>0) jQuery('.aceditor-printMargin').addClass('checked');
				break;
			case 'showInvisible':
				if(setting[key]>0) jQuery('.aceditor-showInvisible').addClass('checked');
				break;
			case 'autoComplete':
				if(setting[key]>0) jQuery('.aceditor-autoComplete').addClass('checked');
				break;
			case 'BehavioursEnabled':
				if(setting[key]>0) jQuery('.aceditor-BehavioursEnabled').addClass('checked');
				break;
		}
	}
	
	//绑定按钮事件
	jQuery('.aceditor-button').on('click',function(e){
		var key=jQuery(this).data('action');
		var updatecookie=0;
		switch(key){
			case 'showGutter':
				var val=jQuery(this).hasClass('checked')?'0':'1';
				_aceditor.setting[key]=val;
				updatecookie=1;
				_aceditor.setOptions({showGutter:parseInt(val)});
				jQuery('.aceditor-showGutter').toggleClass('checked');
				break;
			case 'wrapMode':
				var val=jQuery(this).hasClass('checked')?'0':'1';
				_aceditor.setting[key]=val;
				updatecookie=1;
				_aceditor.setWrapMode(parseInt(val));
				jQuery('.aceditor-wrapMode').toggleClass('checked');
				break;
			case 'indentGuide':
				var val=jQuery(this).hasClass('checked')?'0':'1';
				_aceditor.setting[key]=val;
				updatecookie=1;
				_aceditor.setDisplayIndentGuides(parseInt(val));
				jQuery('.aceditor-indentGuide').toggleClass('checked');
				break;
			case 'printMargin':
				var val=jQuery(this).hasClass('checked')?'0':'1';
				_aceditor.setting[key]=val;
				updatecookie=1;
				_aceditor.setShowPrintMargin(parseInt(val));
				jQuery('.aceditor-printMargin').toggleClass('checked');
				break;
			case 'showInvisible':
				var val=jQuery(this).hasClass('checked')?'0':'1';
				_aceditor.setting[key]=val;
				updatecookie=1;
				_aceditor.setShowInvisibles(parseInt(val));
				jQuery('.aceditor-showInvisible').toggleClass('checked');
				break;
			case 'autoComplete':
				var val=jQuery(this).hasClass('checked')?false:true;
				_aceditor.setting[key]=val?'1':'0';
				updatecookie=1;
				_aceditor.setOptions({enableLiveAutocompletion:val});
				jQuery('.aceditor-autoComplete').toggleClass('checked');
				break;
			case 'BehavioursEnabled':
				var val=jQuery(this).hasClass('checked')?'0':'1';
				_aceditor.setting[key]=val;
				updatecookie=1;
				_aceditor.setBehavioursEnabled(parseInt(val));
				jQuery('.aceditor-BehavioursEnabled').toggleClass('checked');
				break;
			case 'undo':
				if(_aceditor.cons[_aceditor.ceditorid]) _aceditor.cons[_aceditor.ceditorid].editor.execCommand('undo');
				break;
			case 'redo':
				if(_aceditor.cons[_aceditor.ceditorid]) _aceditor.cons[_aceditor.ceditorid].editor.execCommand('redo');
				break;
			case 'setting':
				if(_aceditor.cons[_aceditor.ceditorid]) _aceditor.cons[_aceditor.ceditorid].editor.execCommand('showSettingsMenu');
				break;
			case 'find':
				var val=jQuery(this).data('find') || 0;
				if(val<1){
					val=1;
					if(_aceditor.cons[_aceditor.ceditorid]) _aceditor.cons[_aceditor.ceditorid].editor.execCommand('find');
				}else{
					val=0;
					if(_aceditor.cons[_aceditor.ceditorid]) _aceditor.cons[_aceditor.ceditorid].editor.execCommand('replace');
				}
				jQuery('.aceditor-find').data('find',val);
				break;
			case 'jump':
				if(_aceditor.cons[_aceditor.ceditorid]) 	_aceditor.cons[_aceditor.ceditorid].editor.execCommand('gotoline');
				break;
			case 'shortcut':
				if(_aceditor.cons[_aceditor.ceditorid]) _aceditor.cons[_aceditor.ceditorid].editor.execCommand('showKeyboardShortcuts');
				break;
			case 'save':
				_aceditor.save(_aceditor.ceditorid);
				break;
			case 'saveall':
				_aceditor.saveall(_aceditor.ceditorid);
				break;
			case 'open':
				_aceditor.OpenFile();
				break;
			case 'new':
				_aceditor.New();
				break;
		}
		if(updatecookie){
			_aceditor.setSettingCookie();
		}
		return false;
	});
	
};

_aceditor.tab.init=function(){//检查tab容器的宽度，超过宽度显示滚动按钮
	//设置宽度和滚动按钮
	var tabContainer=jQuery('#aceditor_tab_container');
	var tab=jQuery('#aceditor_tab');
	_aceditor.tabCwidth=tabContainer.outerWidth(true);
	_aceditor.tabwidth=tab.outerWidth(true);
	if(_aceditor.tabwidth>_aceditor.tabCwidth) tabContainer.addClass('ishscroll');
	else tabContainer.removeClass('ishscroll');
	//检查当left小于0时，放到窗体时
	var left=parseInt(tab.css('left')) ||0;
	if(left<0){
		left=_aceditor.tabCwidth-_aceditor.tabwidth-jQuery('.hscroll').outerWidth(true);
		if(left>0) left=0;
		tab.css('left',left);
	}
	_aceditor.tab.setVisible(_aceditor.ceditorid);
}
_aceditor.tab.sortHandler=function(editorid){
	var tab=jQuery('#tab_'+editorid);
	var ul=jQuery('#aceditor_tab');
	var draging=false;
	var mousedownTimer=null;
	if(!document.getElementById('_blank')){
		var _blank=jQuery('<div id="_blank" class="nokpdrager"  unselectable="on" onselectstart="return event.srcElement.type== \'text\';" style="display:none; url(dzz/images/b.gif); z-index:10000;width:100%;height:100%;margin:0;padding:0; right: 0px; bottom: 0px;position: absolute; top:0px; left: 0px;"></div>').appendTo('#aceditor_tab_container');
	}else{
		_blank=jQuery('#_blank');
	}
	tab.on('mousedown.sort',function(e){
		if(e.preventDefault) e.preventDefault();
		else e.returnvalue=false;
		//_aceditor.cons[editorid].tabactive();
		 mousedownTimer=setTimeout(function(){PreMove(e.clientX,e.clientY,self);},200);
	});
	tab.on('mouseup.sort',function(e){
		if(mousedownTimer) {
			clearTimeout(mousedownTimer);
		}
	});
	var PreMove=function(xx,yy){
		var scrolltimer_left=scrolltimer_right=null;
		var x = xx;
		var y = yy;
		var w = tab.width();
		var h = tab.height();
		var w2 = w/2;
		var ul_left=parseInt(ul.css('left')) || 0;
		var p = tab.offset();
		var p1=tab.position();
		var left=p1.left;
		dx=x-p.left;
		darging=true;
		_blank.show();
		tab.before('<li id="kp_widget_holder">&nbsp;</li>');
		var wid = jQuery("#kp_widget_holder");
		wid.css({"height":h, "width":w});
		// 保持原来的宽高
		tab.css({"width":w, "height":h, "position":"absolute",  "z-index": 999, "left":left, "top":0});
		
		//创建空白遮盖层
		// 绑定mousemove事件
		jQuery(document).mousemove(function(e) {
			e=e?e:window.event;
			if(e.preventDefault) e.preventDefault();
			else e.returnValue=false;
			var xx=e.clientX;
			if(xx-dx<=0 ){
				if(scrolltimer_right) window.clearInterval(scrolltimer_right);
				if(!scrolltimer_left){
				   scrolltimer_left=window.setInterval(function(){
						ul_left+=_aceditor.tab.scrollspeed/2;
						if(ul_left>0){
							ul_left=0;
							window.clearInterval(scrolltimer_left)
						}
						ul.css('left',ul_left);
						var l = xx-dx-ul_left;
						tab.css('left',xx-dx-ul_left);
						
					   },50);
				}
			}else{
				if(scrolltimer_left) window.clearInterval(scrolltimer_left);
			}
			if(xx-dx+tab.width()>=_aceditor.tabCwidth){
				if(scrolltimer_left) window.clearInterval(scrolltimer_left);
				if(!scrolltimer_right){
				   scrolltimer_right=window.setInterval(function(){
						ul_left-=_aceditor.tab.scrollspeed/2;
						if(ul_left+_aceditor.tabwidth<=(_aceditor.tabcwidth-jQuery('.hscroll').outerWidth(true))){
							ul_left=(_aceditor.tabcwidth-jQuery('.hscroll').outerWidth(true))-_aceditor.tabwidth;
							if(scrolltimer_right) window.clearInterval(scrolltimer_right);
						}else{
							ul_left-=_aceditor.tab.scrollspeed/2;
							if(ul_left+_aceditor.tabwidth<=(_aceditor.tabCwidth-jQuery('.hscroll').outerWidth(true))){
								ul_left=(_aceditor.tabCwidth-jQuery('.hscroll').outerWidth(true))-_aceditor.tabwidth
							}
						}
						ul.css('left',ul_left);
						var l = xx-dx-ul_left;
						tab.css('left',xx-dx-ul_left);
					},50);
				}
			}else{
				if(scrolltimer_right) window.clearInterval(scrolltimer_right);
			}
			var l = xx-dx-ul_left;
			tab.css('left',l);
		
			// 选中块的中心坐标
			var ml = l+w2;
			// 遍历所有块的坐标
			ul.children().not(tab).not(wid).not('.nokpdrager').each(function(i) {
				var obj = jQuery(this);
				var p = obj.position();
				var a1 = p.left;
				var a2 = p.left + obj.width();
				// 移动虚线框
				if(a1 < ml && ml < a2 ) {
					if(!obj.next("#kp_widget_holder").length) {
						wid.insertAfter(this);
					}else{
						wid.insertBefore(this);
					}
					return;
				}
			});
		});

		// 绑定mouseup事件
		jQuery(document).mouseup(function(e) {
			jQuery(document).off('mouseup').off('mousemove');

			// 拖拽回位，并删除虚线框
			var p = wid.position();
			
			tab.animate({"left":p.left, "top":0}, 200, function() {
				tab.removeAttr("style");
				wid.replaceWith(tab);
				if(typeof recall=='function'){
					recall();
				}
				draging = null;
				_blank.hide();
			});
		});
	}
	
}
_aceditor.tab.scrollHandler=function(e){
	var scrolldir=jQuery(this).hasClass('scrollLeft')?'scrollLeft':'scrollRight';
	_aceditor.tab.scrolltimer=window.setInterval(function(){_aceditor.tab.scrolling(scrolldir)},_aceditor.tab.scrolldelay);
	jQuery(this).on('mouseup',function(e){
		if(_aceditor.tab.scrolltimer) window.clearInterval(_aceditor.tab.scrolltimer);
		return false;
	});
	return false;
}
_aceditor.tab.scrolling=function(scrolldir){
	var el=jQuery('#aceditor_tab');
	if(scrolldir=='scrollLeft'){
		var left=parseInt(el.css('left'))||0;
		if(left+_aceditor.tabwidth<=(_aceditor.tabcwidth-jQuery('.hscroll').outerWidth(true))){
			if(_aceditor.tab.scrolltimer) window.clearInterval(_aceditor.tab.scrolltimer);
			return;
		}else{
			left-=_aceditor.tab.scrollspeed;
			if(left+_aceditor.tabwidth<=(_aceditor.tabCwidth-jQuery('.hscroll').outerWidth(true))){
				left=(_aceditor.tabCwidth-jQuery('.hscroll').outerWidth(true))-_aceditor.tabwidth
			}
			el.css('left',left);
		}
	}else{
		var left=parseInt(el.css('left'));
		if(left>=0){
			if(_aceditor.tab.scrolltimer) window.clearInterval(_aceditor.tab.scrolltimer);
			return;
		}else{
			left+=_aceditor.tab.scrollspeed;
			if(left>0) left=0;
			el.css('left',left);
		}
	}
}
_aceditor.tab.setVisible=function(id){
	var el=jQuery('#tab_'+id);
	if(!el.length) return;
	if(_aceditor.tabCwidth<_aceditor.tabwidth){
		var left=parseInt(jQuery('#aceditor_tab').css('left'))||0;
		var p=el.offset();
		if(p.left<0){
			left-=p.left;
			if(left>0) left=0;
		}else if((p.left+el.width()>_aceditor.tabCwidth-jQuery('.hscroll').outerWidth(true))){
			var left=parseInt(jQuery('#aceditor_tab').css('left'))||0;
			left+=_aceditor.tabCwidth-jQuery('.hscroll').outerWidth(true)-el.width()-p.left;
			if(left>0) left=0;
		}
		jQuery('#aceditor_tab').css('left',left);
	}else{
		jQuery('#aceditor_tab').css('left',0);
	}
}
_aceditor.getSupportExts=function(){
	var exts=[];
	for(var i in _aceditor.supportedModes){
		exts=exts.concat(_aceditor.supportedModes[i]);
	}
	return exts;
}

_aceditor.openexts={
	"All":['All Documents(*.*)',['HTM','HTML','SHTM','SHTML','HTA','HTC','XHTML','STM','SSI','JS','JSON','AS','ASC','ASR','XML','XSL','XSD','DTD','XSLT','RSS','RDF','LBI','DWT','ASP','ASA','ASPX','ASCX','ASMX','CONFIG','CS','CSS','CFM','CFML','CFC','TLD','TXT','PHP','PHP3','PHP4','PHP5','PHP-DIST','PHTML','JSP','WML','TPL','LASSO','JSF','VB','VBS','VTM','VTML','INC','SQL','JAVA','EDML','MASTER','INFO','INSTALL','THEME','CONFIG','MODULE','PROFILE','ENGINE'],'selected'],
	"html":['HTML Documents(*.HTML,*.HTM,*.HTA,*.HTC,*.XHTML)',['HTML','HTM','HTA','HTC','XHTML'],''],
	"txt": ['Text Files(*.TXT)',['TXT'],''],
	"css": ['Style Sheets(*.CSS)',['CSS'],''],
	"js":  ['JavaScript Documents(*.JS,*.JSON)',['JS','JSON'],''],
	"jsp": ['Java Server Pages(*.JSP,*.JST)',['JSP','JST'],''],
	"java":['Java Files(*.JAVA)',['JAVA'],''],
	"asp": ['Active Server Pages(*.ASP,*.ASA)',['ASP','ASA'],''],
	"aspx":['Active Server Plus Pages(*.ASPX,*.ASCX,*.ASMX)',['ASPX','ASCX','ASMX'],''],
	"php": ['PHP Files(*.PHP,*.PHP3,*.PHP4,*.PHP5)',['PHP','PHP3','PHP4','PHP5'],''],
	"sql": ['SQL Files(*.SQL)',['SQL'],''],"vbs":['VBScript Files(*.VBS)',['VBS'],''],
};
_aceditor.saveexts={
	"All":['All Documents(*.*)',['HTM','HTML','SHTM','SHTML','HTA','HTC','XHTML','STM','SSI','JS','JSON','AS','ASC','ASR','XML','XSL','XSD','DTD','XSLT','RSS','RDF','LBI','DWT','ASP','ASA','ASPX','ASCX','ASMX','CONFIG','CS','CSS','CFM','CFML','CFC','TLD','TXT','PHP','PHP3','PHP4','PHP5','PHP-DIST','PHTML','JSP','WML','TPL','LASSO','JSF','VB','VBS','VTM','VTML','INC','SQL','JAVA','EDML','MASTER','INFO','INSTALL','THEME','CONFIG','MODULE','PROFILE','ENGINE'],''],
	"html":['HTML Documents(*.HTML,*.HTM,*.HTA,*.HTC,*.XHTML)',['HTML','HTM','HTA','HTC','XHTML'],''],
	"txt": ['Text Files(*.TXT)',['TXT'],'selected'],
	"css": ['Style Sheets(*.CSS)',['CSS'],''],
	"js":  ['JavaScript Documents(*.JS,*.JSON)',['JS','JSON'],''],
	"jsp": ['Java Server Pages(*.JSP,*.JST)',['JSP','JST'],''],
	"java":['Java Files(*.JAVA)',['JAVA'],''],
	"asp": ['Active Server Pages(*.ASP,*.ASA)',['ASP','ASA'],''],
	"aspx":['Active Server Plus Pages(*.ASPX,*.ASCX,*.ASMX)',['ASPX','ASCX','ASMX'],''],
	"php": ['PHP Files(*.PHP,*.PHP3,*.PHP4,*.PHP5)',['PHP','PHP3','PHP4','PHP5'],''],
	"sql": ['SQL Files(*.SQL)',['SQL'],''],"vbs":['VBScript Files(*.VBS)',['VBS'],''],
};
_aceditor.supportedModes = {
    /*ABAP:        ["abap"],*/
    ActionScript:["as"],
   /* ADA:         ["ada","adb"],*/
    Apache_Conf: ["htaccess","htgroups","htpasswd","conf","htaccess","htgroups","htpasswd"],
   // AsciiDoc:    ["asciidoc"],
   // Assembly_x86:["asm"],
   /* AutoHotKey:  ["ahk"],*/
    BatchFile:   ["bat","cmd"],
   /* C9Search:    ["c9search_results"],*/
    C_Cpp:       ["cpp","c","cc","cxx","h","hh","hpp"],
    Cirru:       ["cirru","cr"],
   // Clojure:     ["clj","cljs"],
   // Cobol:       ["CBL","COB"],
    coffee:      ["coffee","cf","cson","Cakefile"],
    /*ColdFusion:  ["cfm"],*/
    CSharp:      ["cs"],
    CSS:         ["css"],
   /* Curly:       ["curly"],
    D:           ["d","di"],*/
    Dart:        ["dart"],
    Diff:        ["diff","patch"],
   /* Dockerfile:  ["Dockerfile"],
    Dot:         ["dot"],
    Eiffel:      ["e"],
    Erlang:      ["erl","hrl"],
    EJS:         ["ejs"],
    Forth:       ["frt","fs","ldr"],
    FTL:         ["ftl"],
    Gcode:       ["gcode"],
    Gherkin:     ["feature"],*/
    Gitignore:   ["gitignore"],
   /* Glsl:        ["glsl","frag","vert"],*/
    golang:      ["go"],
   /* Groovy:      ["groovy"],
    HAML:        ["haml"],
    Handlebars:  ["hbs","handlebars","tpl","mustache"],
    Haskell:     ["hs"],
    haXe:        ["hx"],*/
    HTML:        ["html","htm","xhtml"],
    HTML_Ruby:   ["erb","rhtml","html.erb"],
    INI:         ["ini","conf","cfg","prefs"],
    /*Jack:        ["jack"],*/
    Jade:        ["jade"],
    Java:        ["java"],
    JavaScript:  ["js","jsm"],
    JSON:        ["json"],
   // JSONiq:      ["jq"],
    JSP:         ["jsp"],
    JSX:         ["jsx"],
    Julia:       ["jl"],
   // LaTeX:       ["tex","latex","ltx","bib"],
    LESS:        ["less"],
    /*Liquid:      ["liquid"],
    Lisp:        ["lisp"],*/
    LiveScript:  ["ls"],
    LogiQL:      ["logic","lql"],
   // LSL:         ["lsl"],
    Lua:         ["lua"],
   // LuaPage:     ["lp"],
   // Lucene:      ["lucene"],
   // Makefile:    ["Makefile","GNUmakefile","makefile","OCamlMakefile","make"],
    /*MATLAB:      ["matlab"],*/
    Markdown:    ["md","markdown"],
   /* MEL:         ["mel"],
    MySQL:       ["mysql"],
    MUSHCode:    ["mc","mush"],*/
    Nix:         ["nix"],
    ObjectiveC:  ["m","mm"],
    //OCaml:       ["ml","mli"],
    Pascal:      ["pas","p"],
    Perl:        ["pl","pm"],
    pgSQL:       ["pgsql"],
    PHP:         ["php","phtml"],
    Powershell:  ["ps1"],
   /* Praat:       ["praat","praatscript","psc","proc"],*/
    Prolog:      ["plg","prolog"],
   /* Properties:  ["properties"],
    Protobuf:    ["proto"],*/
    Python:      ["py"],
    R:           ["r"],
    RDoc:        ["Rd"],
    RHTML:       ["Rhtml"],
    Ruby:        ["rb","ru","gemspec","rake","Guardfile","Rakefile","Gemfile"],
   // Rust:        ["rs"],
   /* SASS:        ["sass"],*/
   // SCAD:        ["scad"],
   // Scala:       ["scala"],
    Smarty:      ["smarty","tpl"],
    Scheme:      ["scm","rkt"],
   // SCSS:        ["scss"],
    SH:          ["sh","bash","bashrc"],
    /*SJS:         ["sjs"],*/
   /* Space:       ["space"],*/
    snippets:    ["snippets"],
   /* Soy_Template:["soy"],*/
    SQL:         ["sql"],
    /*Stylus:      ["styl","stylus"],*/
    SVG:         ["svg"],
    /*Tcl:         ["tcl"],*/
   /* Tex:         ["tex"],*/
    Text:        ["txt"],
    Textile:     ["textile"],
   // Toml:        ["toml"],
    /*Twig:        ["twig"],*/
    Typescript:  ["ts","typescript","str"],
   /* Vala:        ["vala"],*/
    VBScript:    ["vbs","vb"],
   // Velocity:    ["vm"],
    Verilog:     ["v","vh","sv","svh"],
    XML:         ["xml","rdf","rss","wsdl","xslt","atom","mathml","mml","xul","xbl"],
   /* XQuery:      ["xq"],
    YAML:        ["yaml","yml"]*/
};
function codesave(){
		retry++;
		jQuery.ajax({
				 type:'post',
				 async: false,
				 url:'{DZZSCRIPT}?mod=aceditor&do=autosave&t='+new Date().getTime(),
				 data:{code:'{$code}',path:'{$dpath}',message:editor.getValue()},
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
		//codesave();
	}